<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leaflet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeafletCrudController extends Controller
{
    /**
     * Categories list for leaflets.
     */
    public const CATEGORIES = [
        'Umum' => 'Umum',
        'Penyakit Tidak Menular' => 'Penyakit Tidak Menular',
        'Penyakit Menular' => 'Penyakit Menular',
        'Kesehatan Ibu & Anak' => 'Kesehatan Ibu & Anak',
        'Gizi & Pola Hidup Sehat' => 'Gizi & Pola Hidup Sehat',
        'Farmasi & Penggunaan Obat' => 'Farmasi & Penggunaan Obat',
        'Rehabilitasi Medik' => 'Rehabilitasi Medik',
        'Pelayanan & Fasilitas RS' => 'Pelayanan & Fasilitas RS',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Leaflet::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $leaflets = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => Leaflet::count(),
            'categories_count' => Leaflet::distinct('category')->count('category'),
            'total_views' => Leaflet::sum('views_count'),
        ];

        $categories = self::CATEGORIES;

        return view('admin.leaflets.index', compact('leaflets', 'stats', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = self::CATEGORIES;
        return view('admin.leaflets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'file' => 'required|mimes:pdf|max:30720', // Max 30MB
            'thumbnail_file' => 'nullable|image|max:5120',
            'thumbnail_base64' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
        $filePath = $file->storeAs('leaflets/files', $fileName, 'public');

        $size = $this->formatBytes($file->getSize());

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_file')) {
            $thumb = $request->file('thumbnail_file');
            $thumbName = 'thumb_' . time() . '_' . Str::random(6) . '.' . $thumb->getClientOriginalExtension();
            $thumbnailPath = $thumb->storeAs('leaflets/thumbnails', $thumbName, 'public');
        } elseif ($request->filled('thumbnail_base64')) {
            $thumbnailPath = $this->saveBase64Thumbnail($request->thumbnail_base64);
        }

        Leaflet::create([
            'title' => $request->title,
            'category' => $request->category,
            'pdf_path' => $filePath,
            'thumbnail_path' => $thumbnailPath,
            'file_size' => $size,
        ]);

        return redirect()->route('admin.leaflets.index')->with('success', 'Leaflet berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leaflet $leaflet)
    {
        $categories = self::CATEGORIES;
        return view('admin.leaflets.edit', compact('leaflet', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leaflet $leaflet)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'file' => 'nullable|mimes:pdf|max:30720',
            'thumbnail_file' => 'nullable|image|max:5120',
            'thumbnail_base64' => 'nullable|string',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
        ];

        if ($request->hasFile('file')) {
            if ($leaflet->pdf_path && Storage::disk('public')->exists($leaflet->pdf_path)) {
                Storage::disk('public')->delete($leaflet->pdf_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $data['pdf_path'] = $file->storeAs('leaflets/files', $fileName, 'public');
            $data['file_size'] = $this->formatBytes($file->getSize());
        }

        if ($request->hasFile('thumbnail_file')) {
            if ($leaflet->thumbnail_path && Storage::disk('public')->exists($leaflet->thumbnail_path)) {
                Storage::disk('public')->delete($leaflet->thumbnail_path);
            }
            $thumb = $request->file('thumbnail_file');
            $thumbName = 'thumb_' . time() . '_' . Str::random(6) . '.' . $thumb->getClientOriginalExtension();
            $data['thumbnail_path'] = $thumb->storeAs('leaflets/thumbnails', $thumbName, 'public');
        } elseif ($request->filled('thumbnail_base64')) {
            if ($leaflet->thumbnail_path && Storage::disk('public')->exists($leaflet->thumbnail_path)) {
                Storage::disk('public')->delete($leaflet->thumbnail_path);
            }
            $data['thumbnail_path'] = $this->saveBase64Thumbnail($request->thumbnail_base64);
        }

        $leaflet->update($data);

        return redirect()->route('admin.leaflets.index')->with('success', 'Leaflet berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leaflet $leaflet)
    {
        if ($leaflet->pdf_path && Storage::disk('public')->exists($leaflet->pdf_path)) {
            Storage::disk('public')->delete($leaflet->pdf_path);
        }

        if ($leaflet->thumbnail_path && Storage::disk('public')->exists($leaflet->thumbnail_path)) {
            Storage::disk('public')->delete($leaflet->thumbnail_path);
        }

        $leaflet->delete();

        return redirect()->route('admin.leaflets.index')->with('success', 'Leaflet berhasil dihapus.');
    }

    /**
     * Show the batch/bulk upload page.
     */
    public function batch()
    {
        $categories = self::CATEGORIES;
        return view('admin.leaflets.batch', compact('categories'));
    }

    /**
     * AJAX endpoint to upload a single item in a batch queue.
     * Prevents timeout and max_file_uploads limits.
     */
    public function batchUploadItem(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'file' => 'required|mimes:pdf|max:30720',
            'thumbnail_base64' => 'nullable|string',
        ]);

        try {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.pdf';
            $filePath = $file->storeAs('leaflets/files', $fileName, 'public');
            $size = $this->formatBytes($file->getSize());

            $thumbnailPath = null;
            if ($request->filled('thumbnail_base64')) {
                $thumbnailPath = $this->saveBase64Thumbnail($request->thumbnail_base64);
            }

            $leaflet = Leaflet::create([
                'title' => $request->title,
                'category' => $request->category,
                'pdf_path' => $filePath,
                'thumbnail_path' => $thumbnailPath,
                'file_size' => $size,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil disimpan',
                'leaflet' => [
                    'id' => $leaflet->id,
                    'title' => $leaflet->title,
                    'category' => $leaflet->category,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Helper to save base64 dataURL as an image file.
     */
    private function saveBase64Thumbnail(?string $dataUrl): ?string
    {
        if (empty($dataUrl)) {
            return null;
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
            $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
            $ext = strtolower($type[1]);
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $ext = 'webp';
            }
            $decoded = base64_decode($data);
            if ($decoded === false) {
                return null;
            }

            $fileName = 'leaflets/thumbnails/thumb_' . time() . '_' . Str::random(8) . '.' . $ext;
            Storage::disk('public')->put($fileName, $decoded);
            return $fileName;
        }

        return null;
    }

    /**
     * Format bytes to human readable format.
     */
    private function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

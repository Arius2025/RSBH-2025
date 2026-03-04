<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    /**
     * Clear Instagram feed cache.
     */
    public function refreshInstagram()
    {
        Cache::forget('instagram_feed_final');
        
        return redirect()->back()->with('success', 'Cache Berita Instagram berhasil diperbarui! Silakan cek halaman depan.');
    }
}

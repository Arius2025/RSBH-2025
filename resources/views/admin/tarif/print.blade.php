<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Tarif RSDKT {{ $group ? '- ' . $group : '' }}</title>
    {{-- Menggunakan Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 20px; font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h3 { margin: 0; font-weight: bold; }
        .header p { margin: 0; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { border: 1px solid #000; padding: 6px 8px; }
        th { background-color: #f2f2f2; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        
        /* Pengaturan Cetak khusus PDF/Printer */
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print mt-3 mb-4 text-center">
        <button class="btn btn-primary" onclick="window.print()">Cetak Ulang</button>
        <button class="btn btn-secondary" onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h3>DATA TARIF LAYANAN DAN PRODUK RSDKT</h3>
        <p>Kelompok: <strong>{{ $group ? $group : 'Semua Kelompok' }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">Kode Tarif</th>
                <th width="20%" class="text-center">Kode Internal</th>
                <th width="45%">Nama Produk / Layanan</th>
                <th width="15%" class="text-end">Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $item['code_tariff'] ?? '-' }}</td>
                <td class="text-center">{{ $item['code'] ?? '-' }}</td>
                <td>{{ $item['name'] ?? '-' }}</td>
                <td class="text-end">{{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">Tidak ada data untuk dicetak.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

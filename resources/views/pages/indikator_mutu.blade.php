@extends('layouts.app')

@section('title', 'Indikator Mutu Nasional (INM) - RS Tk. III Baladhika Husada')
@section('meta_description', 'Laporan Capaian Indikator Mutu Nasional (INM) RS Tk. III Baladhika Husada Jember periode TW I 2025 s.d. TW II 2026.')

@section('content')
<!-- Chart.js & Chart.js DataLabels plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

<style>
    .inm-page {
        background-color: #ffffff;
        font-family: 'Segoe UI', Arial, sans-serif;
        color: #212529;
    }
    
    /* 1. SECTION 1 STYLING (Image 1 - Line Chart) */
    .chart-container-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .chart-header-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 2px;
    }
    .chart-header-subtitle {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
    }
    .chart-footer-note {
        font-size: 0.85rem;
        font-style: italic;
        color: #6b7280;
        margin-top: 16px;
    }

    /* 2. SECTION 2 STYLING (Image 2 - Status Heatmap Solid) */
    .heatmap-title-1 {
        font-size: 1.2rem;
        font-weight: 800;
        color: #111827;
        text-align: center;
        margin-bottom: 2px;
    }
    .heatmap-title-2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        text-align: center;
        margin-bottom: 20px;
    }
    .table-heatmap {
        border-collapse: separate;
        border-spacing: 2px;
        width: 100%;
        margin-bottom: 12px;
    }
    .table-heatmap th {
        background: transparent;
        font-weight: 700;
        font-size: 0.85rem;
        text-align: center;
        padding: 10px 6px;
        color: #374151;
        border: none;
    }
    .table-heatmap th.col-name {
        text-align: right;
        padding-right: 16px;
        font-weight: 500;
        color: #374151;
        width: 25%;
    }
    .table-heatmap td {
        border: none;
        padding: 10px 4px;
        text-align: center;
        font-weight: 700;
        font-size: 0.88rem;
        color: #ffffff;
        border-radius: 2px;
    }
    .table-heatmap td.cell-name {
        background: transparent;
        color: #1f2937;
        font-weight: 500;
        text-align: right;
        padding-right: 16px;
        font-size: 0.85rem;
    }
    .cell-tercapai-solid {
        background-color: #009933 !important;
    }
    .cell-belum-solid {
        background-color: #cc3333 !important;
    }
    .heatmap-legend {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 24px;
        margin-top: 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
    }
    .legend-box {
        width: 18px;
        height: 18px;
        border-radius: 2px;
        display: inline-block;
    }

    /* 3. SECTION 3 STYLING (Image 3 - Matrix Soft Pastel) */
    .matrix-title-main {
        color: #1e3a5f;
        font-weight: 900;
        font-size: 1.25rem;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .matrix-title-sub {
        color: #475569;
        font-size: 0.92rem;
        font-style: italic;
        text-align: center;
        margin-bottom: 18px;
    }
    .table-matrix {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #1e3a5f;
    }
    .table-matrix th {
        background-color: #1e3a5f !important;
        color: #ffffff !important;
        font-weight: 800;
        font-size: 0.85rem;
        text-align: center;
        padding: 10px 8px;
        border: 1px solid #172b4d;
        vertical-align: middle;
    }
    .table-matrix td {
        border: 1px solid #cbd5e1;
        padding: 7px 8px;
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .table-matrix td.col-no {
        text-align: center;
        font-weight: 700;
        color: #1e293b;
        width: 4%;
        background-color: #ffffff;
    }
    .table-matrix td.col-indikator {
        font-weight: 600;
        color: #0f172a;
        background-color: #ffffff;
        width: 38%;
    }
    .cell-tercapai-pastel {
        background-color: #d4edda !important;
        color: #155724 !important;
        font-weight: 700;
        text-align: center;
    }
    .cell-belum-pastel {
        background-color: #fce8e6 !important;
        color: #721c24 !important;
        font-weight: 700;
        text-align: center;
    }
    .table-matrix tfoot td {
        font-weight: 800;
        border-top: 2px solid #1e3a5f;
        background-color: #ffffff;
    }
    .matrix-legend-box {
        display: inline-block;
        padding: 4px 14px;
        font-size: 0.82rem;
        font-weight: 700;
        border-radius: 2px;
        border: 1px solid #cbd5e1;
    }
</style>

<div class="inm-page py-4">
    <div class="container" style="max-width: 1140px;">
        
        {{-- VIEW MODE SWITCHER TABS --}}
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom flex-wrap gap-2">
            <div>
                <h4 class="fw-bold mb-0 text-dark">Indikator Mutu Nasional (INM)</h4>
                <small class="text-muted">RS Tk. III Baladhika Husada Jember</small>
            </div>
            <div class="d-flex gap-2">
                <a href="#section-grafik" class="btn btn-sm btn-outline-primary fw-semibold rounded-pill px-3">
                    1. Grafik Tren
                </a>
                <a href="#section-status" class="btn btn-sm btn-outline-success fw-semibold rounded-pill px-3">
                    2. Status Capaian
                </a>
                <a href="#section-matrix" class="btn btn-sm btn-outline-dark fw-semibold rounded-pill px-3">
                    3. Matrix Capaian
                </a>
            </div>
        </div>

        {{-- PENJELASAN RINGKAS --}}
        <div class="chart-container-card mb-4" style="background-color: #fcfdfd;">
            <p class="text-muted small mb-0" style="line-height: 1.6;">
                <strong>Indikator Mutu Nasional (INM)</strong> merupakan tolak ukur kepatuhan mutu dan keselamatan pasien yang ditetapkan oleh Kementerian Kesehatan RI. Evaluasi capaian dilakukan secara berkala setiap triwulan untuk memantau mutu pelayanan klinis, keselamatan, dan tata kelola RS Tk. III Baladhika Husada.
            </p>
        </div>

        {{-- ========================================================================= --}}
        {{-- 1. GAMBAR 1: TREN CAPAIAN INDIKATOR MUTU NASIONAL (LINE CHART) --}}
        {{-- ========================================================================= --}}
        <div class="chart-container-card mb-5" id="section-grafik">
            <div class="chart-header-title">Tren Capaian Indikator Mutu Nasional (INM) per Triwulan</div>
            <div class="chart-header-subtitle">Persentase (%) Indikator yang Mencapai Target — RS Tk. III Baladhika Husada</div>
            
            <div style="position: relative; height: 400px; width: 100%;">
                <canvas id="canvasTrendChart"></canvas>
            </div>
            
            <div class="chart-footer-note">
                Basis: 12 Indikator Mutu Nasional (INM), TW I 2025 s.d. TW II 2026.
            </div>
        </div>

        {{-- ========================================================================= --}}
        {{-- 2. GAMBAR 2: STATUS CAPAIAN INDIKATOR MUTU NASIONAL (SOLID HEATMAP) --}}
        {{-- ========================================================================= --}}
        <div class="chart-container-card mb-5" id="section-status">
            <div class="heatmap-title-1">Status Capaian Indikator Mutu Nasional (INM) per Triwulan</div>
            <div class="heatmap-title-2">RS Tk. III Baladhika Husada — TW I 2025 s.d. TW II 2026</div>

            <div class="table-responsive">
                <table class="table-heatmap">
                    <thead>
                        <tr>
                            <th class="col-name"></th>
                            <th width="12%">TW I 2025</th>
                            <th width="12%">TW II 2025</th>
                            <th width="12%">TW III 2025</th>
                            <th width="12%">TW IV 2025</th>
                            <th width="12%">TW I 2026</th>
                            <th width="12%">TW II 2026</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cell-name">Kebersihan Tangan</td>
                            <td class="cell-belum-solid">98</td>
                            <td class="cell-belum-solid">99.5</td>
                            <td class="cell-belum-solid">90.8</td>
                            <td class="cell-belum-solid">93.7</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Penggunaan APD</td>
                            <td class="cell-belum-solid">99.3</td>
                            <td class="cell-belum-solid">99.3</td>
                            <td class="cell-belum-solid">96.4</td>
                            <td class="cell-belum-solid">95.3</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Identifikasi Pasien</td>
                            <td class="cell-belum-solid">99.3</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-belum-solid">96.1</td>
                            <td class="cell-belum-solid">96.7</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Tanggap SC Emergensi</td>
                            <td class="cell-belum-solid">95.5</td>
                            <td class="cell-belum-solid">97</td>
                            <td class="cell-belum-solid">90</td>
                            <td class="cell-belum-solid">95.3</td>
                            <td class="cell-belum-solid">95.3</td>
                            <td class="cell-tercapai-solid">95.3</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Tunggu Rawat Jalan</td>
                            <td class="cell-belum-solid">97.3</td>
                            <td class="cell-belum-solid">99.3</td>
                            <td class="cell-belum-solid">90.6</td>
                            <td class="cell-belum-solid">94</td>
                            <td class="cell-tercapai-solid">93.3</td>
                            <td class="cell-tercapai-solid">94.4</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Penundaan Operasi Elektif</td>
                            <td class="cell-belum-solid">4.4</td>
                            <td class="cell-belum-solid">1.7</td>
                            <td class="cell-belum-solid">1.8</td>
                            <td class="cell-tercapai-solid">1</td>
                            <td class="cell-tercapai-solid">0</td>
                            <td class="cell-tercapai-solid">1.1</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Visite Dokter Spesialis</td>
                            <td class="cell-belum-solid">93.3</td>
                            <td class="cell-belum-solid">98.3</td>
                            <td class="cell-belum-solid">89.4</td>
                            <td class="cell-belum-solid">94</td>
                            <td class="cell-belum-solid">96.7</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Lapor Hasil Kritis Lab</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">96</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Formularium Nasional</td>
                            <td class="cell-belum-solid">95.7</td>
                            <td class="cell-belum-solid">96</td>
                            <td class="cell-belum-solid">93.3</td>
                            <td class="cell-tercapai-solid">94.7</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Clinical Pathway</td>
                            <td class="cell-belum-solid">95</td>
                            <td class="cell-belum-solid">96.7</td>
                            <td class="cell-belum-solid">94.3</td>
                            <td class="cell-belum-solid">94</td>
                            <td class="cell-belum-solid">96.7</td>
                            <td class="cell-tercapai-solid">96.7</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Pencegahan Pasien Jatuh</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-belum-solid">92.9</td>
                            <td class="cell-belum-solid">94.7</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                        <tr>
                            <td class="cell-name">Tanggap Komplain</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-belum-solid">33.3</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                            <td class="cell-tercapai-solid">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="heatmap-legend">
                <div class="d-flex align-items-center gap-2">
                    <span class="legend-box" style="background-color: #009933;"></span>
                    <span>Tercapai</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="legend-box" style="background-color: #cc3333;"></span>
                    <span>Belum Tercapai</span>
                </div>
            </div>

            <div class="text-center mt-3" style="font-size: 0.78rem; color: #6b7280; font-style: italic;">
                Angka pada tiap sel menunjukkan rata-rata capaian bulanan triwulan tersebut (%, kecuali indikator dengan satuan lain).
            </div>
        </div>

        {{-- ========================================================================= --}}
        {{-- 3. GAMBAR 3: MATRIX CAPAIAN INDIKATOR MUTU NASIONAL (TABULAR PASTEL) --}}
        {{-- ========================================================================= --}}
        <div class="chart-container-card mb-5" id="section-matrix">
            <div class="matrix-title-main">MATRIX CAPAIAN INDIKATOR MUTU NASIONAL (INM) PER TRIWULAN — RS TK. III BALADHIKA HUSADA</div>
            <div class="matrix-title-sub">Triwulan I 2025 s.d. Triwulan II 2026 — nilai: rata-rata capaian bulanan; warna: status terhadap target</div>

            <div class="table-responsive">
                <table class="table-matrix">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th width="38%">Indikator Mutu Nasional</th>
                            <th width="9%">TW I 2025</th>
                            <th width="9%">TW II 2025</th>
                            <th width="9%">TW III 2025</th>
                            <th width="9%">TW IV 2025</th>
                            <th width="9%">TW I 2026</th>
                            <th width="9%">TW II 2026</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-no">1</td>
                            <td class="col-indikator">Kepatuhan Kebersihan Tangan (5 Momen)</td>
                            <td class="cell-belum-pastel">98 (BT)</td>
                            <td class="cell-belum-pastel">99.5 (BT)</td>
                            <td class="cell-belum-pastel">90.8 (BT)</td>
                            <td class="cell-belum-pastel">93.7 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">2</td>
                            <td class="col-indikator">Kepatuhan Penggunaan APD</td>
                            <td class="cell-belum-pastel">99.3 (BT)</td>
                            <td class="cell-belum-pastel">99.3 (BT)</td>
                            <td class="cell-belum-pastel">96.4 (BT)</td>
                            <td class="cell-belum-pastel">95.3 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">3</td>
                            <td class="col-indikator">Kepatuhan Identifikasi Pasien</td>
                            <td class="cell-belum-pastel">99.3 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-belum-pastel">96.1 (BT)</td>
                            <td class="cell-belum-pastel">96.7 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">4</td>
                            <td class="col-indikator">Waktu Tanggap Operasi Seksio Sesarea Emergensi (&lt; 30 menit)</td>
                            <td class="cell-belum-pastel">95.5 (BT)</td>
                            <td class="cell-belum-pastel">97 (BT)</td>
                            <td class="cell-belum-pastel">90 (BT)</td>
                            <td class="cell-belum-pastel">95.3 (BT)</td>
                            <td class="cell-belum-pastel">95.3 (BT)</td>
                            <td class="cell-tercapai-pastel">95.3 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">5</td>
                            <td class="col-indikator">Waktu Tunggu Rawat Jalan</td>
                            <td class="cell-belum-pastel">97.3 (BT)</td>
                            <td class="cell-belum-pastel">99.3 (BT)</td>
                            <td class="cell-belum-pastel">90.6 (BT)</td>
                            <td class="cell-belum-pastel">94 (BT)</td>
                            <td class="cell-tercapai-pastel">93.3 (T)</td>
                            <td class="cell-tercapai-pastel">94.4 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">6</td>
                            <td class="col-indikator">Penundaan Operasi Elektif</td>
                            <td class="cell-belum-pastel">4.4 (BT)</td>
                            <td class="cell-belum-pastel">1.7 (BT)</td>
                            <td class="cell-belum-pastel">1.8 (BT)</td>
                            <td class="cell-tercapai-pastel">1 (T)</td>
                            <td class="cell-tercapai-pastel">0 (T)</td>
                            <td class="cell-tercapai-pastel">1.1 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">7</td>
                            <td class="col-indikator">Kepatuhan Waktu Visite Dokter Spesialis</td>
                            <td class="cell-belum-pastel">93.3 (BT)</td>
                            <td class="cell-belum-pastel">98.3 (BT)</td>
                            <td class="cell-belum-pastel">89.4 (BT)</td>
                            <td class="cell-belum-pastel">94 (BT)</td>
                            <td class="cell-belum-pastel">96.7 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">8</td>
                            <td class="col-indikator">Waktu Lapor Hasil Kritis Laboratorium (&lt; 30 menit)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">96 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">9</td>
                            <td class="col-indikator">Kepatuhan Penggunaan Formularium Nasional</td>
                            <td class="cell-belum-pastel">95.7 (BT)</td>
                            <td class="cell-belum-pastel">96 (BT)</td>
                            <td class="cell-belum-pastel">93.3 (BT)</td>
                            <td class="cell-tercapai-pastel">94.7 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">10</td>
                            <td class="col-indikator">Kepatuhan terhadap Clinical Pathway</td>
                            <td class="cell-belum-pastel">95 (BT)</td>
                            <td class="cell-belum-pastel">96.7 (BT)</td>
                            <td class="cell-belum-pastel">94.3 (BT)</td>
                            <td class="cell-belum-pastel">94 (BT)</td>
                            <td class="cell-belum-pastel">96.7 (BT)</td>
                            <td class="cell-tercapai-pastel">96.7 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">11</td>
                            <td class="col-indikator">Kepatuhan Upaya Pencegahan Risiko Pasien Jatuh</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-belum-pastel">92.9 (BT)</td>
                            <td class="cell-belum-pastel">94.7 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                        <tr>
                            <td class="col-no">12</td>
                            <td class="col-indikator">Kecepatan Waktu Tanggap Komplain (&lt; 24 jam)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-belum-pastel">33.3 (BT)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                            <td class="cell-tercapai-pastel">100 (T)</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="font-weight: 800; color: #0f172a; padding: 10px 8px;">% Indikator Tercapai</td>
                            <td style="text-align: center; font-weight: 800;">25%</td>
                            <td style="text-align: center; font-weight: 800;">33.3%</td>
                            <td style="text-align: center; font-weight: 800;">8.3%</td>
                            <td style="text-align: center; font-weight: 800;">33.3%</td>
                            <td style="text-align: center; font-weight: 800;">75%</td>
                            <td style="text-align: center; font-weight: 800;">100%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4 d-flex flex-column gap-2" style="max-width: 240px;">
                <div class="matrix-legend-box cell-tercapai-pastel text-start">
                    T = Tercapai
                </div>
                <div class="matrix-legend-box cell-belum-pastel text-start">
                    BT = Belum Tercapai
                </div>
            </div>
        </div>

    </div>
</div>

{{-- CHART JS SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Register DataLabels plugin
        Chart.register(ChartDataLabels);

        const ctx = document.getElementById('canvasTrendChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['TW I 2025', 'TW II 2025', 'TW III 2025', 'TW IV 2025', 'TW I 2026', 'TW II 2026'],
                datasets: [{
                    label: 'Persentase (%) Indikator yang Mencapai Target',
                    data: [25, 33.3, 8.3, 33.3, 75, 100],
                    borderColor: '#2b75cb', // Exact blue color from image 1
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#2b75cb',
                    pointBorderColor: '#2b75cb',
                    pointRadius: 5.5,
                    pointHoverRadius: 7,
                    fill: false,
                    tension: 0 // Straight lines exactly as shown in image 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 25,
                        right: 20,
                        left: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        align: 'top',
                        anchor: 'center',
                        offset: 10,
                        color: '#111827',
                        font: {
                            family: 'Segoe UI, Arial, sans-serif',
                            size: 13,
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value + '%';
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 4,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 110,
                        ticks: {
                            stepSize: 20,
                            callback: function(value) {
                                if (value > 100) return '';
                                return value + '%';
                            },
                            color: '#6b7280',
                            font: { size: 12 }
                        },
                        grid: {
                            color: '#e5e7eb',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#1f2937',
                            font: { size: 12, weight: '500' }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('styles')
<style>
    .dashboard-wrapper {
        width: 100%;
        padding: 30px;
        box-sizing: border-box;
    }

    .dashboard-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 5px 0;
    }

    .page-subtitle {
        font-size: 15px;
        color: #64748b;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-bottom: 35px;
        width: 100%;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
    }

    .stat-value {
        font-size: 36px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
    }

    .stat-desc {
        font-size: 13px;
        margin-top: 10px;
        display: block;
        color: #94a3b8;
    }

    .chart-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 30px;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .chart-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 25px;
    }

    .chart-wrapper {
        height: 450px;
        width: 100%;
        position: relative;
    }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .dashboard-wrapper { padding: 20px; }
        .chart-wrapper { height: 300px; }
    }
</style>
@endsection

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h1 class="page-title">Dashboard Overview</h1>
        <p class="page-subtitle">Pantau stok barang dan omzet penjualan secara real-time.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card" style="border-left: 5px solid #8b0000;">
            <span class="stat-label">Total Produk</span>
            <div class="stat-value">{{ number_format($totalProducts, 0, ',', '.') }}</div>
            <span class="stat-desc">Semua produk terdaftar</span>
        </div>
        
        <div class="stat-card" style="border-left: 5px solid #f59e0b;">
            <span class="stat-label">Stok Tipis (≤ 5)</span>
            <div class="stat-value" style="color: #dc2626;">{{ number_format($lowStock, 0, ',', '.') }}</div>
            <span class="stat-desc" style="color: #dc2626;">Perlu restok segera</span>
        </div>
        
        <div class="stat-card" style="border-left: 5px solid #1e293b;">
            <span class="stat-label">Total Transaksi</span>
            <div class="stat-value">{{ number_format($totalTransactions, 0, ',', '.') }}</div>
            <span class="stat-desc">Data transaksi tersimpan</span>
        </div>
    </div>

    <div class="chart-box">
        <h2 class="chart-title">Grafik Penjualan 7 Hari Terakhir</h2>
        <div class="chart-wrapper">
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Penjualan Barang Sendiri (Rp)',
                        data: {!! json_encode($totalsOwn) !!},
                        borderColor: '#8b0000',
                        backgroundColor: 'rgba(139, 0, 0, 0.05)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 6,
                        pointBackgroundColor: '#8b0000',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Penjualan Barang Titipan (Rp)',
                        data: {!! json_encode($totalsConsignment) !!},
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.05)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 6,
                        pointBackgroundColor: '#f59e0b',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 13, weight: '600' },
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    x: { 
                        grid: { display: false },
                        ticks: { font: { size: 12 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' },
                        ticks: {
                            font: { size: 12 },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
    });
</script>
@endsection
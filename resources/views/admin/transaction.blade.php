@extends('admin.layouts.app')

@section('content')
<div class="transactions-container">
    <div class="page-header">
        <div class="header-left">
            <h1>History Transaksi</h1>
            <p>Kelola dan pantau semua transaksi</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-card">
        <form action="{{ url('/admin/transaction') }}" method="GET" class="filter-form">
            <div class="form-group">
                <label class="form-label">Dari Tanggal</label>
                <input 
                    type="date" 
                    name="start_date" 
                    value="{{ request('start_date') }}" 
                    onclick="this.showPicker()"
                    class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Sampai Tanggal</label>
                <input 
                    type="date" 
                    name="end_date" 
                    value="{{ request('end_date') }}" 
                    onclick="this.showPicker()"
                    class="form-input">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-filter">
                    Filter Data
                </button>
                
                <a href="{{ url('/admin/transaction') }}" class="btn-reset">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Daftar Transaksi</h2>
        </div>
        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $trx)
                    <tr>
                        <td>
                            <span class="invoice-number">{{ $trx->invoice_number }}</span>
                        </td>
                        <td>
                            <span class="transaction-total">Rp {{ number_format($trx->total, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="transaction-date">{{ $trx->created_at->format('d/m/Y H:i') }}</span>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.transactions.show', $trx->id) }}" class="btn-detail">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <p>Tidak ada data transaksi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.transactions-container {
    padding: 0px;
    min-height: 100vh;
}

.page-header {
    margin-bottom: 32px;
}

.header-left h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 8px 0;
}

.header-left p {
    font-size: 15px;
    color: #737373;
    margin: 0;
}

/* Filter Card */
.filter-card {
    background: #ffffff;
    border: 1px solid #e8e8e8;
    border-radius: 8px;
    padding: 24px;
    margin-bottom: 24px;
}

.filter-form {
    display: flex;
    gap: 16px;
    align-items: flex-end;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 200px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #525252;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.form-input {
    padding: 12px 16px;
    border: 1px solid #e8e8e8;
    border-radius: 6px;
    font-size: 14px;
    color: #1a1a1a;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.form-input:focus {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-actions {
    display: flex;
    gap: 12px;
    align-items: center;
}

.btn-filter {
    background: #dc2626;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.btn-filter:hover {
    background: #b91c1c;
    transform: translateY(-1px);
}

.btn-reset {
    color: #737373;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.2s ease;
}

.btn-reset:hover {
    color: #1a1a1a;
}

/* Content Card */
.content-card {
    background: #ffffff;
    border: 1px solid #e8e8e8;
    border-radius: 8px;
    overflow: hidden;
}

.card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e8e8e8;
    background: #fafafa;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #fafafa;
}

th {
    padding: 16px 24px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #525252;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #e8e8e8;
}

tbody tr {
    transition: background-color 0.15s ease;
    border-bottom: 1px solid #f5f5f5;
}

tbody tr:hover {
    background: #fafafa;
}

td {
    padding: 16px 24px;
    font-size: 14px;
}

.invoice-number {
    font-weight: 600;
    color: #dc2626;
}

.transaction-total {
    font-weight: 500;
    color: #1a1a1a;
}

.transaction-date {
    color: #737373;
}

.btn-detail {
    display: inline-block;
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-detail:hover {
    background: #b91c1c;
    transform: translateY(-1px);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #737373;
}

.empty-state p {
    margin: 0;
    font-size: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .transactions-container {
        padding: 24px;
    }

    .header-left h1 {
        font-size: 24px;
    }

    .filter-form {
        flex-direction: column;
        align-items: stretch;
    }

    .form-group {
        min-width: 100%;
    }

    .form-actions {
        width: 100%;
    }

    .btn-filter {
        flex: 1;
    }

    th, td {
        padding: 12px 16px;
        font-size: 13px;
    }
}
</style>
@endsection
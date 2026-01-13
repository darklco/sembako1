@extends('admin.layouts.app')

@section('content')
<h2>Riwayat Transaksi</h2>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->invoice_number }}</td>
                <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.transactions.show', $trx->id) }}">
                        Detail
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" align="center">Belum ada transaksi</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>
{{ $transactions->links() }}
@endsection

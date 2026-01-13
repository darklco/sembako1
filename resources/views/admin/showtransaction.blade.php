@extends('layouts.admin')

@section('content')
<h2>Detail Transaksi</h2>

<p><strong>Invoice:</strong> {{ $transaction->invoice_number }}</p>
<p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d-m-Y H:i') }}</p>
<p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>

<hr>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br>
<a href="{{ route('admin.transactions.index') }}">⬅ Kembali</a>
@endsection

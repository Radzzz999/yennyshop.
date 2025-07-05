@extends('layouts.admin')

@section('title', 'Laporan Pembayaran')
<link rel="stylesheet" href="{{ asset('css/crudadmin.css') }}">

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        --danger-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        --neu-bg: #e6e7ee;
        --neu-light: #ffffff;
        --neu-dark: #d1d9e6;

        --username-color: var(--primary-gradient);
        --date-color: var(--secondary-gradient);
        --amount-color: var(--success-gradient);
        --method-color: var(--warning-gradient);
    }

    body {
        background: var(--neu-bg);
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 118, 117, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%);
        min-height: 100vh;
    }

    .main-container {
        background: var(--neu-bg);
        border-radius: 40px;
        padding: 60px 40px;
        margin: 20px auto;
        box-shadow:
            25px 25px 50px var(--neu-dark),
            -25px -25px 50px var(--neu-light);
        border: 2px solid rgba(255, 255, 255, 0.1);
    }

    .header-title {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 3rem;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.8);
    }

    .header-divider {
        width: 120px;
        height: 8px;
        background: var(--neu-bg);
        border-radius: 4px;
        margin: 1rem auto;
        box-shadow: inset 4px 4px 8px var(--neu-dark), inset -4px -4px 8px var(--neu-light);
    }

    .payment-card {
        background: var(--neu-bg);
        border-radius: 30px;
        padding: 1rem;
        box-shadow:
            20px 20px 40px var(--neu-dark),
            -20px -20px 40px var(--neu-light);
        border: 2px solid rgba(255, 255, 255, 0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .table-header {
        background: var(--neu-bg);
        color: #4a5568;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 1px solid #ccc;
    }

    .table-row {
        background: var(--neu-bg);
        transition: background 0.3s ease;
    }

    .table-row:hover {
        background: #f1f1f1;
    }

    .username-text,
    .amount-text,
    .date-text {
        font-weight: bold;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .username-text { background-image: var(--username-color); }
    .amount-text { background-image: var(--amount-color); }
    .date-text { background-image: var(--date-color); }

    .method-badge {
        background-image: var(--method-color);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.75rem;
    }

    .status-badge {
        padding: 6px 14px;
        font-weight: bold;
        border-radius: 20px;
        font-size: 0.75rem;
        color: white;
    }

    .status-success { background-color: #38a169; }
    .status-pending { background-color: #d69e2e; }
    .status-failed  { background-color: #e53e3e; }

    .index-circle {
        width: 36px;
        height: 36px;
        background-image: var(--primary-gradient);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
    }
</style>

<div class="w-full px-4 sm:px-8">
    <div class="main-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="header-title">Laporan Pembayaran</h1>
            <p class="text-gray-600 text-lg">Daftar lengkap transaksi pembayaran yang dilakukan oleh pembeli</p>
            <div class="header-divider"></div>
        </div>

        <!-- Table -->
        <div class="payment-card">
            <table>
                <thead class="table-header">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Pengguna</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Metode</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @php
                        $statusClasses = [
                            'success' => 'status-success',
                            'pending' => 'status-pending',
                            'failed'  => 'status-failed',
                        ];
                    @endphp

                    @forelse($payments as $index => $payment)
                        <tr class="table-row">
                            <td class="px-4 py-3"><div class="index-circle">{{ $index + 1 }}</div></td>
                            <td class="px-4 py-3"><span class="username-text">{{ $payment->user->name ?? 'N/A' }}</span></td>
                            <td class="px-4 py-3"><span class="amount-text">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span></td>
                            <td class="px-4 py-3"><span class="method-badge">{{ ucfirst($payment->payment_method) }}</span></td>
                            <td class="px-4 py-3"><span class="status-badge {{ $statusClasses[$payment->status] ?? 'bg-gray-400' }}">{{ ucfirst($payment->status) }}</span></td>
                            <td class="px-4 py-3"><span class="date-text">{{ $payment->created_at->format('d M Y H:i') }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-500">Tidak ada data pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

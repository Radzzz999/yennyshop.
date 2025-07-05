@extends('layouts.payment-layout')

@section('title', 'Pembayaran - YennyShop')
<link href="{{ asset('css/payments.css') }}" rel="stylesheet">

@section('content')
<div class="payment-container">
    <div class="payment-card">
        <div class="payment-header">
            <h2 class="payment-title">
                <i class="fas fa-credit-card"></i>
                Pembayaran
            </h2>
            <p class="payment-subtitle">Pilih metode pembayaran yang mudah untuk Anda</p>
        </div>

        <form id="paymentForm" action="{{ route('payment.process') }}" method="POST" onsubmit="handlePayment(event)">
            @csrf
            <div class="form-group">
                <label for="payment_method" class="form-label">
                    <i class="fas fa-wallet"></i>
                    Metode Pembayaran
                </label>
                <select name="payment_method" id="payment_method" class="form-control" required onchange="togglePaymentDetails()">
                    <option value="" selected disabled>-- Pilih Metode Pembayaran --</option>
                    <option value="qris">💳 QRIS (E-Wallet)</option>
                    <option value="bank">🏦 Transfer Bank</option>
                </select>
            </div>

            <div class="total-section">
                <p class="total-text">Total Pembayaran</p>
                <p class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>

            <div id="bankDetails" class="payment-details">
                <h5>
                    <i class="fas fa-university"></i>
                    Transfer ke Rekening
                </h5>
                <div class="bank-info">
                    <strong>Bank BCA</strong><br>
                    <strong>Nomor Rekening:</strong> 1234567890<br>
                    <strong>Atas Nama:</strong> PT YennyShop<br>
                    <small><i class="fas fa-info-circle"></i> Pastikan nominal transfer sesuai dengan total pembayaran</small>
                </div>
            </div>

            <div id="qrisDetails" class="payment-details">
                <h5>
                    <i class="fas fa-qrcode"></i>
                    Scan QR Code
                </h5>
                <div class="qris-container">
                    <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 1rem;">
                        Gunakan aplikasi e-wallet favorit Anda untuk scan QR code di bawah ini
                    </p>
                    <div style="background: white; padding: 1rem; border-radius: 15px; display: inline-block;">
                        <div style="width: 200px; height: 200px; background: linear-gradient(45deg, #333, #666); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                            <i class="fas fa-qrcode" style="color: white;"></i>
                        </div>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: 1rem; font-size: 0.9rem;">
                        <i class="fas fa-mobile-alt"></i>
                    </p>
                </div>
            </div>

            <button type="submit" id="payButton" class="pay-button">
                <i class="fas fa-credit-card payment-method-icon"></i>
                Bayar Sekarang
            </button>
        </form>

        <div id="successMessage" class="success-message" style="display: none;">
            <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
            Pembayaran Berhasil!
            <div style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.9;">
                Terima kasih telah berbelanja di YennyShop
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
@endpush

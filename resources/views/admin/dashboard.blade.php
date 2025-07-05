@extends('layouts.admin')

@section('title', 'Dashboard Admin')
<link rel="stylesheet" href="{{ asset('css/crudadmin.css') }}">

@section('content')

<style>
    /* Neumorphism Modern Styling */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        --danger-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        --neu-bg: #e6e7ee;
        --neu-light: #ffffff;
        --neu-dark: #d1d9e6;
        
        /* Custom Color Variables */
        --product-name-color: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --price-color: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --welcome-color: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --dashboard-title-color: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Soft Neumorphism Background */
    body {
        background: var(--neu-bg);
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 118, 117, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%);
        min-height: 100vh;
        padding: 20px 0;
    }

    /* Main Container */
    .main-container {
        background: var(--neu-bg);
        border-radius: 40px;
        padding: 50px 40px;
        margin: 20px auto;
        max-width: 1400px;
        box-shadow: 
            25px 25px 50px var(--neu-dark),
            -25px -25px 50px var(--neu-light),
            inset 2px 2px 4px rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }
    
    .main-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent);
        animation: containerShine 4s infinite;
    }
    
    @keyframes containerShine {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; transform: scaleX(1.2); }
    }

    /* Dashboard Header */
    .dashboard-title {
        background: var(--dashboard-title-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 3.5rem;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.8);
        animation: titleFloat 3s ease-in-out infinite alternate;
        filter: drop-shadow(2px 2px 4px rgba(209, 217, 230, 0.8));
        margin-bottom: 20px;
        position: relative;
    }
    
    .dashboard-title::before {
        content: '⚡';
        position: absolute;
        left: -60px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    @keyframes titleFloat {
        0% { transform: translateY(0px); }
        100% { transform: translateY(-5px); }
    }
    
    @keyframes sparkle {
        0%, 100% { opacity: 1; transform: translateY(-50%) scale(1); }
        50% { opacity: 0.7; transform: translateY(-50%) scale(1.1); }
    }

    /* Welcome Message */
    .welcome-message {
        background: var(--welcome-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.4rem;
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 40px;
        transition: all 0.3s ease;
    }
    
    .welcome-message:hover {
        transform: scale(1.02);
        filter: brightness(1.1);
    }

    /* Section Title */
    .section-title {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 25px;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    /* Enhanced Add Button */
    .add-btn {
        background: var(--neu-bg);
        background-image: var(--success-gradient);
        color: white;
        padding: 15px 30px;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        text-decoration: none;
        box-shadow: 
            12px 12px 24px var(--neu-dark),
            -12px -12px 24px var(--neu-light);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        display: inline-block;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    .add-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .add-btn:hover::before {
        left: 100%;
    }
    
    .add-btn:hover {
        color: white;
        text-decoration: none;
        box-shadow: 
            15px 15px 30px var(--neu-dark),
            -15px -15px 30px var(--neu-light);
        transform: translateY(-3px) scale(1.05);
    }

    /* Enhanced Table Container */
    .table-container {
        background: var(--neu-bg);
        border-radius: 30px;
        box-shadow: 
            20px 20px 40px var(--neu-dark),
            -20px -20px 40px var(--neu-light);
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    
    .table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        animation: tableShine 3s infinite;
    }
    
    @keyframes tableShine {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
    }

    /* Enhanced Table Styling */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: transparent;
    }
    
    .modern-table thead {
        background: var(--neu-bg);
        position: relative;
        box-shadow: 
            inset 5px 5px 10px var(--neu-dark),
            inset -5px -5px 10px var(--neu-light);
    }
    
    .modern-table thead::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(102, 126, 234, 0.1) 50%, transparent 70%);
        animation: headerShimmer 4s infinite;
    }
    
    @keyframes headerShimmer {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
    }
    
    .modern-table th {
        position: relative;
        z-index: 1;
        padding: 20px 25px;
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #4a5568;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
        border: none;
    }
    
    .modern-table th:first-child {
        border-radius: 25px 0 0 0;
    }
    
    .modern-table th:last-child {
        border-radius: 0 25px 0 0;
    }

    /* Enhanced Table Rows */
    .table-row {
        background: var(--neu-bg);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    .table-row:hover {
        background: var(--neu-bg);
        box-shadow: 
            inset 3px 3px 6px var(--neu-dark),
            inset -3px -3px 6px var(--neu-light);
        transform: scale(0.998);
    }
    
    .modern-table td {
        padding: 20px 25px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
    }

    /* Enhanced Index Circle */
    .index-circle {
        width: 45px;
        height: 45px;
        background: var(--neu-bg);
        background-image: var(--primary-gradient);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.1rem;
        box-shadow: 
            8px 8px 16px var(--neu-dark),
            -8px -8px 16px var(--neu-light);
        transition: all 0.4s ease;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .index-circle::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: circleShine 3s infinite;
    }
    
    @keyframes circleShine {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .index-circle:hover {
        box-shadow: 
            12px 12px 24px var(--neu-dark),
            -12px -12px 24px var(--neu-light);
        transform: scale(1.15) rotate(10deg);
    }

    /* Enhanced Product Name */
    .product-name {
        background: var(--product-name-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .product-name:hover {
        transform: scale(1.05);
        filter: brightness(1.1);
    }

    /* Enhanced Price */
    .price-text {
        background: var(--price-color);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 900;
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .price-text:hover {
        transform: scale(1.08);
        filter: brightness(1.2);
    }

    /* Enhanced Action Buttons */
    .action-btn {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        margin: 0 3px;
        box-shadow: 
            4px 4px 8px var(--neu-dark),
            -4px -4px 8px var(--neu-light);
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.3s;
    }
    
    .action-btn:hover::before {
        left: 100%;
    }
    
    .btn-info {
        background: var(--neu-bg);
        background-image: var(--info-gradient);
        color: #2c5282;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    }
    
    .btn-info:hover {
        color: #2a4365;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 
            6px 6px 12px var(--neu-dark),
            -6px -6px 12px var(--neu-light);
    }
    
    .btn-warning {
        background: var(--neu-bg);
        background-image: var(--warning-gradient);
        color: #c05621;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    }
    
    .btn-warning:hover {
        color: #9c4221;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 
            6px 6px 12px var(--neu-dark),
            -6px -6px 12px var(--neu-light);
    }
    
    .btn-danger {
        background: var(--neu-bg);
        background-image: var(--danger-gradient);
        color: #c53030;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
    }
    
    .btn-danger:hover {
        color: #9b2c2c;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 
            6px 6px 12px var(--neu-dark),
            -6px -6px 12px var(--neu-light);
    }

    /* No Data State */
    .no-data-row {
        background: var(--neu-bg);
        box-shadow: 
            inset 8px 8px 16px var(--neu-dark),
            inset -8px -8px 16px var(--neu-light);
    }
    
    .no-data-content {
        padding: 40px;
        text-align: center;
    }
    
    .no-data-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        animation: float 3s ease-in-out infinite;
        filter: drop-shadow(2px 2px 4px rgba(209, 217, 230, 0.8));
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .no-data-text {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.5rem;
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 10px;
            padding: 30px 20px;
            border-radius: 25px;
        }
        
        .dashboard-title {
            font-size: 2.5rem;
        }
        
        .dashboard-title::before {
            left: -40px;
            font-size: 2rem;
        }
    }
</style>

<div class="min-h-screen">
    <div class="container mx-auto px-4">
        <div class="main-container">
            <!-- Enhanced Header -->
            <div class="text-center mb-8">
                <h2 class="dashboard-title">Dashboard Admin</h2>
                <p class="welcome-message">Selamat datang, {{ Auth::user()->name }}!</p>
            </div>

            <!-- Enhanced Products Section -->
            <div class="products-section">
                <h4 class="section-title"> Daftar Produk</h4>
                
                <a href="{{ route('admin.products.create') }}" class="add-btn">
                    ➕ Tambah Produk
                </a>

                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $i => $product)
                                <tr class="table-row">
                                    <td>
                                        <div class="index-circle">{{ $i + 1 }}</div>
                                    </td>
                                    <td>
                                        <div class="product-name">{{ $product->nama_product }}</div>
                                    </td>
                                    <td>
                                        <div class="price-text">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="action-btn btn-info">
                                            👁️ Lihat
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="action-btn btn-warning">
                                            ✏️ Edit
                                        </a>
                                        <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-btn btn-danger"
                                                onclick="confirmDelete({{ $product->id }}, '{{ e($product->nama_product) }}')">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="4">
                                        <div class="no-data-content">
                                            <div class="no-data-icon">📦</div>
                                            <div class="no-data-text">Tidak ada produk tersedia</div>
                                            <p style="color: #718096; margin-top: 10px;">Silakan tambah produk baru untuk memulai</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced row animations
        const rows = document.querySelectorAll('.table-row');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.1}s`;
            
            // Enhanced hover effects for data elements
            const dataElements = row.querySelectorAll('.product-name, .price-text');
            dataElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                    this.style.filter = 'brightness(1.2)';
                });
                
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                    this.style.filter = 'brightness(1)';
                });
            });
        });
        
        // Enhanced button interactions
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.05)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
        
        // Enhanced add button interaction
        const addBtn = document.querySelector('.add-btn');
        if (addBtn) {
            addBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.05)';
            });
            
            addBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        }
    });
</script>

@endsection

@push('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script>
        function confirmDelete(productId, productName) {
            Swal.fire({
            title: 'Hapus Produk Ini?',
            html: `<strong>${productName}</strong> akan dihapus secara permanen.`,
            icon: 'warning',
            iconColor: '#f39c12',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Sekarang',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + productId).submit();
                }
            });
        }
    </script>
@endpush
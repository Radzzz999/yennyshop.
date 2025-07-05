<x-app-layout>
    <style>
        body {
            background: linear-gradient(to bottom right, #5b2c94, #a86cc1);
            font-family: 'Poppins', sans-serif;
            color: white;
        }

        nav.appbar {
            background-color: #4B1C89;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        nav.appbar a {
            color: white;
            margin-left: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav.appbar a:hover {
            color: #f093fb;
        }

        .form-wrapper {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            color: #fbd6ff;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .profile-header {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin: 3rem 0 1rem;
        }
    </style>

    {{-- Header --}}
    <div class="profile-header">👤 Profil Pengguna</div>

    {{-- Form Area --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto space-y-8 px-4">
            <div class="form-wrapper">
                <div class="section-title">📄 Informasi Akun</div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="form-wrapper">
                <div class="section-title">🔒 Ubah Password</div>
                @include('profile.partials.update-password-form')
            </div>

            <div class="form-wrapper">
                <div class="section-title">🗑️ Hapus Akun</div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
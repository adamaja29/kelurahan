<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Petugas</title>
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/img/logo.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/img/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('tabler/css/tabler.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <style>
        .login-bg-side {
            background: rgba(247, 250, 252, 0.8);
            border-right: 1px solid rgba(101, 109, 119, 0.16);
        }
        .card-login {
            box-shadow: rgba(35, 46, 60, 0.04) 0px 2px 4px 0px, rgba(35, 46, 60, 0.04) 0px 14px 24px -4px;
            border-radius: 12px;
        }

        .responsive-logo {
            width: 100%;
            max-width: 260px;
            height: auto;
            object-fit: contain;
            /* Efek transisi halus selama 0.4 detik saat ukuran layar berubah */
            transition: max-width 0.4s ease-in-out, transform 0.3s ease;
        }

        /* .responsive-logo:hover {
            transform: scale(1.03);
        } */

        @media (min-width: 1400px) {
            .responsive-logo {
                max-width: 320px;
            }
        }

        @media (max-width: 1199.98px) {
            .responsive-logo {
                max-width: 200px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column bg-white">
    <div class="row g-0 flex-fill vh-100">
        
        <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center p-5 login-bg-side">
            <div class="text-center" style="max-width: 450px;">
                <img src="{{ asset('asset/img/logo.png') }}" class="responsive-logo mb-4" alt="Logo Aplikasi">
                <h1 class="text-dark mb-2">Selamat Datang Kembali</h1>
                <p class="text-secondary fs-3">Silahkan masuk menggunakan akun petugas Anda untuk mengakses sistem manajemen.</p>
            </div>
        </div>
        
        <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center p-4">
            <div class="container-tight">
                
                <div class="text-center mb-4 d-lg-none">
                    <img src="{{ asset('asset/img/logo.png') }}" height="70" style="object-fit: contain;" alt="Logo Mobile">
                    <h2 class="mt-3 mb-1">Login Akun</h2>
                    <p class="text-secondary small">Masuk ke dashboard petugas</p>
                </div>

                <div class="card card-md card-login">
                    <div class="card-body py-5">
                        <h2 class="h2 text-center mb-4 d-none d-lg-block">Login ke Akun Anda</h2>

                        @if (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <div class="d-flex">
                                    <div><i class="bi bi-exclamation-triangle-fill me-2"></i></div>
                                    <div>{{ session('warning') }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('prosesLoginPetugas') }}" method="POST" autocomplete="off" novalidate="">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label required">Alamat Email</label>
                                <div class="input-icon">
                                    <!-- <span class="input-icon-addon">
                                        <i class="bi bi-envelope text-secondary"></i>
                                    </span> -->
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="nama@email.com" autocomplete="off" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label required">
                                    Password
                                    <span class="form-label-description">
                                        <a href="./forgot-password.html" class="text-muted small">Lupa password?</a>
                                    </span>
                                </label>
                                <div class="input-group input-group-flat">
                                    <!-- <span class="input-group-text px-3">
                                        <i class="bi bi-lock text-secondary"></i>
                                    </span> -->
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukkan password" autocomplete="off" required>
                                    <span class="input-group-text px-3">
                                        <a href="#" id="togglePassword" class="link-secondary" title="Lihat Password" data-bs-toggle="tooltip">
                                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-check text-muted user-select-none">
                                    <input type="checkbox" name="remember" class="form-check-input">
                                    <span class="form-check-label font-weight-normal">Ingat saya di perangkat ini</span>
                                </label>
                            </div>
                            
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-lg w-100 btn-pill shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('tabler/js/tabler.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && passwordInput && eyeIcon) {
                togglePassword.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    if (type === 'text') {
                        eyeIcon.innerHTML = `
                            <path d="M10.586 10.586a2 2 0 1 0 2.828 2.828" />
                            <path d="M16.681 16.673a8.617 8.617 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                            <path d="M3 3l18 18" />
                        `;
                        togglePassword.setAttribute('title', 'Sembunyikan Password');
                    } else {
                        eyeIcon.innerHTML = `
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                        `;
                        togglePassword.setAttribute('title', 'Lihat Password');
                    }
                });
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Media Pembelajaran DDPK (SMKN 1 Rao Selatan)</title>
    
    {{-- Google Fonts - Plus Jakarta Sans & Bootstrap Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Bootstrap lokal via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: #f0fdf4;
            min-height: 100vh;
        }

        /* Split-panel styling */
        .decor-shape {
            position: absolute;
            background: rgba(250, 204, 21, 0.06);
            border-radius: 50%;
            pointer-events: none;
        }
        .shape-1 {
            width: 320px;
            height: 320px;
            top: -120px;
            left: -120px;
        }
        .shape-2 {
            width: 480px;
            height: 480px;
            bottom: -180px;
            right: -100px;
            background: linear-gradient(185deg, rgba(250, 204, 21, 0.08) 0%, rgba(250, 204, 21, 0) 70%);
        }
        .shape-3 {
            width: 200px;
            height: 200px;
            top: 25%;
            right: -50px;
            background: rgba(255, 255, 255, 0.04);
        }

        /* Float & pulse animations */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.85; }
            50% { transform: scale(1.04); opacity: 1; }
            100% { transform: scale(1); opacity: 0.85; }
        }
        @keyframes subtle-slide {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .float-element {
            animation: float 6s ease-in-out infinite;
        }
        .pulse-element {
            animation: pulse 4s ease-in-out infinite;
        }
        .animate-fade-up {
            animation: subtle-slide 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Custom Role Selector Cards */
        .role-card {
            cursor: pointer;
            border: 2px solid #dcfce7;
            background-color: #ffffff;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .role-card:hover {
            border-color: #86efac;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(14, 89, 52, 0.08);
        }
        .role-icon-wrapper {
            width: 56px;
            height: 56px;
            background-color: #f0fdf4;
            color: #166534;
            transition: all 0.3s ease;
        }
        .role-title {
            color: #4b5563;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .active-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #eab308;
            color: #06371d;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            border: 2px solid #ffffff;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 6px rgba(234, 179, 8, 0.4);
        }

        /* Active State */
        .role-card.active {
            border-color: #0e5934 !important;
            background-color: #f0fdf4;
            box-shadow: 0 10px 20px -5px rgba(14, 89, 52, 0.15);
        }
        .role-card.active .role-icon-wrapper {
            background: linear-gradient(135deg, #facc15 0%, #eab308 100%) !important;
            color: #06371d !important;
            box-shadow: 0 4px 12px rgba(234, 179, 8, 0.35);
        }
        .role-card.active .role-title {
            color: #0e5934 !important;
            font-weight: 700;
        }
        .role-card.active .active-badge {
            opacity: 1;
            transform: scale(1);
        }

        /* Input styling */
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: stretch;
            width: 100%;
            transition: all 0.2s ease;
        }
        .input-group-custom .input-group-text {
            background-color: #f8fafc;
            border: 1.5px solid #dcfce7;
            border-right: none;
            color: #166534;
            transition: all 0.2s ease;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .input-group-custom .form-control {
            border: 1.5px solid #dcfce7;
            border-left: none;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }
        .input-group-custom .form-control:focus {
            outline: none;
            box-shadow: none;
        }
        /* focus states */
        .input-group-custom:focus-within .input-group-text {
            border-color: #0e5934;
            color: #0e5934;
            background-color: #f0fdf4;
        }
        .input-group-custom:focus-within .form-control {
            border-color: #0e5934;
        }
        .input-group-custom:focus-within {
            box-shadow: 0 0 0 4px rgba(14, 89, 52, 0.15);
            border-radius: 8px;
        }

        /* Toggle password btn overrides */
        .input-group-custom .btn-toggle-pwd {
            border: 1.5px solid #dcfce7;
            border-left: none;
            background-color: #f8fafc;
            color: #64748b;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            transition: all 0.2s ease;
        }
        .input-group-custom:focus-within .btn-toggle-pwd {
            border-color: #0e5934;
        }
        .input-group-custom .btn-toggle-pwd:hover {
            color: #0e5934;
            background-color: #f0fdf4;
        }
        .input-group-custom .form-control.has-toggle {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right: none;
        }

        /* Custom alert styles */
        .alert-custom-danger {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444 !important;
        }
        .alert-custom-warning {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b !important;
        }
        .alert-icon-circle {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* 3D Submit Button in School Building Emerald Green */
        .btn-login {
            background: linear-gradient(180deg, #15803d 0%, #0e5934 100%) !important;
            border: none !important;
            border-top: 1px solid rgba(255, 255, 255, 0.35) !important;
            color: #ffffff !important;
            font-weight: 700;
            letter-spacing: 0.02em;
            padding: 0.85rem;
            border-radius: 8px;
            box-shadow: 0 4px 0 #052e16, 0 6px 14px rgba(14, 89, 52, 0.35) !important;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-login:hover {
            background: linear-gradient(180deg, #16a34a 0%, #15803d 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 0 #052e16, 0 8px 18px rgba(14, 89, 52, 0.45) !important;
            color: #ffffff !important;
        }
        .btn-login:active {
            transform: translateY(3px) !important;
            box-shadow: 0 1px 0 #052e16, 0 2px 4px rgba(14, 89, 52, 0.2) !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            
            {{-- Banner Side (Desktop Only) - SMKN 1 Rao Selatan Emerald & Gold Facade --}}
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-between p-5 text-white position-relative overflow-hidden" 
                 style="background: linear-gradient(145deg, rgba(14, 89, 52, 0.92) 0%, rgba(6, 55, 29, 0.96) 100%), url('{{ asset('images/gedung-smkn1-raoselatan.jpg') }}') center/cover no-repeat;">
                <!-- Decorative Shapes -->
                <div class="decor-shape shape-1"></div>
                <div class="decor-shape shape-2"></div>
                <div class="decor-shape shape-3"></div>
                
                {{-- School & University Branding --}}
                <div class="brand-info z-1 animate-fade-up">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('images/logo-upgrisba.png') }}" alt="Logo Universitas PGRI Sumatera Barat" style="height: 58px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));">
                            <img src="{{ asset('images/logo-smkn1-raoselatan.png') }}" alt="Logo SMK Negeri 1 Rao Selatan" style="height: 58px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));">
                        </div>
                        <div>
                            <h4 class="mb-0 fw-extrabold tracking-tight text-uppercase" style="color: #fde047; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">SMK Negeri 1 Rao Selatan</h4>
                            <p class="mb-0 small fw-medium" style="color: #bbf7d0;">Media Pembelajaran DDPK • Universitas PGRI Sumatera Barat</p>
                        </div>
                    </div>
                </div>
                
                {{-- School Building Photo Showcase --}}
                <div class="illustration-area z-1 text-center my-auto d-flex flex-column align-items-center justify-content-center w-100 animate-fade-up">
                    <div class="position-relative mb-4 w-100" style="max-width: 440px;">
                        <div class="rounded-4 overflow-hidden shadow-lg position-relative" 
                             style="border: 3px solid rgba(250, 204, 21, 0.85) !important; box-shadow: 0 20px 40px rgba(0,0,0,0.5) !important;">
                            <img src="{{ asset('images/gedung-smkn1-raoselatan.jpg') }}" alt="Gedung RPS Multimedia SMKN 1 Rao Selatan" 
                                 style="width: 100%; height: 230px; object-fit: cover; transform: scale(1.01);">
                            
                            {{-- Overlay badge at the bottom of the photo --}}
                            <div class="position-absolute bottom-0 start-0 end-0 p-3 text-start d-flex justify-content-between align-items-end" 
                                 style="background: linear-gradient(to top, rgba(6, 55, 29, 0.95) 0%, rgba(6, 55, 29, 0.4) 60%, rgba(6, 55, 29, 0) 100%);">
                                <div>
                                    <span class="badge px-2 py-1 rounded-pill small fw-bold mb-1" style="background-color: #facc15; color: #06371d;">
                                        🏢 Ruang Praktik Siswa (RPS)
                                    </span>
                                    <h6 class="fw-extrabold text-white mb-0" style="font-size: 1.05rem; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">
                                        SMKN 1 Rao Selatan
                                    </h6>
                                </div>
                                <span class="badge bg-white bg-opacity-20 text-white border border-white border-opacity-25 px-2 py-1 small">
                                    Elemen DDPK
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="fw-extrabold mb-2" style="color: #fde047; text-shadow: 0 2px 4px rgba(0,0,0,0.4);">Mulai Petualangan Belajarmu!</h4>
                    <p class="small max-w-xs px-3 mb-0" style="color: #dcfce7; line-height: 1.6; font-size: 0.92rem;">
                        Pahami Elemen Pemrograman Dasar dengan modul interaktif, latihan soal terstruktur, dan proyek praktikum di SMKN 1 Rao Selatan.
                    </p>
                </div>
                
                {{-- Footer Info --}}
                <div class="footer-note z-1 small animate-fade-up" style="color: #bbf7d0;">
                    <p class="mb-0">&copy; {{ date('Y') }} Media Pembelajaran DDPK. Universitas PGRI Sumatera Barat & SMK Negeri 1 Rao Selatan.</p>
                </div>
            </div>
            
            {{-- Form Side (Pastel Fresh Green Canvas) --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5" style="background-color: #f0fdf4;">
                <div class="w-100" style="max-width: 440px;">
                    
                    {{-- Logo & Mobile Header --}}
                    <div class="text-center d-lg-none mb-4 animate-fade-up">
                        <div class="rounded-3 overflow-hidden shadow-sm mb-3 border border-warning" style="max-height: 140px;">
                            <img src="{{ asset('images/gedung-smkn1-raoselatan.jpg') }}" alt="Gedung SMKN 1 Rao Selatan" style="width: 100%; height: 140px; object-fit: cover;">
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-2">
                            <img src="{{ asset('images/logo-upgrisba.png') }}" alt="Logo UPGRISBA" style="height: 48px; width: auto; object-fit: contain;">
                            <img src="{{ asset('images/logo-smkn1-raoselatan.png') }}" alt="Logo SMKN 1 Rao Selatan" style="height: 48px; width: auto; object-fit: contain;">
                        </div>
                        <h5 class="mb-0 fw-extrabold text-dark tracking-tight">SMK Negeri 1 Rao Selatan</h5>
                        <p class="mb-0 small text-muted">Media Pembelajaran Interaktif DDPK • UPGRISBA</p>
                    </div>
                    
                    {{-- Form Card --}}
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate-fade-up" 
                         style="animation-delay: 0.1s; border: 1.5px solid #dcfce7 !important; box-shadow: 0 12px 35px rgba(14, 89, 52, 0.09) !important;">
                        <div class="card-body p-4 p-md-5">
                            
                            {{-- Welcome Title with Logos --}}
                            <div class="text-center mb-4">
                                <div class="d-none d-lg-flex align-items-center justify-content-center gap-3 mb-3">
                                    <img src="{{ asset('images/logo-upgrisba.png') }}" alt="Logo UPGRISBA" style="height: 48px; width: auto; object-fit: contain;" title="Universitas PGRI Sumatera Barat">
                                    <div style="width: 1px; height: 32px; background-color: #cbd5e1;"></div>
                                    <img src="{{ asset('images/logo-smkn1-raoselatan.png') }}" alt="Logo SMKN 1 Rao Selatan" style="height: 48px; width: auto; object-fit: contain;" title="SMK Negeri 1 Rao Selatan">
                                </div>
                                <h3 class="fw-extrabold mb-1" style="color: #0e5934;">Selamat Datang!</h3>
                                <p class="small fw-medium mb-0" style="color: #475569;">Silakan masuk menggunakan akun yang terdaftar</p>
                            </div>
                            
                            {{-- Custom Alerts --}}
                            @if ($errors->has('login'))
                                <div class="alert alert-custom-danger alert-dismissible fade show border-0 d-flex align-items-center p-3 mb-4 rounded-3" role="alert">
                                    <div class="alert-icon-circle me-3 d-flex align-items-center justify-content-center text-white bg-danger rounded-circle" style="width: 32px; height: 32px; min-width: 32px;">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </div>
                                    <div class="flex-grow-1 text-danger small font-semibold">
                                        {{ $errors->first('login') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: 1rem; right: 1rem;"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-custom-warning alert-dismissible fade show border-0 d-flex align-items-center p-3 mb-4 rounded-3" role="alert">
                                    <div class="alert-icon-circle me-3 d-flex align-items-center justify-content-center text-white bg-warning rounded-circle" style="width: 32px; height: 32px; min-width: 32px;">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </div>
                                    <div class="flex-grow-1 text-warning-emphasis small font-semibold">
                                        {{ session('error') }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="top: 1rem; right: 1rem;"></button>
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                {{-- Role Selection UI (Siswa / Guru) --}}
                                <div class="mb-4">
                                    <label class="form-label d-block text-center mb-3 text-muted fw-bold small text-uppercase tracking-wider">Login Sebagai</label>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="role-card p-3 text-center d-flex flex-column align-items-center justify-content-center" data-role="siswa" id="role-siswa-card">
                                                <div class="role-icon-wrapper rounded-circle mb-2 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-mortarboard-fill fs-3"></i>
                                                </div>
                                                <span class="fw-bold role-title">Siswa</span>
                                                <div class="active-badge"><i class="bi bi-check-lg"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="role-card p-3 text-center d-flex flex-column align-items-center justify-content-center" data-role="guru" id="role-guru-card">
                                                <div class="role-icon-wrapper rounded-circle mb-2 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-workspace fs-3"></i>
                                                </div>
                                                <span class="fw-bold role-title">Guru</span>
                                                <div class="active-badge"><i class="bi bi-check-lg"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Hidden input for target request, synced via JS --}}
                                    <input type="hidden" id="type" name="type" value="{{ old('type') }}" required>
                                    @error('type')
                                        <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Username Field --}}
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold text-muted small text-uppercase">Username</label>
                                    <div class="input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" class="form-control" id="username" name="username"
                                               placeholder="Masukkan username Anda" value="{{ old('username') }}" required autofocus>
                                    </div>
                                    @error('username')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Password Field --}}
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold text-muted small text-uppercase">Password</label>
                                    <div class="input-group-custom">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control has-toggle" id="password" name="password" 
                                               placeholder="Masukkan password Anda" required>
                                        <button class="btn btn-toggle-pwd" type="button" id="togglePassword">
                                            <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle-fill me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                {{-- Submit 3D Button --}}
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-login w-100">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    {{-- Small Copyright --}}
                    <p class="text-center text-muted small mt-4">
                        &copy; {{ date('Y') }} Media Pembelajaran DDPK. SMKN 1 Rao Selatan.
                    </p>
                </div>
            </div>
            
        </div>
    </div>

    {{-- Interactive Javascripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Interactive Role Selector logic
            const btnSiswa = document.getElementById('role-siswa-card');
            const btnGuru = document.getElementById('role-guru-card');
            const roleInput = document.getElementById('type');

            function setRole(role) {
                roleInput.value = role;
                if (role === 'siswa') {
                    btnSiswa.classList.add('active');
                    btnGuru.classList.remove('active');
                } else if (role === 'guru') {
                    btnGuru.classList.add('active');
                    btnSiswa.classList.remove('active');
                }
            }

            btnSiswa.addEventListener('click', () => setRole('siswa'));
            btnGuru.addEventListener('click', () => setRole('guru'));

            // Set initial selection state based on old values or default
            const initialRole = roleInput.value;
            if (initialRole === 'siswa' || initialRole === 'guru') {
                setRole(initialRole);
            } else {
                // Default to 'siswa' for friendly student-first experience
                setRole('siswa');
            }

            // Interactive Password Show/Hide logic
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (togglePassword && passwordField && eyeIcon) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    
                    if (type === 'password') {
                        eyeIcon.className = 'bi bi-eye-fill';
                    } else {
                        eyeIcon.className = 'bi bi-eye-slash-fill';
                    }
                });
            }
        });
    </script>
</body>
</html>

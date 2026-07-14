<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Media Pembelajaran DDPK</title>
    
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
            background-color: #f8fafc;
            min-height: 100vh;
        }

        /* Split-panel styling */
        .decor-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.04);
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
            background: linear-gradient(185deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
        }
        .shape-3 {
            width: 200px;
            height: 200px;
            top: 25%;
            right: -50px;
            background: rgba(255, 255, 255, 0.02);
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

        /* Banner Card */
        .info-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* Custom Role Selector Cards */
        .role-card {
            cursor: pointer;
            border: 2px solid #e2e8f0;
            background-color: #ffffff;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .role-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }
        .role-icon-wrapper {
            width: 56px;
            height: 56px;
            background-color: #f8fafc;
            color: #64748b;
            transition: all 0.3s ease;
        }
        .role-title {
            color: #64748b;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .active-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #206bc4;
            color: #ffffff;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            border: 2px solid #ffffff;
            opacity: 0;
            transform: scale(0.5);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 4px rgba(32, 107, 196, 0.3);
        }

        /* Active State */
        .role-card.active {
            border-color: #206bc4 !important;
            background-color: rgba(32, 107, 196, 0.04);
            box-shadow: 0 10px 20px -5px rgba(32, 107, 196, 0.15);
        }
        .role-card.active .role-icon-wrapper {
            background-color: #206bc4 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(32, 107, 196, 0.25);
        }
        .role-card.active .role-title {
            color: #206bc4 !important;
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
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: #94a3b8;
            transition: all 0.2s ease;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .input-group-custom .form-control {
            border: 1.5px solid #e2e8f0;
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
            border-color: #206bc4;
            color: #206bc4;
        }
        .input-group-custom:focus-within .form-control {
            border-color: #206bc4;
        }
        .input-group-custom:focus-within {
            box-shadow: 0 0 0 4px rgba(32, 107, 196, 0.12);
            border-radius: 8px;
        }

        /* Toggle password btn overrides */
        .input-group-custom .btn-toggle-pwd {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            background-color: #f8fafc;
            color: #94a3b8;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            transition: all 0.2s ease;
        }
        .input-group-custom:focus-within .btn-toggle-pwd {
            border-color: #206bc4;
        }
        .input-group-custom .btn-toggle-pwd:hover {
            color: #206bc4;
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

        /* Submit Button */
        .btn-login {
            background: linear-gradient(135deg, #206bc4 0%, #1756a0 100%);
            border: none;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 0.02em;
            padding: 0.8rem;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #1756a0 0%, #0e3d75 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(32, 107, 196, 0.3);
        }
        .btn-login:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            
            {{-- Banner Side (Desktop Only) --}}
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-between p-5 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                <!-- Decorative Shapes -->
                <div class="decor-shape shape-1"></div>
                <div class="decor-shape shape-2"></div>
                <div class="decor-shape shape-3"></div>
                
                {{-- School Branding --}}
                <div class="brand-info z-1 animate-fade-up">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 56px; height: 56px;">
                            <i class="bi bi-code-slash fs-3 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-extrabold tracking-tight text-uppercase">SMK Negeri 1 Rao Selatan</h4>
                            <p class="mb-0 small text-white-50 fw-semibold">Media Pembelajaran Interaktif DDPK</p>
                        </div>
                    </div>
                </div>
                
                {{-- Interactive Coding Illustration --}}
                <div class="illustration-area z-1 text-center my-auto d-flex flex-column align-items-center justify-content-center">
                    <svg class="float-element mb-4" width="340" height="260" viewBox="0 0 320 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="filter: drop-shadow(0 20px 30px rgba(0,0,0,0.25));">
                        <!-- Screen background -->
                        <rect x="40" y="20" width="240" height="150" rx="12" fill="#1e1e2f" stroke="#374151" stroke-width="4"/>
                        <!-- Laptop keyboard base -->
                        <path d="M10 180H310C315 180 320 184 320 189V192C320 197 315 202 310 202H10C5 202 0 197 0 192V189C0 184 5 180 10 180Z" fill="#e2e8f0"/>
                        <rect x="130" y="180" width="60" height="8" fill="#cbd5e1" rx="4"/>
                        <rect x="120" y="190" width="80" height="6" fill="#94a3b8" rx="3"/>
                        
                        <!-- Code lines on screen -->
                        <rect x="55" y="35" width="45" height="6" rx="3" fill="#f43f5e" />
                        <rect x="110" y="35" width="80" height="6" rx="3" fill="#10b981" />
                        <rect x="70" y="50" width="120" height="6" rx="3" fill="#06b6d4" />
                        <rect x="70" y="65" width="90" height="6" rx="3" fill="#f59e0b" />
                        <rect x="85" y="80" width="60" height="6" rx="3" fill="#f43f5e" />
                        <rect x="155" y="80" width="50" height="6" rx="3" fill="#eab308" />
                        <rect x="70" y="95" width="140" height="6" rx="3" fill="#8b5cf6" />
                        <rect x="55" y="110" width="50" height="6" rx="3" fill="#f43f5e" />
                        <rect x="55" y="125" width="80" height="6" rx="3" fill="#10b981" />
                        
                        <!-- Floating icons/particles -->
                        <!-- Brackets {} -->
                        <g class="pulse-element" style="animation-delay: 0.5s;">
                            <circle cx="35" cy="80" r="16" fill="rgba(255, 255, 255, 0.1)" stroke="rgba(255, 255, 255, 0.25)" stroke-width="1.5"/>
                            <text x="29" y="86" fill="#f43f5e" font-family="monospace" font-weight="bold" font-size="16">{ }</text>
                        </g>
                        <!-- Code tag </> -->
                        <g class="pulse-element" style="animation-delay: 1.5s;">
                            <circle cx="285" cy="90" r="20" fill="rgba(16, 185, 129, 0.15)" stroke="#10b981" stroke-width="1.5"/>
                            <text x="274" y="96" fill="#10b981" font-family="monospace" font-weight="bold" font-size="15">&lt;/&gt;</text>
                        </g>
                        <!-- Star icon -->
                        <g class="pulse-element" style="animation-delay: 1s;">
                            <circle cx="80" cy="180" r="12" fill="rgba(245, 158, 11, 0.15)" stroke="#f59e0b" stroke-width="1.5"/>
                            <path d="M80 174L82 178H86L83 181L84 185L80 183L76 185L77 181L74 178H78L80 174Z" fill="#f59e0b"/>
                        </g>
                        <!-- Lightbulb icon -->
                        <g class="pulse-element" style="animation-delay: 2s;">
                            <circle cx="240" cy="185" r="14" fill="rgba(234, 179, 8, 0.15)" stroke="#eab308" stroke-width="1.5"/>
                            <text x="234" y="191" fill="#eab308" font-family="serif" font-weight="bold" font-size="16">💡</text>
                        </g>
                    </svg>
                    
                    <h5 class="fw-bold mb-1">Mulai Petualangan Belajarmu!</h5>
                    <p class="text-white-50 small max-w-xs px-4">Pahami Elemen Pemrograman Dasar dengan mudah, kumpulkan tugas tepat waktu, dan pantau progres belajarmu.</p>
                </div>
                
                {{-- Footer Info --}}
                <div class="footer-note z-1 text-white-50 small animate-fade-up">
                    <p class="mb-0">&copy; {{ date('Y') }} Media Pembelajaran DDPK. Dibuat khusus untuk SMK Negeri 1 Rao Selatan.</p>
                </div>
            </div>
            
            {{-- Form Side --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5 bg-light">
                <div class="w-100" style="max-width: 440px;">
                    
                    {{-- Logo & Mobile Header --}}
                    <div class="text-center d-lg-none mb-4 animate-fade-up">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center shadow mb-2" style="width: 52px; height: 52px;">
                            <i class="bi bi-code-slash fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 fw-extrabold text-dark tracking-tight">SMK Negeri 1 Rao Selatan</h5>
                        <p class="mb-0 small text-muted">Media Pembelajaran Interaktif DDPK</p>
                    </div>
                    
                    {{-- Form Card --}}
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate-fade-up" style="animation-delay: 0.1s;">
                        <div class="card-body p-4 p-md-5">
                            
                            {{-- Welcome Title --}}
                            <div class="text-center mb-4">
                                <h3 class="fw-extrabold text-primary mb-1">Selamat Datang!</h3>
                                <p class="text-muted small">Silakan masuk menggunakan akun yang terdaftar</p>
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
                                                <div class="active-badge"><i class="bi bi-check-circle-fill"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="role-card p-3 text-center d-flex flex-column align-items-center justify-content-center" data-role="guru" id="role-guru-card">
                                                <div class="role-icon-wrapper rounded-circle mb-2 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person-workspace fs-3"></i>
                                                </div>
                                                <span class="fw-bold role-title">Guru</span>
                                                <div class="active-badge"><i class="bi bi-check-circle-fill"></i></div>
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
                                
                                {{-- Submit --}}
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
                        &copy; {{ date('Y') }} Media Pembelajaran DDPK.
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Media Pembelajaran DDPK')</title>
    {{-- Bootstrap lokal via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="border-end">
            <div class="sidebar-heading fw-bold py-3 px-3 d-flex align-items-center gap-2 border-bottom">
                <img src="{{ asset('images/logo-smkn1-raoselatan.png') }}" alt="Logo SMKN 1 Rao Selatan" style="width: 38px; height: 38px; object-fit: contain;">
                <div>
                    <span class="fs-6 fw-extrabold d-block lh-1" style="color: #fde047 !important; letter-spacing: -0.01em;">Media DDPK</span>
                    <span class="fw-semibold" style="font-size: 0.72rem; color: #bbf7d0 !important;">SMKN 1 Rao Selatan</span>
                </div>
            </div>
            <div class="list-group list-group-flush mt-2">
                @if(Auth::guard('guru')->check())
                    <a href="{{ route('guru.dashboard') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('guru.siswa.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.siswa.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Data Siswa
                    </a>
                    <a href="{{ route('guru.materi.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.materi.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                        Materi
                    </a>
                    <a href="{{ route('guru.tugas.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.tugas.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        Tugas
                    </a>
                    <a href="{{ route('guru.penilaian.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.penilaian.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        Penilaian
                    </a>
                    <a href="{{ route('guru.rekap.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.rekap.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                        Rekap Progres
                    </a>
                    <a href="{{ route('guru.petunjuk.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('guru.petunjuk.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        Petunjuk Penggunaan
                    </a>
                @elseif(Auth::guard('siswa')->check())
                    <a href="{{ route('siswa.dashboard') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('siswa.dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('siswa.materi.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('siswa.materi.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                        Materi
                    </a>
                    <a href="{{ route('siswa.tugas.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('siswa.tugas.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        Tugas
                    </a>
                    <a href="{{ route('siswa.nilai.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('siswa.nilai.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                        Nilai & Progres
                    </a>
                    <a href="{{ route('siswa.petunjuk.index') }}" class="list-group-item list-group-item-action py-3 {{ Route::is('siswa.petunjuk.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        Petunjuk Penggunaan
                    </a>
                @endif
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary d-flex align-items-center gap-1" id="sidebarToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                        <span>Menu</span>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        @if(Auth::guard('guru')->check())
                            <a href="{{ route('guru.petunjuk.index') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 me-3" title="Petunjuk Penggunaan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                <span class="d-none d-sm-inline">Bantuan</span>
                            </a>
                        @elseif(Auth::guard('siswa')->check())
                            <a href="{{ route('siswa.petunjuk.index') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 me-3" title="Petunjuk Penggunaan">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                <span class="d-none d-sm-inline">Bantuan</span>
                            </a>
                        @endif

                        <span class="navbar-text me-3 fw-medium text-dark d-flex align-items-center gap-2">
                            <span class="avatar bg-blue-lt text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%; background-color: rgba(32, 107, 196, 0.1); font-size: 0.85rem;">
                                @if(Auth::guard('guru')->check())
                                    G
                                @elseif(Auth::guard('siswa')->check())
                                    S
                                @endif
                            </span>
                            @if(Auth::guard('guru')->check())
                                {{ Auth::guard('guru')->user()->nama }} (Guru)
                            @elseif(Auth::guard('siswa')->check())
                                {{ Auth::guard('siswa')->user()->nama }} (Siswa)
                            @endif
                        </span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

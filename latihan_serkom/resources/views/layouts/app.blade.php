<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00a65a',
                        dark: '#1e282c',
                        darker: '#171e22',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Sidebar transition */
        #sidebar {
            transition: width 0.3s ease, transform 0.3s ease;
        }
        #sidebar.collapsed {
            width: 68px;
        }
        #sidebar.collapsed .sidebar-text,
        #sidebar.collapsed .sidebar-header-text,
        #sidebar.collapsed .sidebar-footer {
            display: none;
        }
        #sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        #sidebar.collapsed .sidebar-icon {
            margin-right: 0;
        }
        #sidebar.collapsed .sidebar-logo {
            justify-content: center;
        }
        #sidebar.collapsed .user-panel-text {
            display: none;
        }
        #sidebar.collapsed .user-panel {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        #sidebar.collapsed .section-title {
            display: none;
        }
        #sidebar.collapsed .section-divider {
            display: block;
            border-top: 1px solid #374151;
            margin: 8px 12px;
        }
        .section-divider {
            display: none;
        }

        /* Tooltip saat collapsed */
        #sidebar.collapsed .sidebar-link {
            position: relative;
        }
        #sidebar.collapsed .sidebar-link:hover::after {
            content: attr(data-title);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #374151;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            margin-left: 8px;
            z-index: 50;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased">

    @auth
    <div class="flex min-h-screen">

        {{-- ========== SIDEBAR ========== --}}
        <aside id="sidebar" class="w-64 bg-dark text-gray-300 flex-shrink-0 hidden md:flex flex-col">

            {{-- Logo --}}
            <div class="sidebar-logo h-14 bg-darker flex items-center px-4 border-b border-gray-700">
                <div class="w-8 h-8 bg-primary rounded flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="sidebar-header-text ml-2 font-bold text-white text-sm tracking-wide whitespace-nowrap">
                    PENGADUAN APP
                </span>
            </div>

            {{-- User Panel --}}
            <div class="user-panel p-4 border-b border-gray-700 flex items-center">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-panel-text ml-3 overflow-hidden">
                    <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>
                </div>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 overflow-y-auto py-2 text-sm">

                {{-- Section: General --}}
                <p class="section-title px-4 py-2 text-xs uppercase text-gray-500 font-semibold tracking-wider">General</p>
                <div class="section-divider"></div>

                <a href="{{ route('dashboard') }}" data-title="Dashboard"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('dashboard') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">Dashboard</span>
                </a>

                @if(auth()->user()->isAdmin())
                {{-- Section: Operasional --}}
                <p class="section-title px-4 py-2 mt-3 text-xs uppercase text-gray-500 font-semibold tracking-wider">Operasional</p>
                <div class="section-divider"></div>

                <a href="{{ route('users.index') }}" data-title="User"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('users.*') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">User</span>
                </a>

                <a href="{{ route('barang.index') }}" data-title="Barang"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('barang.*') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">Barang</span>
                </a>

                <a href="{{ route('makanan-minuman.index') }}" data-title="Makanan / Minuman"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('makanan-minuman.*') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">Makanan / Minuman</span>
                </a>
                @endif

                @if(auth()->user()->isPetugas())
                <a href="{{ route('pelayanan.index') }}" data-title="Pelayanan"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('pelayanan.*') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">Pelayanan</span>
                </a>
                @endif

                @if(auth()->user()->isCustomer())
                <p class="section-title px-4 py-2 mt-3 text-xs uppercase text-gray-500 font-semibold tracking-wider">Akun</p>
                <div class="section-divider"></div>

                <a href="{{ route('profil.edit') }}" data-title="Profil Saya"
                   class="sidebar-link flex items-center px-4 py-2.5 hover:bg-darker hover:text-white border-l-4 {{ request()->routeIs('profil.*') ? 'bg-darker text-white border-primary' : 'border-transparent' }}">
                    <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap">Profil Saya</span>
                </a>
                @endif
            </nav>

            {{-- Footer --}}
            <div class="sidebar-footer p-3 text-xs text-gray-500 border-t border-gray-700 whitespace-nowrap">
                &copy; {{ date('Y') }} Pengaduan App
            </div>
        </aside>

        {{-- ========== MAIN CONTENT ========== --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="h-14 bg-white border-b border-gray-200 flex items-center justify-between px-6 shadow-sm">
                <div class="flex items-center">
                    {{-- Toggle Sidebar Button --}}
                    <button id="sidebarToggle" class="text-gray-500 hover:text-primary mr-4 p-1 rounded hover:bg-gray-100" title="Toggle Sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-base font-semibold text-gray-700">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..."
                               class="pl-9 pr-4 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary w-64">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <button class="text-gray-500 hover:text-primary relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <div class="flex items-center border-l border-gray-200 pl-4">
                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="ml-3">
                            @csrf
                            <button class="text-xs text-red-500 hover:text-red-700 font-medium">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-6">

                @if(session('success'))
                    <div class="mb-4 flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 flex items-center bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    @else
        @yield('content')
    @endauth

    {{-- Script Toggle Sidebar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');

            // Cek preferensi tersimpan
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && sidebar) {
                sidebar.classList.add('collapsed');
            }

            if (toggle) {
                toggle.addEventListener('click', function () {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }
        });
    </script>

</body>
</html>
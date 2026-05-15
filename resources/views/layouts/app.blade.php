<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles

    <style>
        :root {
            color-scheme: dark;
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #e5e7eb;
        }

        body {
            background: radial-gradient(circle at top left, rgba(30, 41, 59, 0.9), transparent 22%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.88), transparent 22%),
                #06070a;
            color: #e5e7eb;
        }

        #sidebar {
            backdrop-filter: blur(18px);
            background-color: rgba(15, 23, 42, 0.96);
            border-right: 1px solid rgba(148, 163, 184, 0.18);
        }

        #sidebar-backdrop {
            background: rgba(15, 23, 42, 0.7);
        }

        .nav-link {
            transition: background-color 180ms ease, color 180ms ease;
        }

        .nav-link:hover {
            background-color: rgba(56, 189, 248, 0.12);
            color: #e2e8f0;
        }

        .card-surface {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.16);
            box-shadow: 0 18px 52px rgba(0, 0, 0, 0.55);
        }

        .bg-white,
        .bg-white\/95,
        .bg-slate-50,
        .bg-slate-100,
        .bg-emerald-50 {
            background-color: rgba(15, 23, 42, 0.92) !important;
        }

        .border-slate-200,
        .border-slate-300,
        .border-slate-100,
        .border-black,
        .border-slate-900,
        .border-emerald-200 {
            border-color: rgba(71, 85, 105, 0.35) !important;
        }

        .text-slate-900,
        .text-slate-700,
        .text-slate-600,
        .text-slate-500 {
            color: #d1d5db !important;
        }

        .text-slate-800,
        .text-slate-900 {
            color: #f8fafc !important;
        }

        .bg-slate-900,
        .bg-slate-800,
        .bg-slate-700 {
            background-color: #0f172a !important;
        }
    </style>
</head>
<body class="antialiased text-slate-100">

<div class="flex h-screen overflow-hidden">

    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full transition-transform duration-300 md:translate-x-0 md:shadow-none shadow-2xl">
        <div class="px-8 py-8 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-cyan-500 text-slate-950 text-xl shadow-md shadow-cyan-600/30">A</div>
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-400">Payroll App</p>
                    <h2 class="text-2xl font-semibold text-slate-100">
                        {{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'User Panel' }}
                    </h2>
                </div>
            </div>
        </div>

        <nav class="mt-8 space-y-2 px-6">
            @if(Auth::user()->role === 'admin')
                <a href="/admin" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">🏠 Dashboard</a>
                <a href="/user" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">👤 Users</a>
                <a href="/position" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">📌 Positions</a>
                <a href="/employee" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">👥 Employees</a>
                <a href="/payroll" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">💰 Payroll</a>
                <a href="/admin/attendance" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">🗓 Attendance</a>
            @else
                <a href="/attendance" class="nav-link block rounded-3xl px-4 py-3 text-sm font-semibold text-slate-200">🗓 Kehadiran</a>
            @endif
            <a href="/logout" class="mt-6 block rounded-3xl px-4 py-3 text-sm font-semibold text-rose-300 hover:bg-rose-900/40">Logout</a>
        </nav>
    </aside>

    <div id="sidebar-backdrop" class="fixed inset-0 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

    <div class="flex-1 flex flex-col md:ml-72">
        <header class="sticky top-0 z-20 border-b border-slate-700 bg-slate-950/95 backdrop-blur px-5 py-4 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <button onclick="toggleSidebar()" class="md:hidden rounded-2xl border border-slate-700 bg-slate-800 px-3 py-2 text-slate-100 shadow-sm shadow-slate-900/30">
                    ☰ Menu
                </button>
                <div>
                    <p class="text-sm text-slate-400">Dashboard</p>
                    <h1 class="text-2xl font-semibold text-slate-100">
                        {{ Auth::user()->role === 'admin' ? 'Admin Control Center' : 'User Attendance Center' }}
                    </h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-xs uppercase tracking-[0.25em] text-slate-400">Signed in as</p>
                        <p class="font-semibold text-slate-100">{{ Auth::user()->email }}</p>
                    </div>
                    @php
                        $profileUrl = Auth::user()->profile_photo_path
                            ? asset('storage/'.Auth::user()->profile_photo_path)
                            : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=ffffff&background=6b865b';
                    @endphp
                    <img src="{{ $profileUrl }}" alt="profile" class="h-11 w-11 rounded-3xl border border-slate-200 bg-white object-cover" />
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-5 md:p-8">
            <div class="mx-auto w-full max-w-[1440px] space-y-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>

@livewireScripts
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('sidebar-backdrop').classList.toggle('hidden');
    }

    // Sweet Alert for Session Messages
    @if (session('message'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('message') }}',
            background: '#0f172a',
            color: '#e5e7eb',
            confirmButtonColor: '#38bdf8',
            confirmButtonText: 'OK'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            background: '#0f172a',
            color: '#e5e7eb',
            confirmButtonColor: '#38bdf8'
        });
    @endif

    // Delete confirmation with Sweet Alert
    function confirmDelete(id, name = 'item') {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus ${name}. Tindakan ini tidak dapat dibatalkan!`,
            icon: 'warning',
            background: '#0f172a',
            color: '#e5e7eb',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('destroy', { id: id });
            }
        });
    }
</script>
</body>
</html>
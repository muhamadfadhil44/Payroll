@extends('layouts.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-[32px] card-surface p-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-cyan-400">Dashboard</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-100">Welcome back, Admin</h1>
                    <p class="mt-2 max-w-2xl text-slate-400">Lihat ikhtisar cepat dari data aplikasi penting seperti pengguna, karyawan, gaji, dan absensi.</p>
                </div>
                <div class="inline-flex items-center gap-3 rounded-full bg-cyan-500/20 px-4 py-3 text-sm font-semibold text-cyan-300 shadow-sm">Fresh updates</div>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Total Users</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-100">{{ $users }}</p>
                    <p class="mt-2 text-sm text-slate-500">Jumlah seluruh akun terdaftar.</p>
                </div>
                <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Employees</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-100">{{ $employees }}</p>
                    <p class="mt-2 text-sm text-slate-500">Data karyawan aktif dalam sistem.</p>
                </div>
                <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Payrolls</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-100">{{ $payrolls }}</p>
                    <p class="mt-2 text-sm text-slate-500">Jumlah catatan payroll yang tersimpan.</p>
                </div>
                <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Positions</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-100">{{ $positions }}</p>
                    <p class="mt-2 text-sm text-slate-500">Posisi kerja yang tersedia.</p>
                </div>
                <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">Attendance</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-100">{{ $attendances }}</p>
                    <p class="mt-2 text-sm text-slate-500">Catatan kehadiran terakhir.</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
            <div class="rounded-[32px] card-surface p-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-100">Quick actions</h2>
                        <p class="mt-2 text-slate-400">Langsung ke halaman penting untuk pengelolaan data.</p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Action-ready</span>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    <a href="/user" class="rounded-3xl border border-slate-700 bg-slate-800 px-5 py-4 text-left text-slate-200 transition hover:bg-slate-700">Manage users</a>
                    <a href="/employee" class="rounded-3xl border border-slate-700 bg-slate-800 px-5 py-4 text-left text-slate-200 transition hover:bg-slate-700">Manage employees</a>
                    <a href="/payroll" class="rounded-3xl border border-slate-700 bg-slate-800 px-5 py-4 text-left text-slate-200 transition hover:bg-slate-700">Manage payroll</a>
                    <a href="/admin/attendance" class="rounded-3xl border border-slate-700 bg-slate-800 px-5 py-4 text-left text-slate-200 transition hover:bg-slate-700">View attendances</a>
                </div>
            </div>

            <div class="rounded-[32px] card-surface p-8">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-100">Highlights</h2>
                        <p class="mt-2 text-slate-400">Ringkasan singkat untuk membantu fokus pada tugas utama.</p>
                    </div>
                    <span class="rounded-full bg-slate-800 px-3 py-1 text-sm font-semibold text-slate-300">Live</span>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl border border-slate-700 bg-slate-800 p-4">
                        <p class="text-sm text-slate-400">Karyawan yang baru ditambahkan</p>
                        <p class="mt-2 text-lg font-semibold text-slate-200">5 terakhir</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700 bg-slate-800 p-4">
                        <p class="text-sm text-slate-400">Payroll terproses hari ini</p>
                        <p class="mt-2 text-lg font-semibold text-slate-200">2</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700 bg-slate-800 p-4">
                        <p class="text-sm text-slate-400">Attendance update</p>
                        <p class="mt-2 text-lg font-semibold text-slate-200">Cek halaman kehadiran untuk detail terbaru</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

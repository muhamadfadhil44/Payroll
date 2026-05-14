@extends('layouts.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-[32px] card-surface p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-100">Pengguna</h1>
                    <p class="mt-2 text-slate-400">Tambahkan, edit, dan kelola akses pengguna dengan kontrol yang mudah dipahami.</p>
                </div>
                <div class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Aman dan bersih</div>
            </div>
        </div>

        <div class="rounded-[32px] card-surface p-6">
            @livewire('admin.user')
        </div>
    </section>
@endsection

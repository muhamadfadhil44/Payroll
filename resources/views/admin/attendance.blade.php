@extends('layouts.app')

@section('content')
    <section class="space-y-6">
        <div class="rounded-[32px] card-surface p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-100">Laporan Kehadiran</h1>
                    <p class="mt-2 text-slate-400">Tinjau dan kelola data kehadiran dengan tampilan yang lebih jelas dan ringkas.</p>
                </div>
                <div class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Realtime data</div>
            </div>
        </div>

        <div class="rounded-[32px] card-surface p-6">
            @livewire('admin.attendance')
        </div>
    </section>
@endsection

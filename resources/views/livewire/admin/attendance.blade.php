<div class="space-y-6">
    <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-100">Data Kehadiran</h2>
                <p class="mt-2 text-slate-400">Data absen karyawan terbaru akan ditampilkan di sini.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">{{ $attendances->count() }} catatan</span>
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-700 bg-slate-800/50 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-slate-700/50 text-slate-300 uppercase text-[11px] tracking-[0.18em]">
                    <tr>
                        <th class="px-4 py-4 text-left">#</th>
                        <th class="px-4 py-4 text-left">Nama</th>
                        <th class="px-4 py-4 text-left">Tanggal</th>
                        <th class="px-4 py-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-800/30 divide-y divide-slate-700">
                    @forelse ($attendances as $item)
                        <tr class="border-b hover:bg-slate-700/30 transition">
                            <td class="px-4 py-4 text-slate-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->user?->name ?? '—' }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->date }}</td>
                            <td class="px-4 py-4 capitalize text-slate-300">
                                <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-3 py-1 text-sm font-semibold text-cyan-300">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">Belum ada data kehadiran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
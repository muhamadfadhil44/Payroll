<div class="space-y-6">
    <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-100">Halaman Pegawai</h2>
                <p class="mt-2 text-slate-400">Tambahkan karyawan dan tambahkan gaji dengan tampilan yang rapi.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Karyawan aktif</span>
        </div>

        @if ($errors->any())
            <div class="mt-4 rounded-3xl border border-rose-900 bg-rose-950/30 px-4 py-3 text-sm text-rose-400">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="mt-4 rounded-3xl border border-cyan-900 bg-cyan-950/30 px-4 py-3 text-sm font-semibold text-cyan-400">{{ session('message') }}</div>
        @endif

        <form class="grid gap-5 sm:grid-cols-2" wire:submit.prevent='store'>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">User</label>
                <select wire:model='user_id' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                    <option value="" class="bg-slate-800">--- Pilih User ---</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" class="bg-slate-800">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Position</label>
                <select wire:model='position_id' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                    <option value="" class="bg-slate-800">--- Pilih Position ---</option>
                    @foreach ($positions as $item)
                        <option value="{{ $item->id }}" class="bg-slate-800">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-300">Gaji</label>
                <input wire:model='salary' type="number" placeholder="Masukkan gaji" class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div class="sm:col-span-2 flex flex-wrap gap-3 pt-1">
                @if ($editCheck == false)
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700">Simpan</button>
                @endif
                @if ($editCheck == true)
                    <button wire:click='update({{ $idEdit }})' class="inline-flex items-center justify-center rounded-full bg-slate-700 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-600">Update</button>
                    <button wire:click='clear()' class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/50 px-6 py-3 text-sm font-semibold text-slate-300 transition hover:bg-slate-800">Clear</button>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-700 bg-slate-800/50 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-slate-700/50 text-slate-300 uppercase text-[11px] tracking-[0.18em]">
                    <tr>
                        <th class="px-4 py-4 text-left">#</th>
                        <th class="px-4 py-4 text-left">Username</th>
                        <th class="px-4 py-4 text-left">Position name</th>
                        <th class="px-4 py-4 text-left">Salary</th>
                        <th class="px-4 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-800/30 divide-y divide-slate-700">
                    @foreach ($employees as $item)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-4 py-4 text-slate-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->user->name }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->position->name }}</td>
                            <td class="px-4 py-4 text-slate-300">Rp. {{ number_format($item->salary) }}</td>
                            <td class="px-4 py-4 space-x-2">
                                <button class="rounded-full bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-700" wire:click='destroy({{ $item->id }})'>Hapus</button>
                                @if ($editCheck == false)
                                    <button wire:click='edit({{ $item->id }})' class="rounded-full bg-slate-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-600">Edit</button>
                                @endif
                                @if ($editCheck == true)
                                    <button class="rounded-full bg-slate-700 px-4 py-2 text-sm font-semibold text-slate-300 transition hover:bg-slate-600" wire:click='clear()'>Clear</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
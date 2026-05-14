<div class="space-y-6">
    <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-100">Halaman Payroll</h2>
                <p class="mt-2 text-slate-400">Kelola slip gaji karyawan dengan tampilan yang bersih dan fokus.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Payroll aktif</span>
        </div>

        @if ($errors->any())
            <div class="rounded-3xl border border-rose-900 bg-rose-950/30 px-4 py-3 text-sm text-rose-400">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="rounded-3xl border border-cyan-900 bg-cyan-950/30 px-4 py-3 text-sm font-semibold text-cyan-400">{{ session('message') }}</div>
        @endif

        <form class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4" wire:submit.prevent='store'>
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-300">Employee</label>
                <select wire:model='employee_id' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                    <option value="" class="bg-slate-800">--- Pilih Employee ---</option>
                    @foreach ($employees as $item)
                        <option value="{{ $item->id }}" class="bg-slate-800">{{ $item->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Period</label>
                <input type="date" wire:model='period' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Allowance</label>
                <input type="number" wire:model='allowance' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Deduction</label>
                <input type="number" wire:model='deduction' placeholder="Masukkan deduction" class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>

            <div class="sm:col-span-2 lg:col-span-4 flex flex-wrap items-center gap-3 pt-2">
                @if ($editCheck == false)
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700">Simpan</button>
                @endif
                @if ($editCheck == true)
                    <button wire:click='update({{ $idEdit }})' class="inline-flex items-center justify-center rounded-full bg-slate-700 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-600">Update</button>
                    <button wire:click='clear()' class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/50 px-6 py-3 text-sm font-semibold text-slate-300 transition hover:bg-slate-800">Clear</button>
                @endif
            </div>
        </form>

        <div class="mt-4">
            <input type="text" class="w-full max-w-sm rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" placeholder="Cari payroll..." wire:model.live='keyword' />
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-700 bg-slate-800/50 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-slate-700/50 text-slate-300 uppercase text-[11px] tracking-[0.18em]">
                    <tr>
                        <th class="px-4 py-4 text-left">#</th>
                        <th class="px-4 py-4 text-left">Employee name</th>
                        <th class="px-4 py-4 text-left">Period</th>
                        <th class="px-4 py-4 text-left">Salary</th>
                        <th class="px-4 py-4 text-left">Allowance</th>
                        <th class="px-4 py-4 text-left">Deduction</th>
                        <th class="px-4 py-4 text-left">Net Salary</th>
                        <th class="px-4 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-800/30 divide-y divide-slate-700">
                    @foreach ($payrolls as $item)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-4 py-4 text-slate-300">{{ $loop->iteration }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->employee->user->name }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->period }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ number_format($item->employee->salary) }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ number_format($item->allowance) }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ number_format($item->deduction) }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ number_format($item->net_salary) }}</td>
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
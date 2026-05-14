<div class="space-y-6">
    <div class="rounded-[28px] border border-slate-700 bg-slate-800/50 p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-100">Halaman Pengguna</h2>
                <p class="mt-2 text-slate-400">Tambahkan dan atur pengguna dengan kontrol yang elegan dan mudah digunakan.</p>
            </div>
            <span class="inline-flex items-center rounded-full bg-cyan-500/20 px-4 py-2 text-sm font-semibold text-cyan-300">Manajemen user</span>
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

        <form class="grid gap-5 sm:grid-cols-2" wire:submit.prevent='store'>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Nama</label>
                <input type="text" wire:model='name' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Email</label>
                <input type="email" wire:model='email' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Password</label>
                <input wire:model='password' type="password" placeholder="Masukkan password" class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-300">Role</label>
                <select wire:model='role' class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                    <option value="" class="bg-slate-800">--- Pilih role ---</option>
                    <option value="admin" class="bg-slate-800">Admin</option>
                    <option value="user" class="bg-slate-800">User</option>
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-300">Profile Photo</label>
                <input type="file" wire:model="photo" class="w-full rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" />
                @error('photo')
                    <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                @enderror

                @if ($photo)
                    <div class="mt-4 inline-flex items-center gap-3 rounded-3xl border border-slate-700 bg-slate-900/50 p-4">
                        <img src="{{ $photo->temporaryUrl() }}" alt="preview" class="h-16 w-16 rounded-full object-cover" />
                        <p class="text-sm text-slate-300">Preview foto baru</p>
                    </div>
                @elseif ($existingPhoto)
                    <div class="mt-4 inline-flex items-center gap-3 rounded-3xl border border-slate-700 bg-slate-900/50 p-4">
                        <img src="{{ asset('storage/'.$existingPhoto) }}" alt="existing photo" class="h-16 w-16 rounded-full object-cover" />
                        <p class="text-sm text-slate-300">Foto profil saat ini</p>
                    </div>
                @endif
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

        <div class="mt-4">
            <input type="text" class="w-full max-w-sm rounded-3xl border border-slate-700 bg-slate-900/50 px-4 py-3 text-slate-100 placeholder-slate-600 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30" placeholder="Cari pengguna..." wire:model.live='keyword' />
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-slate-700 bg-slate-800/50 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-700 text-sm">
                <thead class="bg-slate-700/50 text-slate-300 uppercase text-[11px] tracking-[0.18em]">
                    <tr>
                        <th class="px-4 py-4 text-left">#</th>
                        <th class="px-4 py-4 text-left">User</th>
                        <th class="px-4 py-4 text-left">Email</th>
                        <th class="px-4 py-4 text-left">Role</th>
                        <th class="px-4 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-800/30 divide-y divide-slate-700">
                    @foreach ($users as $item)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->profile_photo_path ? asset('storage/'.$item->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($item->name).'&color=000000&background=38bdf8' }}" alt="avatar" class="h-10 w-10 rounded-full object-cover border border-slate-700" />
                                    <span class="text-slate-300">{{ $item->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->email }}</td>
                            <td class="px-4 py-4 text-slate-300">{{ $item->role }}</td>
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
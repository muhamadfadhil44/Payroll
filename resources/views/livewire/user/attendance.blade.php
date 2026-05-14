<div>
    <div class="mb-4 flex gap-2">
        <select class="border rounded p-2" wire:model='status'>
            <option value="">--- Pilih status</option>
            <option value="present">Hadir</option>
            <option value="absent">Tidak Hadir</option>
            <option value="sick">Sakit</option>
            <option value="permit">Izin</option>
        </select>
        <button type="button" wire:click='save'>Save</button>
        @if (session('message'))
            <p>{{session('message')}}</p>
        @endif
    </div>

    <div class="overflow-x-auto">
          <table class="w-full text-sm border">
             <thead>
                <tr class="bg-gray-100 text-xs uppercase text-gray-600">
                    <th class="p-3">#</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Status</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($attendance as $item)
                      <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $item->user->name}}</td>
                        <td class="p-3">{{ $item->date}}</td>
                        <td class="p-3">{{ $item->status}}</td>
                    </tr>
                @endforeach
              
             </tbody>
          </table>
    </div>
</div>

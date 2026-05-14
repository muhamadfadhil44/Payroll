<?php

namespace App\Livewire\Admin;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $role;
    public $photo;
    public $existingPhoto;
    public $editCheck = false;
    public $idEdit;
    public $keyword;

    public function render()
    {
        $users = ModelsUser::where('name', 'like', '%'. $this->keyword .'%')
            ->orWhere('email', 'like', '%'. $this->keyword .'%')
            ->get();

        return view('livewire.admin.user', compact('users'));
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'photo' => 'nullable|image|max:1024',
        ]);

        if ($this->photo) {
            $validate['profile_photo_path'] = $this->photo->store('profile-photos', 'public');
        }

        ModelsUser::create($validate);

        session()->flash('message', 'berhasil nambah');
        $this->clear();
    }

    public function destroy($id)
    {
        $user = ModelsUser::find($id);

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();
        session()->flash('message', 'berhasil menghapus data');
    }

    public function edit($id)
    {
        $user = ModelsUser::find($id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->role = $user->role;
        $this->existingPhoto = $user->profile_photo_path;
        $this->photo = null;
        $this->idEdit = $user->id;
        $this->editCheck = true;
    }

    public function clear()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->photo = null;
        $this->existingPhoto = null;
        $this->idEdit = '';
        $this->editCheck = false;
    }

    public function update($id)
    {
        $validate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'photo' => 'nullable|image|max:1024',
        ]);

        $user = ModelsUser::find($id);

        if ($this->photo) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $validate['profile_photo_path'] = $this->photo->store('profile-photos', 'public');
        }

        $user->update($validate);

        session()->flash('message', 'berhasil update data');
        $this->clear();
    }
}

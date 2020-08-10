<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\EditPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Requests\Profile\EditPersonalData;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function editPersonalData()
    {
        return view('profile.edit_personal_data');
    }

    public function updatePersonalData(EditPersonalData $request)
    {
        // uploading image
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $new_name = uniqid(rand(), true).'.'.strtolower($file->getClientOriginalExtension());
            $result = Storage::disk('public')->put('avatars/'.$new_name, File::get($file));

            if (!$result) {
                $request->session()->flash('file_error', 'Ha ocurrido un error al subir la imagen.');
                return redirect()->route('profile.edit_personal_data');
            }

            if (Storage::disk('public')->exists('avatars/'.auth()->user()->avatar)) {
                Storage::disk('public')->delete('avatars/'.auth()->user()->avatar);
            }
            auth()->user()->avatar = $new_name;
        }

        // updating user data
        auth()->user()->fill($request->all());
        auth()->user()->save();

        $request->session()->flash('message', 'Datos actualizados correctamente.');

        return redirect()->route('profile.index');
    }

    public function editPassword()
    {
        return view('profile.edit_password');
    }

    public function updatePassword(EditPassword $request)
    {
        // updating password
        auth()->user()->fill($request->all());
        auth()->user()->save();

        $request->session()->flash('message', 'Contraseña actualizada correctamente.');

        return redirect()->route('profile.index');
    }
}

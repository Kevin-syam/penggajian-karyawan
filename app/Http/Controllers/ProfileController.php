<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('auth.profile');
    }

    public function store(Request $request)
    {
        $user     = Auth::user();
        $password = $user->password;

        if ($request->password != NULL) {
            $password = Hash::make($request->password);
        }

        User::find($user->id)->update([
            'name'     => $request->name,
            'no_telp'  => $request->no_telp,
            'password' => $password,
        ]);

        toastr()->success('Profile telah berhasil diperbarui.', 'Sukses');

        return redirect()->back();
    }
}

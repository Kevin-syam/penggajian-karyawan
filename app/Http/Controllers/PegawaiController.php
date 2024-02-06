<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index(Request $request, Pegawai $pegawais)
    {
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $pegawais = $pegawais->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return view('app.pegawai.index', [
            'request'  => $request->all(),
            'pegawais' => $pegawais->with('user')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('app.pegawai.form', [
            'isEdit'     => false,
            'urlForm'    => route('pegawai.store'),
            'departemen' => Departemen::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password'),
            'level'    => 'pegawai'
        ]);

        Pegawai::create([
            'user_id'       => $user->id,
            'departemen_id' => $request->departemen_id,
            'nip'           => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'waktu_masuk'   => $request->waktu_masuk,
            'jabatan'       => $request->jabatan,
            'gaji'          => $request->gaji,
            'bpjs_k'        => $request->bpjs_k,
            'bpjs_tk'       => $request->bpjs_tk,
            'pajak'         => $request->pajak,
        ]);

        toastr()->success('Data berhasil ditambahkan.', 'Sukses');

        return redirect()->route('pegawai.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('app.pegawai.form', [
            'isEdit'     => true,
            'urlForm'    => route('pegawai.update', ['pegawai' => $id]),
            'pegawai'    => Pegawai::with('user')->findOrFail($id),
            'departemen' => Departemen::latest()->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        Pegawai::findOrFail($id)->update([
            'departemen_id' => $request->departemen_id,
            'nip'           => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'waktu_masuk'   => $request->waktu_masuk,
            'jabatan'       => $request->jabatan,
            'gaji'          => $request->gaji,
            'bpjs_k'        => $request->bpjs_k,
            'bpjs_tk'       => $request->bpjs_tk,
            'pajak'         => $request->pajak,
        ]);

        toastr()->warning('Data berhasil diubah.', 'Berhasil');

        return redirect()->route('pegawai.index');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->user->delete();
        $pegawai->delete();

        toastr()->error('Data berhasil dihapus.', 'Berhasil');

        return redirect()->route('pegawai.index');
    }
}

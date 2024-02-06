<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\User;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index(Request $request, Gaji $gajis)
    {
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $gajis = $gajis->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return view('app.gaji.index', [
            'request'  => $request->all(),
            'gajis' => $gajis->with('user')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('app.gaji.form', [
            'isEdit'  => false,
            'urlForm' => route('gaji.store'),
            'users'   => User::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        Gaji::create([
            'user_id'      => $request->user_id,
            'periode'      => $request->periode,
            'jumlah_absen' => $request->jumlah_absen,
            'transport'    => $request->transport,
            'bonus'        => $request->bonus,
        ]);

        toastr()->success('Data berhasil ditambahkan.', 'Sukses');

        return redirect()->route('gaji.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('app.gaji.form', [
            'isEdit'  => true,
            'urlForm' => route('gaji.update', ['gaji' => $id]),
            'gaji'    => Gaji::with('user')->findOrFail($id),
            'users'   => User::latest()->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        Gaji::findOrFail($id)->update([
            'user_id'      => $request->user_id,
            'periode'      => $request->periode,
            'jumlah_absen' => $request->jumlah_absen,
            'transport'    => $request->transport,
            'bonus'        => $request->bonus,
        ]);

        toastr()->warning('Data berhasil diubah.', 'Berhasil');

        return redirect()->route('gaji.index');
    }

    public function destroy($id)
    {
        Gaji::findOrFail($id)->delete();

        toastr()->error('Data berhasil dihapus.', 'Berhasil');

        return redirect()->route('gaji.index');
    }
}

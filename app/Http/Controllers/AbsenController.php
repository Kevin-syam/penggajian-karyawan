<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(Request $request, Absen $absens)
    {
        $user_id = $request->input('user_id');
        $periode = $request->input('periode');

        if ($request->has('user_id')) {
            $absens = $absens->where('user_id', $user_id);
        }

        if ($request->has('periode')) {
            $absens = $absens->where('created_at', 'like', '%' . $periode . '%');
        }

        if (auth()->user()->level == 'pegawai') {
            $absens = $absens->where('user_id', auth()->id());
        }

        return view('app.absen.index', [
            'request'        => $request->all(),
            'absens'         => $absens->latest()->paginate(10),
            'jumlah_absensi' => $absens->count(),
            'users'          => User::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('app.absen.form');
    }

    public function store(Request $request)
    {
        $cekAbsen = Absen::where('user_id', auth()->id())
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

        if ($cekAbsen) {
            toastr()->warning('Anda sudah melakukan absensi sebelumnya', 'Terjadi Kesalahan');
        } else {
            Absen::create([
                'user_id'    => auth()->id(),
                'status'     => $request->status,
                'keterangan' => $request->keterangan,
            ]);

            toastr()->success('Anda telah melakukan absensi.', 'Terimakasih');
        }

        return redirect()->route('absen.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

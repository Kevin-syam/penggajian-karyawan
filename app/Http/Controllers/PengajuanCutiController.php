<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\DetailCuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    public function index(Request $request, DetailCuti $pengajuan_cutis)
    {
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $pengajuan_cutis = $pengajuan_cutis->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        if (auth()->user()->level == 'pegawai') {
            $pengajuan_cutis = $pengajuan_cutis->where('user_id', auth()->id());
        }

        return view('app.detail_cuti.index', [
            'request' => $request->all(),
            'pengajuan_cutis'  => $pengajuan_cutis->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('app.detail_cuti.form', [
            'isEdit' => false,
            'urlForm' => route('pengajuan-cuti.store'),
            'cutis' => Cuti::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        DetailCuti::create([
            'user_id'         => auth()->id(),
            'cuti_id'         => $request->cuti_id,
            'waktu_pengajuan' => $request->waktu_pengajuan,
            'keterangan'      => $request->keterangan,
            'status'          => 'Pengajuan',
        ]);

        toastr()->success('Data berhasil ditambahkan.', 'Sukses');

        return redirect()->route('pengajuan-cuti.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('app.detail_cuti.form', [
            'isEdit' => true,
            'urlForm' => route('pengajuan-cuti.update', ['pengajuan_cuti' => $id]),
            'cutis' => Cuti::latest()->get(),
            'pengajuan_cuti' => DetailCuti::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        DetailCuti::findOrFail($id)->update([
            'cuti_id'         => $request->cuti_id,
            'waktu_pengajuan' => $request->waktu_pengajuan,
            'keterangan'      => $request->keterangan,
            'status'          => $request->status,
        ]);

        toastr()->warning('Data berhasil diubah.', 'Berhasil');

        return redirect()->route('pengajuan-cuti.index');
    }

    public function destroy($id)
    {
        DetailCuti::findOrFail($id)->delete();

        toastr()->error('Data berhasil dihapus.', 'Berhasil');

        return redirect()->route('pengajuan-cuti.index');
    }
}

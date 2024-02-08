<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index(Request $request, Cuti $cutis)
    {
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $cutis = $cutis->where('jenis_cuti', 'like', '%' . $keyword . '%');
        }

        return view('app.cuti.index', [
            'request' => $request->all(),
            'cutis'   => $cutis->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('app.cuti.form', [
            'isEdit'     => false,
            'urlForm'    => route('jenis-cuti.store')
        ]);
    }

    public function store(Request $request)
    {
        Cuti::create([
            'jenis_cuti'   => $request->jenis_cuti,
            'bobot_cuti'   => $request->bobot_cuti,
        ]);

        toastr()->success('Data berhasil ditambahkan.', 'Sukses');

        return redirect()->route('jenis-cuti.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('app.cuti.form', [
            'isEdit'     => true,
            'urlForm'    => route('jenis-cuti.update', ['jenis_cuti' => $id]),
            'cuti' => Cuti::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        Cuti::findOrFail($id)->update([
            'jenis_cuti'   => $request->jenis_cuti,
            'bobot_cuti'   => $request->bobot_cuti,
        ]);

        toastr()->warning('Data berhasil diubah.', 'Berhasil');

        return redirect()->route('jenis-cuti.index');
    }

    public function destroy($id)
    {
        Cuti::findOrFail($id)->delete();

        toastr()->error('Data berhasil dihapus.', 'Berhasil');

        return redirect()->route('jenis-cuti.index');
    }
}

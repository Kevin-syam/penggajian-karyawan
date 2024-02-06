<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index(Request $request, Departemen $departemens)
    {
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $departemens = $departemens->where('nama', 'like', '%' . $keyword . '%');
        }

        return view('app.departemen.index', [
            'request'     => $request->all(),
            'departemens' => $departemens->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('app.departemen.form', [
            'isEdit'     => false,
            'urlForm'    => route('departemen.store')
        ]);
    }

    public function store(Request $request)
    {
        Departemen::create([
            'nama'   => $request->nama,
        ]);

        toastr()->success('Data berhasil ditambahkan.', 'Sukses');

        return redirect()->route('departemen.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('app.departemen.form', [
            'isEdit'     => true,
            'urlForm'    => route('departemen.update', ['departeman' => $id]),
            'departemen' => Departemen::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        Departemen::findOrFail($id)->update([
            'nama'   => $request->nama,
        ]);

        toastr()->warning('Data berhasil diubah.', 'Berhasil');

        return redirect()->route('departemen.index');
    }

    public function destroy($id)
    {
        Departemen::findOrFail($id)->delete();

        toastr()->error('Data berhasil dihapus.', 'Berhasil');

        return redirect()->route('departemen.index');
    }
}

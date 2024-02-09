<?php

namespace App\Http\Controllers;

use App\Services\SawCalculator;
use App\Models\Gaji;
use App\Models\User;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    protected $sawCalculator;

    public function __construct(SawCalculator $sawCalculator)
    {
        $this->sawCalculator = $sawCalculator;
    }

    public function index(Request $request, Gaji $gajis)
    {
        
        
        $keyword = $request->input('keyword');
        // $data_kriteria =[];
        $atribut = ['cost','benefit','benefit','cost','benefit'];
        $bobot = [30,40,20,10,50];

        if ($request->has('keyword')) {
            $gajis = $gajis->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        $gajis = $gajis->with('user')->latest()->paginate(10);

        $allDataKriteria = [];
        foreach ($gajis as $gaji) {
            $criteria = [
                $gaji->jumlah_absen,
                $gaji->attitude,
                $gaji->kedisiplinan,
                $gaji->efisiensi_kerja,
                $gaji->kinerja,
            ];

            $gaji->data_kriteria = $criteria;
            $allDataKriteria[] = $criteria;
            // $gaji->data_kriteria = array_push($data_kriteria,$criteria);

            // $sawInstance = new SawCalculator($data_kriteria,$atribut,$bobot)
        }

        
         // Check if $gajis is not empty before processing
        if ($gajis->isNotEmpty()) {
            // Set allDataKriteria property for each $gaji
            $gajis->each(function ($gaji, $key) use ($allDataKriteria) {
                $gaji->allDataKriteria = $allDataKriteria[$key] ?? null;
            });

            // Set sawResult and sawRanking properties for each $gaji
            $gajis->each(function ($gaji) use ($allDataKriteria, $atribut, $bobot) {
                $gaji->sawResult = $this->sawCalculator->get_calculate($allDataKriteria, $atribut, $bobot);
                $gaji->sawRanking = $this->sawCalculator->get_rank($allDataKriteria, $atribut, $bobot);
            });
        }

        return view('app.gaji.index', [
            'request'  => $request->all(),
            'gajis' => $gajis,
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
            'attitude'     => $request->attitude,
            'kedisiplinan'  => $request->kedisiplinan,
            'efisiensi_kerja'   => $request->efisiensi_kerja,
            'kinerja'      => $request->kinerja,
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
            'attitude'     => $request->attitude,
            'kedisiplinan'  => $request->kedisiplinan,
            'efisiensi_kerja'   => $request->efisiensi_kerja,
            'kinerja'      => $request->kinerja,
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

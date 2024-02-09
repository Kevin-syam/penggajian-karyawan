<?php

namespace App\Http\Controllers;

use App\Services\SawCalculator;
use App\Models\Cuti;
use App\Models\DetailCuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    protected $sawCalculator;

    public function __construct(SawCalculator $sawCalculator)
    {
        $this->sawCalculator = $sawCalculator;
    }
    public function index(Request $request, DetailCuti $pengajuan_cutis)
    {
        $keyword = $request->input('keyword');

        $atribut = ['benefit','cost','benefit'];
        $bobot = [40,20,10];

        if ($request->has('keyword')) {
            $pengajuan_cutis = $pengajuan_cutis->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        if (auth()->user()->level == 'pegawai') {
            $pengajuan_cutis = $pengajuan_cutis->where('user_id', auth()->id())->paginate(10);
        }elseif (auth()->user()->level == 'admin'){
            $pengajuan_cutis = $pengajuan_cutis->latest()->paginate(10);

            foreach($pengajuan_cutis as $pengajuan_cuti){
                // $pengajuan_cuti->jenisCuti = $pengajuan_cuti->cuti->jenis_cuti;

                $criteria = [
                    $pengajuan_cuti->cuti->bobot_cuti,
                    $pengajuan_cuti->durasi,
                    $pengajuan_cuti->sisa_cuti,
                ];
    
                $pengajuan_cuti->data_kriteria = $criteria;
                $allDataKriteria[] = $criteria;
            }

            // $pengajuan_cutis->each(function ($cutia) use ($allDataKriteria,$atribut, $bobot) {
            //     $cutia->sawResult = $this->sawCalculator->get_calculate($allDataKriteria, $atribut, $bobot);
            //     $cutia->sawRanking = $this->sawCalculator->get_rank($allDataKriteria, $atribut, $bobot);
            // });
            if ($pengajuan_cutis->isNotEmpty()) {
                // Set allDataKriteria property for each $gaji
                $pengajuan_cutis->each(function ($pengajuan_cuti, $key) use ($allDataKriteria) {
                    $pengajuan_cuti->allDataKriteria = $allDataKriteria[$key] ?? null;
                });
    
                // Set sawResult and sawRanking properties for each $gaji
                $pengajuan_cutis->each(function ($pengajuan_cuti) use ($allDataKriteria, $atribut, $bobot) {
                    $pengajuan_cuti->sawResult = $this->sawCalculator->get_calculate($allDataKriteria, $atribut, $bobot);
                    $pengajuan_cuti->sawRanking = $this->sawCalculator->get_rank($allDataKriteria, $atribut, $bobot);
                });
            }
        }

        return view('app.detail_cuti.index', [
            'request' => $request->all(),
            'pengajuan_cutis'  => $pengajuan_cutis,
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
            'durasi'          => $request->durasi,
            'sisa_cuti'       => $request->sisa_cuti,
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
            'durasi'          => $request->durasi,
            'sisa_cuti'       => $request->sisa_cuti,
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

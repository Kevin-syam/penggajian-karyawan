<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Gaji;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 'admin') {
            return $this->admin();
        }

        if (auth()->user()->level == 'pegawai') {
            return view('app.pegawai');
        }
    }

    public function admin()
    {
        $dateToday = date('d', strtotime(date('Y-m-d')));

        $jumlah_karyawan = User::count();

        $karyawan_hadir = Absen::where('status', 'Hadir')
            ->whereDay('created_at', $dateToday)->count();

        $jumlah_ijin_sakit = Absen::where('status', 'Ijin')
            ->orWhere('status', 'Sakit')
            ->whereDay('created_at', $dateToday)
            ->count();

        $karyawan_tidak_hadir = $jumlah_karyawan - $karyawan_hadir;

        return view('app.admin', compact(
            'jumlah_karyawan',
            'karyawan_hadir',
            'jumlah_ijin_sakit',
            'karyawan_tidak_hadir',
        ));
    }

    public function absen_pulang()
    {
        toastr()->success('Absensi Pulang Anda Berhasil.', 'Sukses');

        return redirect()->route('home');
    }

    public function cetak_gaji(Request $request)
    {
        $gaji = Gaji::where('user_id', auth()->id())->where('periode', $request->periode)->first();

        if ($gaji) {
            $user = auth()->user();

            $jumlah_absen = Absen::whereIn('status', ['Hadir', 'Ijin', 'Sakit'])
                ->where('user_id', auth()->id())
                ->where('created_at', 'like', '%' . $request->periode . '%')
                ->count();


            $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, intval(substr($request->periode, 5, 2)), intval(substr($request->periode, 0, 4)));
            $hari_kerja = $jumlah_hari - env('JUMLAH_LIBUR');

            $potongan_gaji = env('POTONGAN_GAJI') * ($hari_kerja - $jumlah_absen);

            $total_diterima = ($user->pegawai->gaji + $gaji->lembur + $gaji->transport) - $potongan_gaji;

            return view('app.cetak_gaji', [
                'user'           => $user,
                'gaji'           => $gaji,
                'jumlah_absen'   => $jumlah_absen,
                'hari_kerja'     => $hari_kerja,
                'potongan_gaji'  => $potongan_gaji,
                'total_diterima' => $total_diterima,
            ]);
        }

        toastr()->warning('Periode Penggajian Tidak Ditemukan.', 'Terjadi Kesalahan');

        return redirect()->route('home');
    }
}

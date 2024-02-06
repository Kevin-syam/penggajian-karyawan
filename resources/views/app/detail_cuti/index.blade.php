@extends('layouts.app')

@section('title')
    Pengajuan Cuti
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Pengajuan Cuti</li>
    <li class="breadcrumb-item">Daftar</li>
@endsection

@section('button-action')
    @if (auth()->user()->level == 'pegawai')
        <a href="{{ url('pengajuan-cuti/create') }}" class="btn btn-primary rounded">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-12 rounded-4 bg-white p-3 shadow-sm">
            @if (auth()->user()->level == 'admin')
                <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
                    <div></div>
                    <form action="{{ url('pengajuan-cuti') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control"
                                value="{{ $request['keyword'] ?? '' }}" placeholder="Pencarian...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table-bordered table align-middle">
                    <thead>
                        <tr class="bg-secondary">
                            @if (auth()->user()->level == 'admin')
                                <th class="text-start" width="20%">NIP</th>
                                <th class="text-start" width="25%">Nama</th>
                            @endif
                            <th class="text-start" width="20%">Jenis Cuti</th>
                            <th class="text-start" width="15%">Waktu Pengajuan</th>
                            <th class="text-start" width="15%">Status</th>
                            <th class="text-center" width="5%"><i class="bi bi-lightning-charge"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuan_cutis as $pengajuan_cuti)
                            <tr>
                                @if (auth()->user()->level == 'admin')
                                    <td class="text-start">{{ $pengajuan_cuti->user->pegawai->nip }}</td>
                                    <td class="text-start">{{ $pengajuan_cuti->user->name }}</td>
                                @endif
                                <td class="text-start">{{ $pengajuan_cuti->cuti->jenis_cuti }}</td>
                                <td class="text-start">{{ $pengajuan_cuti->waktu_pengajuan }}</td>
                                <td class="text-start">{{ $pengajuan_cuti->status }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pengajuan-cuti.edit', ['pengajuan_cuti' => $pengajuan_cuti->id]) }}"
                                        class="btn btn-sm btn-success rounded-circle">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger py-2 text-center" colspan="6">
                                    Data kosong atau tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="">
                {{ $pengajuan_cutis->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection

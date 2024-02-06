@extends('layouts.app')

@section('title')
    Pegawai
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Pegawai</li>
    <li class="breadcrumb-item">Daftar</li>
@endsection

@section('button-action')
    <a href="{{ url('pegawai/create') }}" class="btn btn-primary rounded">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col rounded-4 bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
                <div></div>
                <form action="{{ url('pegawai') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="keyword" class="form-control" value="{{ $request['keyword'] ?? '' }}"
                            placeholder="Pencarian...">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table-bordered table align-middle">
                    <thead>
                        <tr class="bg-secondary">
                            <th class="text-start" width="5%">NIP</th>
                            <th class="text-start" width="30%">Nama</th>
                            <th class="text-start" width="15%">Jenis Kelamin</th>
                            <th class="text-start" width="20%">Departemen</th>
                            <th class="text-start" width="25%">Jabatan</th>
                            <th class="text-center" width="5%"><i class="bi bi-lightning-charge"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pegawais as $pegawai)
                            <tr>
                                <td class="text-center">{{ $pegawai->nip }}</td>
                                <td class="text-start">{{ $pegawai->user->name }}</td>
                                <td class="text-start">{{ $pegawai->jenis_kelamin }}</td>
                                <td class="text-start">{{ $pegawai->departemen->nama }}</td>
                                <td class="text-start">{{ $pegawai->jabatan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pegawai.edit', ['pegawai' => $pegawai->id]) }}"
                                        class="btn btn-sm btn-success rounded-circle">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger py-2 text-center" colspan="4">
                                    Data kosong atau tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="">
                {{ $pegawais->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection

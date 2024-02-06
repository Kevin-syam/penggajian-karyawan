@extends('layouts.app')

@section('title')
    Absensi
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Absensi</li>
    <li class="breadcrumb-item">Daftar</li>
@endsection

@section('button-action')
    @if (auth()->user()->level == 'pegawai')
        <a href="{{ url('absen/create') }}" class="btn btn-primary rounded">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    @endif
@endsection

@section('content')
    @php
        $user_id = $request['user_id'] ?? '';
    @endphp
    <div class="row">
        <div class="col rounded-4 bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
                <form action="{{ url('absen') }}" method="GET" class="row row-cols-lg-auto g-3 align-items-center">
                    @if (auth()->user()->level == 'admin')
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-text">Pegawai</div>
                                <select class="form-select" name="user_id" required>
                                    <option value="" selected>Pilih Pegawai</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}" {{ $user_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-text">Periode</div>
                            <input type="month" name="periode" class="form-control"
                                value="{{ $request['periode'] ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
                <h5 class="m-0">
                    Jumlah Absensi: {{ $jumlah_absensi }}
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table-bordered table align-middle">
                    <thead>
                        <tr class="bg-secondary">
                            @if (auth()->user()->level == 'admin')
                                <th class="text-start" width="15%">NIP</th>
                                <th class="text-start" width="20%">Nama</th>
                            @endif
                            <th class="text-start" width="15%">Waktu</th>
                            <th class="text-start" width="15%">Status</th>
                            <th class="text-start" width="30%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absens as $absen)
                            <tr>
                                @if (auth()->user()->level == 'admin')
                                    <td class="text-start">{{ $absen->user->pegawai->nip }}</td>
                                    <td class="text-start">{{ $absen->user->name }}</td>
                                @endif
                                <td class="text-start">{{ $absen->created_at }}</td>
                                <td class="text-start">{{ $absen->status }}</td>
                                <td class="text-start">{{ $absen->keterangan }}</td>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger py-2 text-center" colspan="5">
                                    Data kosong atau tidak Ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="">
                {{ $absens->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Penggajian
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Penggajian</li>
    <li class="breadcrumb-item">Daftar</li>
@endsection

@section('button-action')
    <a href="{{ url('gaji/create') }}" class="btn btn-primary rounded">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col rounded-4 bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
                <div></div>
                <form action="{{ url('gaji') }}" method="GET">
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
                            <th class="text-start" width="20%">Departemen</th>
                            <th class="text-start" width="15%">Posisi</th>
                            <th class="text-start" width="15%">Penilaian</th>
                            <th class="text-start" width="10%">Ranking</th>
                            <th class="text-center" width="5%"><i class="bi bi-lightning-charge"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($gajis->sortBy(function ($item) use ($gajis) {
                            return $item->sawRanking[count($gajis) - $item->id];
                        }) as $gaji)
                            <tr>
                                <td class="text-start">{{ $gaji->user->pegawai->nip }}</td>
                                <td class="text-start">{{ $gaji->user->name }}</td>
                                <td class="text-start">{{ $gaji->user->pegawai->departemen->nama }}</td>
                                <td class="text-start">{{ $gaji->user->pegawai->jabatan }}</td>
                                <td class="text-start">{{ $gaji->sawResult[count($gajis) - $gaji->id] * 100}}</td>
                                <td class="text-start">{{ $gaji->sawRanking[count($gajis) - $gaji->id] }}</td>
                                <td class="text-center">
                                    <a href="{{ route('gaji.edit', ['gaji' => $gaji->id]) }}"
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
                {{ $gajis->appends($request)->links() }}
            </div>
        </div>
        <!-- <pre>{{ print_r($gaji->allDataKriteria,true) }} </pre>
        <pre>{{ print_r($gaji->sawResult,true) }} </pre> -->
    </div>
@endsection

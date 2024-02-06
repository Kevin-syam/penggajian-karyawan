@extends('layouts.app')

@section('title')
    Jenis Cuti
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Jenis Cuti</li>
    <li class="breadcrumb-item">Daftar</li>
@endsection

@section('button-action')
    <a href="{{ url('jenis-cuti/create') }}" class="btn btn-primary rounded">
        <i class="bi bi-plus-circle"></i> Tambah Data
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col rounded-4 bg-white p-3 shadow-sm">
            <div class="d-flex align-items-center justify-content-between mt-2 mb-3">
                <div></div>
                <form action="{{ url('cuti') }}" method="GET">
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
                            <th class="text-center" width="5%"><i class="bi bi-hash"></i></th>
                            <th class="text-start" width="90%">Jenis Cuti</th>
                            <th class="text-center" width="5%"><i class="bi bi-lightning-charge"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cutis as $cuti)
                            <tr>
                                <td class="text-center">
                                    {{ ($cutis->currentPage() - 1) * $cutis->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    {{ $cuti->jenis_cuti }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('jenis-cuti.edit', ['jenis_cuti' => $cuti->id]) }}"
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
                {{ $cutis->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection

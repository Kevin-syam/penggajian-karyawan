@extends('layouts.app')

@section('title')
    Absensi
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Absensi</li>
    <li class="breadcrumb-item">Tambah Data</li>
@endsection

@section('content')
    <form method="post" action="{{ route('absen.store') }}">
        @csrf

        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body row">
                <div class="col-12 mb-3">
                    <label class="mb-1">Status</label>
                    <div class="col-sm-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="Hadir" value="Hadir"
                                checked>
                            <label class="form-check-label" for="Hadir">Hadir</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="Ijin" value="Ijin">
                            <label class="form-check-label" for="Ijin">Ijin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="Sakit" value="Sakit">
                            <label class="form-check-label" for="Sakit">Sakit</label>
                        </div>
                    </div>
                </div>


                <div class="col-12 mb-3">
                    <label class="mb-1">Keterangan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                            placeholder="Ketikkan keterangan jika ijin atau sakit">
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-start gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i>
                        <span>Simpan Sekarang</span>
                    </button>

                    <a href="{{ url('/absen') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="ms-1">Kembali Ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

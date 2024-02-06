@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Jumlah Karyawan</h6>
                    <h1 class="fw-bold mb-0">
                        0
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Karyawan Hadir Hari Ini</h6>
                    <h1 class="fw-bold mb-0">
                        0
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Jumlah Ijin/Sakit Hari Ini</h6>
                    <h1 class="fw-bold mb-0">
                        0
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Karyawan Tidak Hadir</h6>
                    <h1 class="fw-bold mb-0">
                        0
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection

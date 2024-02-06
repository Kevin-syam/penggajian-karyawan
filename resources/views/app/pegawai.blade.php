@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col-md-6 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body text-center">
                    <h1 class="display-1 mb-3">
                        <i class="bi bi-briefcase"></i>
                    </h1>
                    <a href="{{ url('/absen-pulang') }}" class="btn btn-primary">
                        Absen Pulang
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body d-flex flex-column align-items-center">
                    <h1 class="display-1 mb-3">
                        <i class="bi bi-receipt"></i>
                    </h1>
                    <form action="{{ url('cetak-gaji') }}" method="POST" target="_blank"
                        class="row row-cols-lg-auto g-3 align-items-center">
                        @csrf
                        <div class="col-12">
                            <div class="input-group">
                                <div class="input-group-text">Periode</div>
                                <input type="month" name="periode" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning">
                                Download Slip Gaji
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Atur Profile
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Profile</li>
@endsection

@section('content')
    <form action="{{ route('profile.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="row">
            <div class="col-md-5 col-12 mb-4">
                <h4 class="">Personal Data</h4>
                <h6 class="text-muted">
                    Modifikasi informasi data user Anda saat ini untuk proses login
                </h6>
            </div>
            <div class="col-md-7 col-12 mb-4">
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                required>
                        </div>
                        <div class="mb-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-12 mb-4">
                <h4 class="">Ubah Password</h4>
                <h6 class="text-muted">
                    Kosongkan jika tidak ingin mengubah password Anda saat ini
                </h6>
            </div>
            <div class="col-md-7 col-12 mb-4">
                <div class="card rounded-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="mb-1">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Ketikkan Password Baru Disini">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12 d-flex justify-content-end gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle"></i>
                    <span>Simpan Sekarang</span>
                </button>

                <a href="{{ url('/home') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i>
                    <span class="ms-1">Kembali Ke Dashboard</span>
                </a>
            </div>
        </div>
    </form>
@endsection

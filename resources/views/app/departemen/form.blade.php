@extends('layouts.app')

@section('title')
    Departemen
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Departemen</li>
    <li class="breadcrumb-item">
        {{ $isEdit ? 'Ubah Data' : 'Buat Baru' }}
    </li>
@endsection

@section('button-action')
    @if ($isEdit)
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash3"></i>
            <span>Delete</span>
        </button>

        <x-modal.delete url="{{ route('departemen.destroy', ['departeman' => $departemen->id]) }}" />
    @endif
@endsection

@section('content')
    <form method="post" action="{{ $urlForm }}">
        @csrf @if ($isEdit)
            @method('PUT')
        @endif

        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body row">
                <div class="col-12 mb-3">
                    <label class="mb-1">Nama Departemen</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nama" placeholder="Ketikkan nama departemen"
                            value="{{ $isEdit ? $departemen->nama : '' }}" required>
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-start gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i>
                        <span>Simpan Sekarang</span>
                    </button>

                    <a href="{{ url('/departemen') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="ms-1">Kembali Ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

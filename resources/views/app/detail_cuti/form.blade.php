@extends('layouts.app')

@section('title')
    Pengajuan Cuti
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Pengajuan Cuti</li>
    <li class="breadcrumb-item">Tambah Data</li>
@endsection

@section('button-action')
    @if ($isEdit)
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash3"></i>
            <span>Delete</span>
        </button>

        <x-modal.delete url="{{ route('pengajuan-cuti.destroy', ['pengajuan_cuti' => $pengajuan_cuti->id]) }}" />
    @endif
@endsection

@section('content')
    <form method="post" action="{{ $urlForm }}">
        @csrf @if ($isEdit)
            @method('PUT')
        @endif

        <div class="card rounded-4 border-0 shadow-sm">
            <div class="card-body row">

                <div class="col-6 mb-3">
                    <label class="mb-1">Cuti</label>
                    <div class="col-sm-12">
                        <select class="form-select" name="cuti_id" required>
                            @if (!$isEdit)
                                <option selected>Silakan Pilih Cuti</option>
                            @endif
                            @foreach ($cutis as $item)
                                <option value="{{ $item->id }}"
                                    @if ($isEdit) {{ $pengajuan_cuti->cuti_id == $item->id ? 'selected' : '' }} @endif>
                                    {{ $item->jenis_cuti }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Waktu Pengajuan</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name="waktu_pengajuan"
                            value="{{ $isEdit ? $pengajuan_cuti->waktu_pengajuan : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Keterangan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="keterangan" placeholder="Ketikkan keterangan cuti"
                            value="{{ $isEdit ? $pengajuan_cuti->keterangan : '' }}" required>
                    </div>
                </div>

                @if (auth()->user()->level == 'admin')
                    <div class="col-6 mb-3">
                        <label class="mb-1">Status</label>
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="Pria"
                                    value="Pengajuan"
                                    @if ($isEdit) {{ $pengajuan_cuti->status == 'Pengajuan' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="Pengajuan">Pengajuan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="Diterima"
                                    value="Diterima"
                                    @if ($isEdit) {{ $pengajuan_cuti->status == 'Diterima' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="Diterima">Diterima</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="Ditolak" value="Ditolak"
                                    @if ($isEdit) {{ $pengajuan_cuti->status == 'Ditolak' ? 'checked' : '' }} @endif>
                                <label class="form-check-label" for="Ditolak">Ditolak</label>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-sm-12 d-flex justify-content-start gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i>
                        <span>Simpan Sekarang</span>
                    </button>

                    <a href="{{ url('/pengajuan-cuti') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="ms-1">Kembali Ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

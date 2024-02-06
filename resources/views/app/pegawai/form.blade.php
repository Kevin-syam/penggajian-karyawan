@extends('layouts.app')

@section('title')
    Pegawai
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Pegawai</li>
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

        <x-modal.delete url="{{ route('pegawai.destroy', ['pegawai' => $pegawai->id]) }}" />
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
                    <label class="mb-1">NIP</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="nip" placeholder="Ketikkan NIP pegawai"
                            value="{{ $isEdit ? $pegawai->nip : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Nama</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" placeholder="Ketikkan nama pegawai"
                            value="{{ $isEdit ? $pegawai->user->name : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" placeholder="Ketikkan email pegawai"
                            value="{{ $isEdit ? $pegawai->user->email : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Jenis Kelamin</label>
                    <div class="col-sm-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="Pria"
                                value="Pria"
                                @if ($isEdit) {{ $pegawai->jenis_kelamin == 'Pria' ? 'checked' : '' }} @endif>
                            <label class="form-check-label" for="Pria">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="Wanita"
                                value="Wanita"
                                @if ($isEdit) {{ $pegawai->jenis_kelamin == 'Wanita' ? 'checked' : '' }} @endif>
                            <label class="form-check-label" for="Wanita">Wanita</label>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Departemen</label>
                    <div class="col-sm-12">
                        <select class="form-select" name="departemen_id" required>
                            @if (!$isEdit)
                                <option selected>Silakan Pilih Departemen</option>
                            @endif
                            @foreach ($departemen as $item)
                                <option value="{{ $item->id }}"
                                    @if ($isEdit) {{ $pegawai->departemen_id == $item->id ? 'selected' : '' }} @endif>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Jabatan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="jabatan" placeholder="Ketikkan jabatan pegawai"
                            value="{{ $isEdit ? $pegawai->jabatan : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Waktu Masuk</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" name="waktu_masuk"
                            value="{{ $isEdit ? $pegawai->waktu_masuk : '' }}" required>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Gaji Pokok</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="gaji" placeholder="0"
                                value="{{ $isEdit ? $pegawai->gaji : '' }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">No. BPJS Kesehatan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="bpjs_k" placeholder="Ketikkan No. BPJS Kesehatan"
                            value="{{ $isEdit ? $pegawai->bpjs_k : '' }}">
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">No. BPJS Ketenagakerjaan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="bpjs_tk"
                            placeholder="Ketikkan No. BPJS Ketenagakerjaan"
                            value="{{ $isEdit ? $pegawai->bpjs_tk : '' }}">
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">No. NPWP</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="pajak" placeholder="Ketikkan pajak"
                            value="{{ $isEdit ? $pegawai->pajak : '' }}">
                    </div>
                </div>

                <div class="col-sm-12 d-flex justify-content-start gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i>
                        <span>Simpan Sekarang</span>
                    </button>

                    <a href="{{ url('/pegawai') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="ms-1">Kembali Ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

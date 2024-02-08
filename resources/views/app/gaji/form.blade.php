@extends('layouts.app')

@section('title')
    Penggajian
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">Penggajian</li>
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

        <x-modal.delete url="{{ route('gaji.destroy', ['gaji' => $gaji->id]) }}" />
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
                    <label class="mb-1">Pegawai</label>
                    <div class="col-sm-12">
                        <select class="form-select" name="user_id" required>
                            @if (!$isEdit)
                                <option selected>Silakan Pilih Pegawai</option>
                            @endif
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}"
                                    @if ($isEdit) {{ $gaji->user_id == $item->id ? 'selected' : '' }} @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6 mb-3">
                    <label class="mb-1">Periode</label>
                    <div class="col-sm-12">
                        <input type="month" class="form-control" name="periode"
                            value="{{ $isEdit ? $gaji->periode : '' }}" required>
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Jumlah Absen</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="jumlah_absen" placeholder="Ketikkan jumlah absen"
                            value="{{ $isEdit ? $gaji->jumlah_absen : '' }}" required>
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Transport</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="transport" placeholder="0"
                                value="{{ $isEdit ? $gaji->transport : '' }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Bonus</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="number" class="form-control" name="bonus" placeholder="0"
                                value="{{ $isEdit ? $gaji->bonus : '' }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Attitude</label>
                    <div class="col-sm-12">
                        <input type="number" min="1" max="4" class="form-control" name="attitude" placeholder="Penilaian Sikap"
                            value="{{ $isEdit ? $gaji->attitude : '' }}" required>
                        

                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Kedisiplinan</label>
                    <div class="col-sm-12">
                    <input type="number" min="1" max="4" class="form-control" name="kedisiplinan" placeholder="Penilaian Kedisiplinan"
                            value="{{ $isEdit ? $gaji->kedisiplinan : '' }}" required>
                    <!-- <select class="form-select" name="kedisiplinan" required>
                            
                            @if (!$isEdit)
                                <option selected disabled>- Penilaian Kedisiplinan -</option>
                            @endif
                            <option value="1">Tidak Disiplin</option>
                            <option value="2">Kurang Disiplin</option>
                            <option value="3">Disiplin</option>
                            <option value="4">Sangat Disiplin</option>
                            
                        </select> -->
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Efisiensi Kerja</label>
                    <div class="col-sm-12">
                    <input type="number" min="1" max="4" class="form-control" name="efisiensi_kerja" placeholder="Penilaian Efisiensi"
                            value="{{ $isEdit ? $gaji->efisiensi_kerja : '' }}" required>
                    <!-- <select class="form-select" name="efisiensi_kerja" required>
                            
                            @if (!$isEdit)
                                <option selected disabled>- Penilaian Efisiensi -</option>
                            @endif
                            <option value="1">Tidak Ada Kerusakan</option>
                            <option value="2">Sedikit Kerusakan</option>
                            <option value="3">Sejumlah Kerusakan</option>
                            <option value="4">Banyak Kerusakn</option>
                            
                        </select> -->
                    </div>
                </div>

                <div class="col-4 mb-3">
                    <label class="mb-1">Kinerja</label>
                    <div class="col-sm-12">
                        <input type="number" min="1" max="10" class="form-control" name="kinerja" placeholder="Nilai Kinerja"
                            value="{{ $isEdit ? $gaji->kinerja : '' }}" required>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 d-flex justify-content-start gap-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle"></i>
                    <span>Simpan Sekarang</span>
                </button>

                <a href="{{ url('/gaji') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i>
                    <span class="ms-1">Kembali Ke Daftar</span>
                </a>
            </div>
        </div>
    </form>
@endsection

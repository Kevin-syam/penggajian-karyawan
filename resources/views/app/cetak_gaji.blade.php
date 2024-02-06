<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Periode
                <strong><?= $gaji->periode ?></strong>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{ env('APP_NAME') }}</strong>
                        </div>
                        <div>Jalan Lurus Maju Kedepan No. 01 RT. 02</div>
                        <div>Samarinda, Kalimantan Timur</div>
                        <div>Email: info@penggajian.com</div>
                        <div>Phone: +62 444 666 3333</div>
                    </div>

                    <div class="col-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong><?= $user->name ?></strong>
                        </div>
                        <div><?= $user->email ?></div>
                        <div>NIP: <?= $user->pegawai->nip ?></div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table">
                        <tr>
                            <td colspan="4">Penggajian</td>
                        </tr>
                        <tr>
                            <td width="10%">1.</td>
                            <td width="60%">Gaji Pokok</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">Rp.
                                {{ number_format($user->pegawai->gaji, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td width="10%">2.</td>
                            <td width="60%">Transport</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">Rp. {{ number_format($gaji->transport, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">3.</td>
                            <td width="60%">Bonus</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">Rp. {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Potongan</td>
                        </tr>
                        <tr>
                            <td width="10%">1.</td>
                            <td width="60%">Jumlah Absen</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">{{ $jumlah_absen }} Hari</td>
                        </tr>
                        <tr>
                            <td width="10%">2.</td>
                            <td width="60%">Jumlah Hari Kerja</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">{{ $hari_kerja }} Hari</td>
                        </tr>
                        <tr>
                            <td width="10%">3.</td>
                            <td width="60%">Potongan Tidak Hadir</td>
                            <td width="5%">:</td>
                            <td class="text-end" width="25%">Rp. {{ number_format($potongan_gaji, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold" width="70%" colspan="2">Total Diterima</td>
                            <td width="5%">:</td>
                            <td class="fw-bold text-end" width="25%">Rp.
                                {{ number_format($total_diterima, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6 ml-auto">
                        <div class="card p-3">
                            <h6><strong>Note:</strong></h6>
                            <small>
                                Terimakasih Telah Berkontribusi Besar Terhadap Perusahaan
                                <strong>{{ env('APP_NAME') }}</strong> Kami. Semoga kita bisa mencapai hal-hal besar
                                lainnya.
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.print()
    </script>
</body>

</html>

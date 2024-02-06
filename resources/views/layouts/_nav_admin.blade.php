<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
    aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="bi bi-database"></i></div>
    Master Data
    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-down"></i></div>
</a>
<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ url('/departemen') }}">
            <i class="bi bi-building"></i>
            <span class="ms-2">Departemen</span>
        </a>
        <a class="nav-link" href="{{ url('/pegawai') }}">
            <i class="bi bi-people"></i>
            <span class="ms-2">Pegawai</span>
        </a>
        <a class="nav-link" href="{{ url('/jenis-cuti') }}">
            <i class="bi bi-files"></i>
            <span class="ms-2">Jenis Cuti</span>
        </a>
    </nav>
</div>
<a class="nav-link {{ Request::is('absen*') ? 'bg-primary text-white' : '' }}" href="{{ url('/absen') }}">
    <i class="bi bi-card-checklist"></i>
    <span class="ms-2">Absensi</span>
</a>
<a class="nav-link {{ Request::is('gaji*') ? 'bg-primary text-white' : '' }}" href="{{ url('/gaji') }}">
    <i class="bi bi-cash-coin"></i>
    <span class="ms-2">Penggajian</span>
</a>
<a class="nav-link {{ Request::is('pengajuan-cuti*') ? 'bg-primary text-white' : '' }}"
    href="{{ url('/pengajuan-cuti') }}">
    <i class="bi bi-file-earmark-text"></i>
    <span class="ms-2">Pengajuan Cuti</span>
</a>

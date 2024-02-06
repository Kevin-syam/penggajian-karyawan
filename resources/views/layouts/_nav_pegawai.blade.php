<a class="nav-link {{ Request::is('absen*') ? 'bg-primary text-white' : '' }}" href="{{ url('/absen') }}">
    <i class="bi bi-card-checklist"></i>
    <span class="ms-2">Absensi</span>
</a>
<a class="nav-link {{ Request::is('pengajuan-cuti*') ? 'bg-primary text-white' : '' }}"
    href="{{ url('/pengajuan-cuti') }}">
    <i class="bi bi-file-earmark-text"></i>
    <span class="ms-2">Pengajuan Cuti</span>
</a>

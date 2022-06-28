<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="icon-box menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item
    {{ Route::is('pegawai.all') ? 'open' : '' }} 
    {{ Route::is('detail.all') ? 'open' : '' }} 
    ">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-disc menu-icon"></i>
            <span class="menu-title">Master data</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav sub-menu">
                <li class="nav-item {{ Route::is('pegawai.all') ? 'active' : '' }}"> <a class="nav-link"
                        href="{{route('pegawai.all')}}">Data Pegawai</a></li>
                <li class="nav-item {{ Route::is('detail.all') ? 'active' : '' }}"> <a class="nav-link"
                        href="{{route('detail.all')}}">Data Detail
                        Kegiatan</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Data Calendar
                        Service</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ Route::is('kegiatan.all') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('kegiatan.all')}}">
            <i class="icon-file menu-icon"></i>
            <span class="menu-title">Data Kegiatan</span>
        </a>
    </li>
</ul>
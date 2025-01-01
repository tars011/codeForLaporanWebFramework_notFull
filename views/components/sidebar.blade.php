<aside class="sidebar" id="sidebar">
    <ul>
        <li class="side-item" title="Dashboard">
            <a href="{{ route('dashboard.index') }}">
                <span class="side-icon"><i class="fa fa-dashboard"></i>Dashboard</span>
            </a>
        </li>
        <li class="side-item" title="Data Barang">
            <a href="{{ route('items.index') }}">
                <span class="side-icon"><i class="fa fa-table"></i>Data Barang</span>
            </a>
        </li>
        <li class="side-item dropdown" title="Kelola Barang">
            <a href="#" onclick="toggleDropdown(event)" class="dropdown-toggle">
                <span class="side-icon"><i id="fa_gear" class="fa fa-gear"></i>Kelola Barang</span>
                <i id="arrow-down" class="fa-solid fa-chevron-down fa-xs"></i>
            </a>
            <ul class="dropdown-menu">
                <li class="dropdown-item" title="Barang Masuk">
                    <a href="{{ route('item_ins.index') }}">
                        <span class="side-icon"><i class="fa-solid fa-plus-circle"></i>Barang Masuk</span>
                    </a>
                </li>
                <li class="dropdown-item" title="Barang Keluar">
                    <a href="{{ route('item_outs.index') }}">
                        <span class="side-icon"><i class="fa-solid fa-minus-circle"></i>Barang Keluar</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-item" title="Kelola Toko">
            <a href="{{ route('shop.index') }}">
                <span class="side-icon"><i class="fa fa-house-user"></i>Kelola Toko</span>
            </a>
        </li>
        <li class="side-item" title="Profil">
            <a href="{{ route('profile.index') }}">
                <span class="side-icon"><i class="fa fa-user"></i>Profil</span>
            </a>
        </li>
        <li class="side-item" title="Logout">
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
                <a class="logout" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="side-icon"><i class="fa fa-right-from-bracket"></i>Logout</span>
                </a>
            </form>
        </li>
    </ul>
</aside>
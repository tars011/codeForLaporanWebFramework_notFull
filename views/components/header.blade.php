    <header class="header">
        <div class="box1">
            @if ($main ?? true)
            <div class="menu-toggle" onclick="toggleSidebar()"><i id="menu-toggle" class="fa-solid fa-bars"></i></div>
            <div class="logo"><a href="{{ route('home') }}">STOKEASE</a></div>
            @else
            <div class="logo" style="padding-left: 1rem;">STOKEASE</div>
            @endif
        </div>
        @if (Auth::check())
        <div class="user">
            <div class="profile-picture">
                <img src="{{ Auth::user()->photo ? asset('storage/photo/' . Auth::user()->photo) : asset('default-profile.png') }}">
            </div>
            {{ Auth::user()->username }}
        </div>
        @endif
    </header>
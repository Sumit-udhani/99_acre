<header style="
    width:100%;
    background:#005ca8;
    padding:0;
">

<div style="
    display:flex;
    align-items:left;
    justify-content:space-between;
    height:70px;
    padding:0 20px;
">

    <!-- Logo -->
    <div style="display:flex; align-items:center;">
        @if($logo)
        <img src="{{ asset('storage/'.$logo->image_path) }}"
             alt="{{ $logo->title }}"
             style="height:95px;">
        @else
        <h2 style="color:white; margin:0;">My Website</h2>
        @endif
    </div>

    <!-- Navigation -->
    <nav style="display:flex; align-items:center; gap:15px;">

        @if (Route::has('login'))

        @auth

        <!-- Profile Menu -->
        <div class="profile-menu">

            <button class="profile-icon-btn">

                <!-- SVG PROFILE ICON -->
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="22"
                     height="22"
                     fill="currentColor"
                     viewBox="0 0 16 16">

                    <path d="M8 8a3 3 0 100-6 3 3 0 000 6"/>

                    <path fill-rule="evenodd"
                    d="M8 9a5 5 0 00-5 5 .5.5 0 00.5.5h9a.5.5 0 00.5-.5 5 5 0 00-5-5"/>

                </svg>

            </button>

            <div class="profile-dropdown">

                <div class="dropdown-user">
                    {{ Auth::user()->name }}
                </div>

                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        Logout
                    </button>
                </form>

            </div>

        </div>

        @else

        <a
            href="{{ route('login') }}"
            style="
            background:white;
            color:#005ca8;
            padding:8px 15px;
            border-radius:4px;
            text-decoration:none;
            font-weight:600;
            margin-right:10px;
        ">
            Log in
        </a>

        @if (Route::has('register'))
        <a
            href="{{ route('register') }}"
            style="
            background:white;
            color:#005ca8;
            padding:8px 15px;
            border-radius:4px;
            text-decoration:none;
            font-weight:600;
        ">
            Register
        </a>
        @endif

        @endauth

        @endif

    </nav>

</div>

</header>
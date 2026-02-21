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
        <div style="display:flex; align-items: center;">
            @if($logo)
            <img src="{{ asset('storage/'.$logo->image_path) }}"
                alt="{{ $logo->title }}"
                style="height:45px;">
            @else
            <h2 style="color:white; margin:0;">My Website</h2>
            @endif
        </div>

        <!-- Navigation -->
        <nav style="display:flex; align-items:center;">


           

            @if (Route::has('login'))

            @auth
            <a
                href="{{ url('/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Dashboard
            </a>
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
                margin: 0 30px
            "
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
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
            "
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Register
            </a>
            @endif
            @endauth

            @endif
        </nav>

    </div>

</header>
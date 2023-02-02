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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/app.css'])
</head>
<body>
   <!-- Menu -->
   <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="https://upload.wikimedia.org/wikipedia/fr/2/2c/Grappler_Baki_anime_logo_ja.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Ani Day</span>
                    <span class="surum">Beta 1.2</span>
                </div>
            </div>

        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="/episode">
                            <i class='bx bx-tv icon'></i>
                            <span class="text nav-text">Series</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/dashboard">
                            <i class='bx bx-group icon' ></i>
                            <span class="text nav-text">Teams</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-help-circle icon' ></i>
                            <span class="text nav-text">About-us</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxl-discord-alt icon' ></i>
                            <span class="text nav-text">Discord</span>
                        </a>
                    </li>

                </ul>
            </div>
            @if (session('logged_in'))
                <div class="bottom-content">    
                <li class="">
                    <a href="{{ route('signout')}}">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Log-out</span>
                    </a>
                </li>
            @else
            <div class="bottom-content">
                <li class="">
                    <a href="/login">
                        <i class='bx bx-log-in icon' ></i>
                        <span class="text nav-text">Log-out</span>
                    </a>
                </li>
                @endif
            @if (session('logged_in'))
                <li class="">
                    <a href="#">
                        <i class='bx bxl-flickr icon'></i>
                        <span class="text nav-text">Setting</span>
                    </a>
                </li>
            @endif
            </div>
        </div>

    </nav>
 
    <section class="home">
        <div class="content">
            @yield('content')
        </div>
    </section>
    </div>
    <script>

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    function Watched(anime_id, user_id) {
    $.ajax({
        type: "POST",
        url: '/anime/watched',
        data: { anime_id: anime_id, user_id: user_id },
        success: function(response) {
            console.log(response);
            $('.watched-button[data-anime-id="'+anime_id+'"] img').attr('src', 'storage/images/ok.png');
            $('.watched-button[data-anime-id="'+anime_id+'"]').attr('onclick', 'RemoveWatch(' + anime_id + ',' + user_id + ')');
        },
        error: function(error) {
            console.log(error);
        }
    })};

    function changeImageNotLogin(event) {
        var button = event.target;
        if (button.src.match("plus")) {
            button.src = "storage/images/ok.png";
        } else {
            button.src = "storage/images/plus.png";
        }
    }

    function RemoveWatch(anime_id, user_id) {
    $.ajax({
        type: "DELETE",
        url: '/anime/watched/delete/' + anime_id,
        data: { anime_id: anime_id, user_id: user_id },
        success: function(response) {
            console.log(response);
            // En enleve dans le dom
            $('.watched-button[data-anime-id="'+anime_id+'"] img').attr('src', 'storage/images/plus.png');
            $('.watched-button[data-anime-id="'+anime_id+'"]').attr('onclick', 'changeImage(' + anime_id + ',' + user_id + ')');
        },
        error: function(error) {
            console.log(error);
        }
    });
}
function RemoveWatchFromDashboard(anime_id) {
    $.ajax({
        type: "DELETE",
        url: '/anime/watched/delete/' + anime_id,
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            console.log(response);
            // 
            $("figure").remove('.snip1578[data-anime-id="'+anime_id+'"]');
        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>

</body>
</html>

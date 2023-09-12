<html>

<head>
    <title>Student Laravel 9 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    .swiper-pagination-bullet {
        width: 32px;
        height: 32px;
        text-align: center;
        line-height: 24px;
        font-size: 16px;
        color: #B2B5BE;
        opacity: 1;
        background: transparent;
        display: flex;
        border-radius: 50%;
        cursor: pointer;
        justify-content: center;
        align-items: center;
    }

    .swiper-pagination-bullet.swiper-pagination-bullet-active {
        background-color: #DEE3FF;
        color: #19224C;
    }
    </style>
</head>

<body>
    <!-- Begin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{$properties['native']}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{route('offers.all')}}" class="btn btn-dark">{{__('messages.home')}}</a>
                </li>
            </ul>

        </div>
    </nav>
    <!-- End Navbar -->
    @yield('content')



    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
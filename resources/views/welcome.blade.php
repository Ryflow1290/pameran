<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME') ?? 'SIPATA'}}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif;
            font-style: normal;
        }

        body {
            background-color: #F5F3F4;
            overflow-x: hidden;
        }
        .banner{
            max-height: 300px;
            object-fit: cover;
        }
        .navbar {
            background-color: #161A1D;
        }

        .navbar-brand,
        .navbar .nav-link {
            color: #fff !important;
        }

        .hero-section {
            background-color: #161A1D;
            padding: 60px 0;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto;
        }

        .search-bar input {
            border-radius: 20px;
            padding: 10px 20px;
        }

        .category-title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .tab-content {
            padding: 60px 0;
        }

        .category-card {
            padding: 25px;
            border: none;
            text-align: center;
            background: #fff;
            border-radius: 10px;
            transition: transform 0.2s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .category-card img {
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .category-subtitle {
            font-size: 0.75rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{route('utama')}}" style="display: flex; gap: 8px;" class="navbar-brand">
                <img src="{{asset('img/favicon.png')}}" style="max-height: 60px;" alt="">
                <div style="display: flex; flex-direction: column; gap: 0px; align-items: start; justify-content: center;">
                <div>{{env('APP_NAME') ?? 'SIPATA'}}</div>
                </div>
            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="fill: white;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project">Semua</a>
                    </li>
                    <li class="nav-item">
                    @guest
                        <a class="nav-link" href="{{route('login')}}">
                            Login
                        </a>
                        @else
                        @if(Auth::user()->role == 'pengunjung')
                        <a href="">
                            <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                        @else
                        <a class="nav-link" href="{{route('login')}}">
                            Dashboard
                        </a>
                        @endif
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1>Sistem Informasi Pameran Tugas Akhir                    </h1>
                    <p>Cari ide atau publikasikan tugas akhir kamu untuk inspirasi banyak orang.                    </p>
                    <div class="search-bar w-100">
                        <input type="text" class="form-control" placeholder="Cari Judul" onkeyup="window.location='/project'">
                    </div>
                </div>
                <div class="col-lg-6">
                    <img width="300" height="" src="https://1.bp.blogspot.com/-n31dgQ6nBUE/XTnHqaWJZ8I/AAAAAAAAAHM/TUrWRPQezHQV6I8RPP8c2uUZCqfvAdpwgCLcBGAs/s1600/2.INDONUSA.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <div class="row p-4">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                @foreach($banners as $b)
                <div class="carousel-item @if($loop->iteration == 1) active @endif">
                    <img src="{{Storage::url('public/'.$b->image_path)}}" class="d-block w-100 banner" alt="{{$b->title}}">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-black rounded-5" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-black rounded-5" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Category Section -->
    <section class="tab-content">
        <div class="container">
            <h2 class="text-center mb-4">Explore Berdasarkan Jurusan</h2>
            <ul class="nav nav-tabs justify-content-center mb-4 text-primary" id="myTab" role="tablist">
                @foreach($jurusans as $j)
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-primary @if($loop->iteration == 1)  active @endif" id="{{$j->code}}-tab" data-bs-toggle="tab" href="#{{$j->code}}" role="tab" aria-controls="{{$j->code}}" aria-selected="true">{{$j->name}}</a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- Technology Tab -->
                @foreach($jurusans as $j)
                <div class="tab-pane fade show @if($loop->iteration == 1)  active @endif" id="{{$j->code}}" role="tabpanel" aria-labelledby="{{$j->code}}-tab">
                    <div class="row g-4">
                        @foreach($j->pamerans as $p)
                        <a href="{{route('pameran.show',$p->id)}}" class="col-md-3 col-sm-6 text-dark" style="text-decoration: none;">
                            <div class="category-card">
                                <img src="@if($p->files != null && $p->files->where('type','image')->first() != null) {{Storage::url('public/'.$p->files->where('type','image')->first()->path)}}  @else https://via.placeholder.com/300x200?text={{$p->description}} @endif" class="img-fluid" alt="{{$p->description}}">
                                <div class="p-3">
                                    <p class="category-title">{{$p->title}}</p>
                                    <p class="category-subtitle">oleh {{$p->user->name}} {{$p->user->last_name}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach

                        <!-- Add more technology items here -->
                    </div>
                </div>

                @endforeach

                <!-- Animals Tab -->

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            <p>&copy; 2024 SVG Repo. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            $('a[data-bs-toggle="tab"]').on('click', function() {
                var target = $(this).attr('href');
                $('.tab-pane').removeClass('show active');
                $(target).addClass('show active');
            });
        });
    </script>
</body>

</html>
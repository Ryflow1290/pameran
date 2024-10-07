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

        .title {
            font-weight: bold;
            font-size: 2rem;
        }

        .date {
            color: #8f8f8f;
        }

        .desc {
            font-size: 1.5rem;
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
                    <!-- <div >Pamerin</div>
                    <div style="color: whitesmoke; font-size: 70%;">Pameran Indonusa</div> -->
                    <div>{{env('APP_NAME') ?? 'SIPATA'}}</div>
                </div>
            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
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
                        <a class="nav-link" href="{{route('login')}}">@guest
                            Login
                            @else
                            Dashboard
                            @endguest</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if ($errors->any())
    <div class="alert alert-danger border-left-danger" role="alert">
        <ul class="pl-4 my-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-8">
                <div class="row d-flex flex-col">
                    <div class="d-flex flex-row justify-content-between align-items-start ">
                        <div class="title ">
                            {{$pameran->title}}
                        </div>
                        <div class="">
                            <button class="btn btn-primary" style="min-width: 100px; margin-left: 25px;" onclick="Copy();" id="kopi">Salin Link </button>
                        </div>
                    </div>
                    <div class="date">
                        Dipublikasikan {{($pameran->created_at)->diffForHumans()}}
                    </div>

                    <div class="desc">
                        {{$pameran->description}}
                    </div>
                    <div class="w-100">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-5">
                <div class="card p-3">
                    <h5>{{$pameran->user->name}}</h5>
                    <p>Program Studi : {{$pameran->jurusan->name}}</p>
                    <p>Tahun Lulus : {{$pameran->user->tahun->tahun}}</p>
                </div>

            </div>
        </div>
        @foreach($pameran->files->where('type','video') as $v)
        <div>
            <video controls class="img-thumbnail rounded-4 col-lg-5">
                <source src="{{ asset('storage/' . $v->path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div style="color: #8f8f8f;">
                &nbsp; {{$v->caption}}
            </div>
        </div>
        @endforeach
        @foreach($pameran->files->where('type','image') as $i)
        <div class="align-self-center">
            <div>
                <img src="{{Storage::url('public/'.$i->path)}}" class="col-lg-4 rounded-4 border" alt="">
            </div>
            <div style="color: #8f8f8f;">
                &nbsp; {{$i->caption}}
            </div>
        </div>
        @endforeach
        <div class="">
            <h5>Abstract</h5>
            <p>{!! $pameran->abstract !!}</p>
        </div>
    </div>
    <div class="bg-white py-4">
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4 class=""><strong>Rating</strong></h4>
                @guest
                <a href="{{route('login')}}" class="btn btn-primary text-bold">Login Here</a>
                @else
                @if($isRatingOn)
                <div class="card px-4 d-flex justify-content-center items-center mt-2 col-lg-4 p-2">
                        <form id="likeForm" action="{{ route('ratings.store', $pameran->id) }}" id="rating" method="POST" class="text-center rating w-full d-flex justify-content-center align-items-center">
                            @csrf
                            <input type="text" value="{{$pameran->id}}" name="pameran_id" hidden>
                            @if(!$alreadyRated)
                            <input id="1" type="text" value="1" hidden name="rating">
                            <label for="1" onclick="getElementById('likeForm').submit()" style="width: 40px; height: 40px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16l-97.5 0c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8l97.5 0c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32L0 448c0 17.7 14.3 32 32 32l64 0c17.7 0 32-14.3 32-32l0-224c0-17.7-14.3-32-32-32l-64 0z" />
                                </svg> 
                            </label>
                            <div style="font-weight: bolder; margin-left: 10px;">
                                {{count($ratings) ?? 0}}
                            </div>
                            @else
                            <input id="1" type="text" value="1" hidden name="rating">
                            <label for="1" onclick="getElementById('likeForm').submit()" style="width: 40px; height: 40px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2l144 0c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48l-97.5 0c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3l0-38.3 0-48 0-24.9c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192l64 0c17.7 0 32 14.3 32 32l0 224c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32L0 224c0-17.7 14.3-32 32-32z" />
                                </svg>
                            </label>
                            <div style="font-weight: bolder; margin-left: 10px;">
                                {{count($ratings) ?? 0}}
                            </div>
                            @endif

                        </form>
                </div>
                @else

                Periode Rating Sudah Ditutup

                @endif

                @endguest
            </div>
        </div>
    </div>
    </div>


    <!-- Footer -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            <p>&copy; 2024 PAMERIN. All Rights Reserved.</p>
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
            $('#kopi').on('click', function() {
                Copy();
            });

            function Copy() {
                window.navigator.clipboard.writeText('{{url("/pameran/$pameran->id")}}');
            }
        });
    </script>
</body>

</html>
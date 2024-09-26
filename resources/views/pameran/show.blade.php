<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAMERIN Indonusa</title>
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
            font-size: 3rem;
        }

        .date {
            color: #8f8f8f;
        }

        .desc {
            font-size: 1.5rem;
        }



        .rate {
            border-bottom-right-radius: 12px;
            border-bottom-left-radius: 12px
        }

        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }

        .buttons {
            top: 36px;
            position: relative
        }

        .rating-submit {
            border-radius: 8px;
            color: #fff;
            height: auto
        }

        .rating-submit:hover {
            color: #fff
        }

        .rated {
            color: #FFD600;

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
                    <div >Pamerin</div>
                    <div style="color: whitesmoke; font-size: 70%;">Pameran Indonusa</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                @foreach($pameran->files->where('type','flyer') as $f)
                <div class="col-lg-4 w-100 mt-3">
                    <a class="btn btn-danger" href="{{Storage::url('public/'.$f->path)}}" download="{{$f->caption}}">Download Berkas PDF </a>
                </div>
                @endforeach
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
                <h1>@if($rataRata > 0) {{number_format($rataRata, 1, '.', '')}} / 5.0 @else Belum ada Rating @endif</h1>
                @guest
                Login First to rating :D
                @else
                    @if($isRatingOn)
                        @if(!$alreadyRated)
                        <div class="card px-4 d-flex justify-content-center mt-5 col-lg-4">
                            <div class="text-center mb-5">
                                <form action="{{ route('ratings.store', $pameran->id) }}" id="rating" method="POST" class="text-center rating">
                                    @csrf
                                    <input type="text" name="pameran_id" value="{{$pameran->id}}" hidden>
                                    <input type="radio" name="rating" value="5" id="5">
                                    <label for="5">☆</label> <input type="radio" name="rating" value="4" id="4">
                                    <label for="4">☆</label>
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </form>
                                <div class="buttons  mt-0">
                                    <button class="btn btn-primary" type="submit" form="rating">Submit</button>
                                </div>
                            </div>
                        </div>
                        @else
                        Sudah Rating :D
                        
                        @endif
                    @else

                        Periode Rating Sudah Ditutup

                    @endif

                @endguest
                <hr>
                @foreach($ratings as $r)
                @if( Auth::check())
                    @if(Auth::user()->id == $r->user_id)
                    <div class="py-1 col-lg-6">
                        <div class="card">
                            <div class="card-body "><strong>{{$r->user->name}}</strong>
                                @for($i = $r->count; $i > 0; $i--)
                                <span class="rated">☆</span>
                                @endfor
                            </div>
                                @if(Auth::user()->id == $r->user_id)
                                <div class="card-footer">
                                    <form action="{{ route('ratings.destroy', $r->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this rating?')">Delete</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endif
                @endforeach
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
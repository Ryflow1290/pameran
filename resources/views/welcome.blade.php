<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pamerin</title>
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
            <a class="navbar-brand" href="#">Pamerin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
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
                    <h1>Pamerin Project Akhir Kamu Di Sini</h1>
                    <p>Cari ide atau publikasikan project kamu untuk inspirasi banyak orang.</p>
                    <div class="search-bar w-100">
                        <input type="text" class="form-control" placeholder="Cari Judul">
                    </div>
                </div>
                <div class="col-lg-6">
                    <svg xmlns="http://www.w3.org/2000/svg" id="currentIllo" width="400" height="300" viewBox="0 0 731.66998 619.11871" class="injected-svg DownloadModal__ImageFile-sc-p17csy-5 iIfSkb grid_media" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path d="m0,599.59869c0,.65997.53,1.19,1.19,1.19h729.28998c.65997,0,1.19-.53003,1.19-1.19s-.53003-1.19-1.19-1.19H1.19c-.66,0-1.19.53003-1.19,1.19Z" fill="#3f3d56"></path>
                        <polygon points="405.32999 539.69873 405.32999 579.02874 435.07001 579.9887 433.82999 539.69873 405.32999 539.69873" fill="#ffb6b6"></polygon>
                        <path d="m399.45001,561.57873c-.39999,0-.79999.04999-1.17999.15997-5.37,1.53003-36.42999,29.27002-45.82001,37.72998-1.16,1.04999-1.78,2.53998-1.69,4.09998.07999,1.54999.85999,2.96002,2.12,3.87,7.12,5.13,21.72,13.25,39.41998,9.96997,8.14001-1.51001,16.35999-2.46002,23.62-3.28998,15.53-1.78998,27.79001-3.21002,27.79001-8.70001,0-9.33002-2.56-33.90002-5.78-34.92999-.29001-.09003-.63.14001-1.01999.67999-4.92001,6.89001-21.84,3.22998-22.56,3.07001l-.19-.03998-.10999-.15997c-.09-.13-8.37-12.44-14.60001-12.44h0v-.02002h0v.00006Z" fill="#2f2e41"></path>
                        <polygon points="349.70001 539.69873 349.70001 579.02874 379.42999 579.9887 378.19 539.69873 349.70001 539.69873" fill="#ffb6b6"></polygon>
                        <polygon points="337.70999 258.16873 321.88 270.15872 319 405.40872 345.85999 553.12872 380.87 554.56872 381.82999 413.55871 426.92001 285.02871 417.79999 254.80873 337.70999 258.16873" fill="#2f2e41"></polygon>
                        <polygon points="411.57001 281.18872 426.92001 285.02871 437.95001 553.12872 398.14001 549.76873 371.76001 360.31872 411.57001 281.18872" fill="#2f2e41"></polygon>
                        <path d="m328.47,619.11871c-13.64999,0-24.73001-6.03003-30.64999-10.09998-1.79001-1.22998-2.89999-3.17999-3.04001-5.34998-.14001-2.19.70999-4.28998,2.34-5.76001,14.70001-13.21997,40.12-35.62,45.25-37.09003,6.64999-1.90997,15.57999,10.81,16.73001,12.5,1.85999.38,17.09,3.28998,21.38-2.72998.82001-1.15002,1.59-1.20001,2.09-1.03998,4.59,1.46997,6.45001,31.03003,6.45001,35.84998,0,6.34998-12.01001,7.73999-28.64001,9.65997-7.23999.84003-15.44,1.78003-23.54999,3.28003-2.88.53003-5.67001.77002-8.37.77002h0l.00998.00995Z" fill="#2f2e41"></path>
                        <path id="uuid-bcebe549-af57-499c-bd7d-dc350147856d-323" d="m216.28999,83.17871c-5.08-11.22-3.17-22.98,4.27-26.25s17.59,3.18,22.67,14.41c2.09,4.46,3.05,9.36,2.78,14.29l20.90001,47.84-23.58,9.46001-18.10001-48.16c-3.89999-3.1-6.97-7.07-8.94-11.58h0s0-.01001,0-.01Z" fill="#ffb6b6"></path>
                        <path d="m360.76001,103.48873h0c12.73999,12.02,11.95001,32.52-1.69,43.51l-66.79999,53.82001c-7.29001,5.87-18.10999,3.8-22.70999-4.36-17.55-28.42-20.86-29.98-31.07001-59.09999l28.76999-10.06,16.22,20.31,35.42001-41.78c10.70001-12.63,29.81-13.69,41.85001-2.34h0l.00998-.00002Z" fill="#6c63ff"></path>
                        <polygon points="370.60001 82.98873 381.51999 104.99873 340.23001 124.93872 340.73001 89.64872 370.60001 82.98873" fill="#ffb6b6"></polygon>
                        <circle cx="340.37" cy="62.47873" r="37.16" fill="#ffb6b6"></circle>
                        <path d="m340.12,116.35871l38.10001-22.51h0c27.94,19.6,51.20999,24.18,51.95001,58.3l-5.14999,81.39.29999,35.05c.13,14.72-11.76999,26.70999-26.48001,26.70999h-54.39999c-14.39999,0-25.12-13.28-22.09-27.35999l10.26999-47.69-10.97-92.94,18.47-10.97h0v.02h0v.00002-.00002Z" fill="#6c63ff"></path>
                        <path d="m127.69,69.65873c0-1.95,1.58-3.52,3.52-3.52h39.71001c1.95,0,3.52,1.58,3.52,3.52v.48l97.93001,5.73c.28-1.11,1.28-1.94,2.48999-1.94h10.41v-7.61c0-1.7,1.38-3.07,3.07001-3.07h2.12v-6.72c0-1.07.87-1.94,1.94-1.94h5.92999c1.07001,0,1.94.87,1.94,1.94v6.72h1.95001c-.14001-.27-.22-.56-.22-.87,0-1.43,1.67999-2.6,3.75-2.6s3.75,1.16,3.75,2.6c0,.37-.12.73-.32001,1.05,1.19.42,2.06,1.55,2.06,2.89v39.46c0,1.7-1.38,3.07-3.07001,3.07h-19.82999c-1.70001,0-3.07001-1.38-3.07001-3.07v-5.3h-10.41c-1.34,0-2.42999-1.03-2.54999-2.34l-98.03,18.05c-.45,1.43-1.78,2.47-3.36,2.47h-39.71001c-1.95,0-3.52-1.58-3.52-3.52-.47-16.1.57-31.39,0-45.48,0,0-.00002,0-.00002,0Z" fill="#3f3d56"></path>
                        <path id="uuid-56498841-4b1e-4105-a308-6339b9438744-324" d="m281.03,94.43872c-4.95001-11.28-2.89999-23.01,4.57999-26.2,7.48001-3.18,17.54999,3.38,22.5,14.67,2.04001,4.48,2.94,9.39,2.60999,14.32l20.34,48.07999-23.69,9.19-17.54001-48.37c-3.87-3.14-6.89001-7.15-8.79999-11.69h.00003Z" fill="#ffb6b6"></path>
                        <path d="m425.25,116.43872h0c12.60001,12.17001,11.56,32.66-2.20001,43.49001l-67.41998,53.03c-7.35999,5.78999-18.14999,3.59-22.66-4.62-17.22-28.62-18.61002-24.73-28.48001-53.97l26.54999-16.74001,16.42001,22.03,35.89999-41.36c10.85001-12.5,29.97-13.34,41.88-1.85h.01001s0-.01001,0-.01Z" fill="#6c63ff"></path>
                        <path d="m378.57999,81.16873l-6.87,4.92s-2.01999-21.45-4.81-22.4-6.54999,3.99-6.54999,3.99l-2.75,8.05-9.09-3.79s-10.51999-5.67-14.23999-6.94-3.16-12.05-3.16-12.05c0,0-44.63998,6.11-37.94-19.62,0,0,2.31-18.93,7.25-15.17s5.01001-5.56,5.01001-5.56l11.20001-2.41s15.37-20.7,45.69-3.09c30.32001,17.61,16.25,74.05,16.25,74.05h0v.02s.00995,0,.00995,0Z" fill="#2f2e41"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <div class="row p-4">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                @foreach($banners as $b)
                <div class="carousel-item @if($loop->iteration == 1) active @endif">
                    <img src="{{'storage/'.$b->image_path}}" class="d-block w-100 banner" alt="{{$b->title}}">
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
                                <img src="@if($p->files != null && $p->files->where('type','image')->first() != null) {{Storage::url($p->files->where('type','image')->first()->path)}}  @else https://via.placeholder.com/300x200?text={{$p->description}} @endif" class="img-fluid" alt="{{$p->description}}">
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
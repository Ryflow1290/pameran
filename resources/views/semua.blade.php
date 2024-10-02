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
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">
    <style>
        * {
            font-family: "Poppins", sans-serif;
            font-style: normal;
        }

        body {
            background-color: #F5F3F4;
            overflow-x: hidden;
        }

        .banner {
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

        footer.fixed-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
            /* Ensures the footer stays on top */
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
                        <a class="nav-link" href="{{route('login')}}">
                            @guest
                            Login
                            @else
                            Dashboard
                            @endguest</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex flex-column justify-content-center">
                    <p>Cari ide atau publikasikan project kamu untuk inspirasi banyak orang.</p>
                    <div class="search-bar w-100">
                        <input type="text" class="form-control" id="search-input" placeholder="Cari Judul">
                        <!-- <button class="btn btn-primary"></button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="table" class="container mt-5">
        <div class="row" id="project-cards">
            <!-- Cards will be dynamically added here -->
        </div>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination buttons will be dynamically added here -->
            </ul>
        </nav>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white fixed-bottom">
        <div class="container text-center">
            <p>&copy; 2024 SVG Repo. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->

    <script>
        $(document).ready(function() {
            // Function to fetch projects with pagination and search
            function fetchProjects(page = 1, search = '') {
                $.ajax({
                    url: '{{ route("semua.data") }}',
                    type: 'GET',
                    data: {
                        page: page,
                        search: search
                    },
                    success: function(response) {
                        // Clear existing content
                        $('#project-cards').empty();

                        // Loop through the project data and append cards
                        $.each(response.data, function(index, project) {
                            $('#project-cards').append(`
                            <a href="/pameran/${project.id}" class="col-md-4 mb-4" style="text-decoration:none; color:black;">
                                <div class="card h-100 shadow">
                                    <div class="card-body">
                                        <h5 class="card-title">${project.title}</h5>
                                        <p class="card-text">${project.description}</p>
                                        <p class="card-text"><small class="text-muted">Published : ${project.created_at}</small></p>
                                        <p class="card-text"><small class="text-muted">By ${project.user.name}, ${project.jurusan.name}</small></p>
                                    </div>
                                </div>
                            </a>
                        `);
                        });

                        // Update pagination buttons
                        updatePagination(response.total_pages, response.current_page);
                    }
                });
            }

            // Function to update the pagination controls
            function updatePagination(totalPages, currentPage) {
                $('#pagination').empty(); // Clear existing pagination

                // Create previous button
                if (currentPage > 1) {
                    $('#pagination').append(`<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a></li>`);
                } else {
                    $('#pagination').append(`<li class="page-item disabled"><a class="page-link">Previous</a></li>`);
                }

                // Create page buttons dynamically
                for (let i = 1; i <= totalPages; i++) {
                    $('#pagination').append(`
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `);
                }

                // Create next button
                if (currentPage < totalPages) {
                    $('#pagination').append(`<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">Next</a></li>`);
                } else {
                    $('#pagination').append(`<li class="page-item disabled"><a class="page-link">Next</a></li>`);
                }
            }

            // Initial fetch
            fetchProjects();

            // Pagination click event
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var search = $('#search-input').val();
                fetchProjects(page, search);
            });


            $('#search-input').on('keyup', function() {
                var search = $(this).val();
                fetchProjects(1, search);
            });
        });
    </script>

</body>

</html>
<!doctype html>
<html lang="pl">
    <head>
        <title>Przychodnia ACME</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,900;1,500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/2e29588e51.js" crossorigin="anonymous"></script>
    </head>
    <body>


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rMWCnxwDxHyCapmgYTypH3f54XqkLYfxhZ8H+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSdAmvia1qwwkc2ssfu0sy7c6qhr8e4curh64j8vglc0pz0mqceunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfiGdIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



        <!--Nav bar-->
        <nav class="navbar navbar-expand-lg nav-back fixed-top" id="nav">
            <div class="container">
                <a class="navbar-brand" href="/">Przychodnia ACME</a>
                <button class="navbar-toggler navbar-toggler-right"type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-comment-medical fa-2x"></i>
                </button>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Usługi</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">O nas</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Kontakt</a>
                        </li>
                        @if (Route::has('login'))
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Zaloguj</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Rejestracja</a>
                        </li>
                        @endif
                    @endif
                    
                </div>
            @endif
            

                    </ul>
                </div>
            </div>
        </nav>
        <!--koniec paska nav bar-->
        <!-- hero image -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container text-center position-relative">
                <h1>Wasze zdrowie to dla nas priorytet</h1>
                <h2 class="text-uppercase">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, nam.</h2>
                    <a href="#" class="main-btn">Dowiedz się więcej</a>
            </div>

        </section>
        <!-- koniec hero image -->
        <!-- usługi -->
        <section id="services" class="services mt-5 py-3">
            <div class="container">
                <div class="section-title">
                    <h2 class="text-center">Usługi</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, excepturi natus. Facilis corporis sed harum!</p>
                </div>
                <div class="row">
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-tooth"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-lungs"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-dna"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-ambulance"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="service shadow">
                            <div class="icon">
                                <i class="fas fa-allergies"></i>
                            </div>
                            <h4>Lorem ipsum</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quod porro labore. Repellat, dolor aut nisi officiis perspiciatis hic?</p>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </section>
        <!-- Koniec usług -->





























































    </body>
</html>
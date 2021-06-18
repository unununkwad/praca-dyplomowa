<!doctype html>
<html lang="pl">
    <head>
        <title>Przychodnia ACME</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/main.css">

        
        @livewireStyles
        @livewireScripts

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,900;1,500&display=swap" rel="stylesheet">

        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
        <script src="https://kit.fontawesome.com/2e29588e51.js" crossorigin="anonymous"></script>
    </head>
    <body>


    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rMWCnxwDxHyCapmgYTypH3f54XqkLYfxhZ8H+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSdAmvia1qwwkc2ssfu0sy7c6qhr8e4curh64j8vglc0pz0mqceunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfunpvehrpfiGdIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    @livewire('navigation-dropdown')
    <!--koniec paska nav bar-->
    <!-- hero image -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative">
            <h1>Wasze zdrowie to dla nas priorytet</h1>
            <h2 class="text-uppercase">Robimy wszystko co w naszej mocy, aby nasi pacjenci byli zdrowi.</h2>
                @if (Route::has('login'))
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                    @auth
                        <a href="/dashboard" class="main-btn">Przejdź do profilu użytkownika</a>
                    
                @else
                    <a href="{{ route('login') }}" class="main-btn">Umów się na spotkanie</a>
                    @endif
                @endif
        </div>

    </section>
    <!--  -->






    <!-- O nas -->
    <section class="about-section clearfix py-5" id="o_nas">
        <div class="container">
            <div class="about">
                <img class="about-img img-fluid mb-3 mb-lg-0 rounded" src="../images/blur-hospital.jpg" alt="">
                <div class="about-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="about-heading mb-4">
                        <span class="about-heading-upper">WITAMY</span>
                        <span class="about-heading-lower">W przychodni ACME</span>
                    </h2>
                    <p class="mb-3"> Znajdziecie tutaj Państwo licznych specjalistów z zakresu podstawowej opieki zdrowotnej. Przychodnia ACME to miejsce, gdzie wszystkie starania koncentrują się wokół pacjenta i jego potrzeb. Szczególną uwagę zwróciliśmy na stworzenie przyjaznego otoczenia, w którym każdy poczuje się swobodnie i bezpiecznie. Jesteśmy przekonani, że połączenie wysokiej jakości oferowanych usług, dobrej organizacji pracy i obsługi pacjenta wraz z komfortowym wystrojem wnętrz sprawi, że miejsce to będzie gwarancją Twojego sukcesu na każdym etapie leczenia.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--  -->




    <!-- kontakt -->
    <section class="contact" id="kontakt">
        <div class="container">
            <div class="section-title text-center mt-5">
                <h2>Dane kontaktowe</h2><br>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-box">
                        <i class="fas fa-map-signs"></i>
                        <h3>Adres</h3>
                        <p>Pacanów 32</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-box mt-4">
                        <i class="fas fa-envelope"></i>
                        <h3>Adres e-mail</h3>
                        <p>adres1@email.pl<br>adres2@email.pl</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-box mt-4">
                        <i class="fas fa-phone"></i>
                        <h3>Nr telefonu</h3>
                        <p>+123 456 789 <br>+987 654 321</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->




    <!-- stopka -->
    <footer class="footer py-4 mt-5">
        <div class="container">
                <div class="text">Copyright © Jakub Jastak 2021</div>
        </div>
    </footer>
    <!--  -->
    </body>
</html>
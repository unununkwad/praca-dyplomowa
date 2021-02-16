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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



<div class = "card-body">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<a class="btn btn-primary btn-lg" href="/user">
    User Page
</a>

@if (Auth::user()->hasRole('admin'))
    <a class="btn btn-primary btn-lg" href="/admin">
        Admin Page
    </a>
@endif

@if (Auth::user()->hasRole('lekarz'))
    <a class="btn btn-primary btn-lg" href="/lekarz">
        Lekarz Page
    </a>
@endif

@if (Auth::user()->hasRole('recepcja'))
    <a class="btn btn-primary btn-lg" href="/recepcja">
        Recepcja Page
    </a>
@endif

</div>


    <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> -->
</x-app-layout>

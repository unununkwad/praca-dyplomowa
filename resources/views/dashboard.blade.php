
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

<a class="btn btn-primary btn-lg" href="/">
    Home Page
</a>

<a class="btn btn-primary btn-lg" href="/pacjent/profil">
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



</x-app-layout>

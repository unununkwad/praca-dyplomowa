
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil administratora') }}
        </h2>
    </x-slot>



    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <a class="btn btn-primary btn-lg" href="/">
            Strona główna
        </a>

        <a class="btn btn-primary btn-lg" href="/pacjent/profil">
            Profil pacjenta
        </a>

        @if (Auth::user()->hasRole('admin'))
            <a class="btn btn-primary btn-lg" href="/admin">
                Uprawnienia użytkowników
            </a>
        @endif

        @if (Auth::user()->hasRole('lekarz'))
            <a class="btn btn-primary btn-lg" href="/lekarz">
                Profil lekarza
            </a>
        @endif

        @if (Auth::user()->hasRole('recepcja'))
            <a class="btn btn-primary btn-lg" href="/recepcja">
                Profil recepcji
            </a>
        @endif

    </div>



</x-app-layout>

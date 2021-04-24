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
            {{ __('Admin page') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
                @if(isset($users))
                    @foreach ($users as $user)
                        <div class="row mb-4">
                            <div class="col-sm-2">
                                {{$user->name}}
                                @foreach ($user->roles as $role)
                                    <small class="text-muted">{{$role->name}}</small>
                                @endforeach
                            </div>
                            <div class="col-sm-2 mb-2">
                                @if($user->hasRole('lekarz'))
                                        <a class="btn btn-primary" href="/admin/remove-lekarz/{{$user->id}}">
                                            Odbierz uprawnienia lekarza
                                        </a>
                                    @else
                                        <a class="btn btn-primary" href="/admin/give-lekarz/{{$user->id}}">
                                            Nadaj uprawnienia lekarza
                                        </a>
                                @endif
                            </div>

                            <div class="col-sm-2 mb-2">
                                @if($user->hasRole('recepcja'))
                                        <a class="btn btn-primary" href="/admin/remove-recepcja/{{$user->id}}">
                                            Odbierz uprawnienia recepcji
                                        </a>
                                    @else
                                        <a class="btn btn-primary" href="/admin/give-recepcja/{{$user->id}}">
                                            Nadaj uprawnienia recepcji
                                        </a>
                                @endif
                            </div>

                            <div class="col-sm-2 mb-2">
                                @if($user->id != Auth::user()->id)
                                    @if($user->hasRole('admin'))
                                        <a class="btn btn-primary" href="/admin/remove-admin/{{$user->id}}">
                                            Odbierz uprawnienia administratora
                                        </a>
                                    @else
                                        <a class="btn btn-primary" href="/admin/give-admin/{{$user->id}}">
                                            Nadaj uprawnienia administratora
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

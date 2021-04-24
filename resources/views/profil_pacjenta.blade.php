<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Profil pacjenta') }}
                </h2>
            </div>
            @if($role=="lekarz")
                <div class="col-md-6">
                    <a class="btn btn-outline-primary btn-lg float-right" href="/lekarz">
                        <i class="fas fa-arrow-circle-left"></i>
                        Wróć
                    </a>
                </div>
            @endif
    </x-slot>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">


        <section class="content pt-3">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Dane pacjenta</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>
                                            @if(isset($users))
                                                @foreach ($users as $user)
                                                    {{$user->name}}
                                                @endforeach
                                            @endif
                                        </h2><br>
                                        Numer pesel: <h3>987234598457</h3>
                                    </div>
                                    <div class="col-md-6">
                                        Numer telefonu: <h4>987234598457</h4><br>
                                        Adres e-mail: 
                                        <h4>
                                            @if(isset($users))
                                                @foreach ($users as $user)
                                                    {{$user->email}}
                                                @endforeach
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-lg float-right">
                                    <i class="fas fa-edit">
                                    </i>
                                    Edytuj
                                </button>
                            </div>
                        </div>








                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Lista wszystkich terminów</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-striped projects mb-4">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                #
                                            </th>
                                            <th style="width: 40%">
                                                Imię i nazwisko lekarza
                                            </th>
                                            <th style="width: 30%">
                                                Data i godzina terminu
                                            </th>
                                            <th style="width: 20%">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            @if(isset($events))
                                                @foreach ($events as $event)
                                                    <form action="/user/delete-event/{{$event->start}}/{{$user->name}}" method="POST" role="delete">
                                                    @csrf
                                                        <tr>
                                                            <td>
                                                                #
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                    {{$event->name}}
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                    {{$event->start}}
                                                                </h5>
                                                            </td>
                                                            <td class="project-actions text-right">
                                                                @if($event->start>$now)
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash-alt">
                                                                        </i>
                                                                        Usuń termin
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-secondary btn-sm" disabled="true">
                                                                        <i class="fas fa-exclamation-circle">
                                                                        </i>
                                                                        Termin minął
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </form>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <a class="btn btn-primary btn-lg float-right" href="/user/termin">Nowy termin</a>
                            </div>
                        </div>
                    </div>





                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">historia chorób</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2>Imię i nazwisko</h2><br>
                                        Numer pesel: <h3>987234598457</h3>
                                    </div>
                                    <div class="col-md-6">
                                        Numer telefonu: <h3>987234598457</h3><br>
                                        Adres e-mail: <h3>nazwa@mail.com</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







            </div>
        </section>




        






<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->


</x-app-layout>

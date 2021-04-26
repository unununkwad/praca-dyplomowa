<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Profil pacjenta') }}
                </h2>
            </div>
            @if(isset($role) && $role=="lekarz")
                <div class="col-md-6">
                    <a class="btn btn-outline-primary btn-lg float-right" href="/lekarz">
                        <i class="fas fa-arrow-circle-left"></i>
                        Wróć
                    </a>
                </div>
            @endif
            @if(isset($role) && $role=="recepcja")
                <div class="col-md-6">
                    <a class="btn btn-outline-primary btn-lg float-right" href="/recepcja">
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


                            <form action="/user/profil/edit" method="POST">
                            @csrf
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
                                            
                                            @if(isset($additional_Data)  && count($additional_Data)>0)
                                                @foreach ($additional_Data as $additional_Data1)
                                                    Numer pesel: 
                                                    @if($additional_Data1->pesel==0)
                                                        <input type="text" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel">
                                                        <h3 id="pesel_Show">Nie podano</h3>
                                                    @else
                                                        <input type="text" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel" value="{{$additional_Data1->pesel}}">
                                                        <h3 id="pesel_Show">{{$additional_Data1->pesel}}</h3>
                                                    @endif
                                        </div>
                                        <div class="col-md-6">
                                                    Numer telefonu:
                                                    @if($additional_Data1->phone_number==0)
                                                        <input type="text" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu">
                                                        <h4 id="email_Show">Nie podano</h4><br>
                                                    @else
                                                        <input type="text" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu" value="{{$additional_Data1->phone_number}}">
                                                        <h4 id="email_Show">{{$additional_Data1->phone_number}}</h4><br>
                                                    @endif
                                                @endforeach
                                            @else
                                                Numer pesel: 
                                                <input type="text" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel">
                                                <h3 id="pesel_Show">Nie podano</h3>
                                        </div>
                                        <div class="col-md-6">
                                                Numer telefonu:
                                                <input type="text" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu">
                                                <h4 id="email_Show">Nie podano</h4><br>
                                            @endif

                                            Adres e-mail: 
                                            <h4>
                                                @if(isset($users))
                                                    @foreach ($users as $user)
                                                        {{$user->email}}
                                                    @endforeach
                                                @endif
                                            </h4>
                                        </div>
                                    </div><br>
                                    @if(!isset($role))
                                        <button type="button" class="btn btn-primary btn-lg float-right" id="button_Edit" onclick="show_Edit()">
                                            <i class="fas fa-edit">
                                            </i>
                                            Edytuj
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg float-right" id="button_Save" style="display: none;">
                                            <i class="fas fa-save">
                                            </i>
                                            Zapisz
                                        </button>
                                        <button type="button" class="btn btn-primary btn-lg float-right mr-3" id="button_Back" style="display: none;"  onclick="hide_Edit()">
                                            <i class="fas fa-arrow-left">
                                            </i>
                                            Wróć
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>


                        @if(isset($role) && $role=="recepcja")
                            </div>
                            <div class="col-md-6">
                        @endif


                        @if(!isset($role) || $role=="recepcja")
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
                        @endif
                    </div>




                    @if(!isset($role) || $role=="lekarz")
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
                    @endif
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
<script>
function show_Edit() {
  var pesel_Edit = document.getElementById("pesel_Edit");
  var pesel_Show = document.getElementById("pesel_Show");
  var email_Edit = document.getElementById("email_Edit");
  var email_Show = document.getElementById("email_Show");
  var button_Edit = document.getElementById("button_Edit");
  var button_Save = document.getElementById("button_Save");
  var button_Back = document.getElementById("button_Back");

  
  pesel_Edit.style.display = "block";
  pesel_Show.style.display = "none";
  email_Edit.style.display = "block";
  email_Show.style.display = "none";
  button_Save.style.display = "block";
  button_Back.style.display = "block";
  button_Edit.style.display = "none";
}

function hide_Edit() {
  var pesel_Edit = document.getElementById("pesel_Edit");
  var pesel_Show = document.getElementById("pesel_Show");
  var email_Edit = document.getElementById("email_Edit");
  var email_Show = document.getElementById("email_Show");
  var button_Edit = document.getElementById("button_Edit");
  var button_Save = document.getElementById("button_Save");
  var button_Back = document.getElementById("button_Back");

  
  pesel_Edit.style.display = "none";
  pesel_Show.style.display = "block";
  email_Edit.style.display = "none";
  email_Show.style.display = "block";
  button_Save.style.display = "none";
  button_Back.style.display = "none";
  button_Edit.style.display = "block";
}
</script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


</x-app-layout>

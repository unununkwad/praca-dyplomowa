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
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">


        <section class="content pt-3">
            <div class="container-fluid">

                <div class="alert alert-danger alert-dismissible w-100" id="alert" style="display: none;">
                    <button type="button" class="close" onclick="hide_Alert()">×</button>
                    <center><h5><i class="icon fas fa-ban"></i> Uzupełnij swoje dane!</h5></center>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Panel z Danymi pacjenta -->
                        <!-- Widzą go wszystkie role, ale edytować może tylko pacjent -->
                        <div class="card card-info">
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


                            <form action="/pacjent/profil/edit" method="POST">
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
                                                        <input type="number" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel" min="10000000000" max="99999999999">
                                                        <h3 id="pesel_Show">Nie podano</h3>
                                                    @else
                                                        <input type="number" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel" value="{{$additional_Data1->pesel}}" min="10000000000" max="99999999999">
                                                        <h3 id="pesel_Show">{{$additional_Data1->pesel}}</h3>
                                                    @endif
                                        </div>
                                        <div class="col-md-6">
                                                    Numer telefonu:
                                                    @if($additional_Data1->phone_number==0)
                                                        <input type="number" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu" min="100000000" max="999999999">
                                                        <h4 id="email_Show">Nie podano</h4><br>
                                                    @else
                                                        <input type="number" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu" value="{{$additional_Data1->phone_number}}" min="100000000" max="999999999">
                                                        <h4 id="email_Show">{{$additional_Data1->phone_number}}</h4><br>
                                                    @endif
                                                @endforeach
                                            @else
                                                Numer pesel: 
                                                <input type="number" class="form-control" name="pesel" id="pesel_Edit" style="display: none;" placeholder="Wprowadź pesel" min="10000000000" max="99999999999">
                                                <h3 id="pesel_Show">Nie podano</h3>
                                        </div>
                                        <div class="col-md-6">
                                                Numer telefonu:
                                                <input type="number" class="form-control" name="phone_number" id="email_Edit" style="display: none;" placeholder="Wprowadź numer telefonu" min="100000000" max="999999999">
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




                        <!-- Panel z listą terminów -->
                        <!-- Widzi go recepcja i pacjent -->
                        @if(!isset($role) || $role=="recepcja")
                            <div class="card card-info">
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
                                                        @if(isset($pesel))
                                                            <form action="/recepcja/delete-event/{{$event->start}}/{{$user->name}}" method="POST" role="delete">
                                                        @else
                                                            <form action="/pacjent/delete-event/{{$event->start}}/{{$user->name}}" method="POST" role="delete">
                                                        @endif
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
                                    @if(isset($role) && $role=="recepcja")
                                        @foreach ($users as $user)
                                            <a class="btn btn-primary btn-lg float-right" href="/recepcja/termin/{{$user->pesel}}">
                                                <i class="fas fa-plus-circle"></i>
                                                Nowy termin
                                            </a>
                                        @endforeach
                                    @else
                                        @if(isset($additional_Data)  && count($additional_Data)>0)
                                            @foreach ($additional_Data as $additional_Data1)
                                                Numer pesel: 
                                                @if($additional_Data1->pesel==0 || $additional_Data1->phone_number==0)
                                                    <a class="btn btn-primary btn-lg float-right" onclick="show_Alert()">
                                                        <i class="fas fa-plus-circle"></i>
                                                        Nowy termin
                                                    </a>
                                                @else
                                                    <a class="btn btn-primary btn-lg float-right" href="/pacjent/termin">
                                                        <i class="fas fa-plus-circle"></i>
                                                        Nowy termin
                                                    </a>
                                                @endif
                                            @endforeach
                                        @else
                                            <a class="btn btn-primary btn-lg float-right" onclick="show_Alert()">
                                                <i class="fas fa-plus-circle"></i>
                                                Nowy termin
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>




                    <!-- Panel z historią chorób -->
                    <!-- Widzi go tylko lekarz i pacjent -->
                    @if(!isset($role) || $role=="lekarz")
                        <div class="col-md-6" id="disease_List" style="display: block;">
                            <div class="card card-info">
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
                                    @if(isset($disease))
                                        @foreach ($disease as $disease1)
                                            <table class="table table-striped projects mb-4 border border-info">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100%">
                                                            <form action="/pacjent/choroba/usun/{{$disease1->disease_id}}" method="POST" role="delete">
                                                            @csrf
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        Dodał: {{$disease1->name}}
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        @if(isset($role) && $role=="lekarz")
                                                                            <button type="submit" class="btn btn-outline-danger btn-sm float-right">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                                Usuń
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label>Wywiad: objawy, rozpoznanie, leczenie i uwagi:</label>
                                                            <textarea class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 78px;" disabled>{{$disease1->wywiad}}</textarea>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Numer statystyczny choroby:</label><br>
                                                                        <input type="number" class="form-control" value="{{$disease1->nr_choroby}}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Czy to pierwsze zachorowanie?</label><br>
                                                                        @if($disease1->czy_pierwsze_zachorowanie == 0)
                                                                            <input type="Text" class="form-control" value="Nie" disabled>
                                                                        @else
                                                                            <input type="Text" class="form-control" value="Tak" disabled>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Niezdolność do pracy</label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Od:</label>
                                                                            <div class="input-group date" data-target-input="nearest">
                                                                                <input type="text" class="form-control" value="{{date('Y-m-d', strtotime($disease1->poczatek_choroby))}}" disabled>
                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Do:</label>
                                                                            <div class="input-group date" data-target-input="nearest">
                                                                                <input type="text" class="form-control" value="{{date('Y-m-d', strtotime($disease1->koniec_choroby))}}" disabled>
                                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @endif
                                    @if(isset($role) && $role=="lekarz")
                                        <a class="btn btn-primary btn-lg float-right text-white" onclick=show_Disease()>
                                            <i class="fas fa-plus-circle"></i>
                                            Dodaj chorobę
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif


                    <!-- Panel dodawania choroby do historii -->
                    <!-- Może to robić tylko lekarz -->
                    @if(!isset($role) || $role=="lekarz")
                        <div class="col-md-6" id="disease_New" style="display: none;">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Dodawanie choroby</h3>
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
                                    @foreach ($users as $user)
                                        <form action="/pacjent/choroba/dodaj/{{$user->id}}" method="POST" role="add">
                                        @csrf
                                            <div class="form-group">
                                                <label>Wywiad: objawy, rozpoznanie, leczenie i uwagi:</label>
                                                <textarea class="form-control" rows="3" name="wywiad" style="margin-top: 0px; margin-bottom: 0px; height: 78px;"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Numer statystyczny choroby:</label><br>
                                                        <input type="number" name="nr_choroby" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Czy to pierwsze zachorowanie?</label><br>
                                                        <select class="form-control" name="czy_pierwsze_zachorowanie" id="exampleFormControlSelect1">
                                                            <option value="0">Nie</option>
                                                            <option value="1">Tak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Niezdolność do pracy</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Od:</label>
                                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                <input type="text" name="poczatek_choroby" class="form-control datetimepicker-input" data-target="#reservationdate">
                                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Do:</label>
                                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                                <input type="text" name="koniec_choroby" class="form-control datetimepicker-input" data-target="#reservationdate2">
                                                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary btn-lg float-right">
                                                <i class="fas fa-plus-circle"></i>
                                                Dodaj chorobę
                                            </button>
                                            <button type="button" class="btn btn-primary btn-lg float-right mr-3""  onclick="hide_Disease()">
                                            <i class="fas fa-arrow-left">
                                            </i>
                                            Wróć
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>







            </div>
        </section>




        






<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="/plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
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




function show_Disease() {
  var disease_List = document.getElementById("disease_List");
  var disease_New = document.getElementById("disease_New");

  
  disease_List.style.display = "none";
  disease_New.style.display = "block";
}

function hide_Disease() {
  var disease_List = document.getElementById("disease_List");
  var disease_New = document.getElementById("disease_New");

  
  disease_List.style.display = "block";
  disease_New.style.display = "none";
}

function show_Alert() {
  var alert = document.getElementById("alert");

  alert.style.display = "block";
}

function hide_Alert() {
  var alert = document.getElementById("alert");

  alert.style.display = "none";
}

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });


    //Date picker
    $('#reservationdate2').datetimepicker({
        format: 'YYYY-MM-DD'
    });


</script>
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>


</x-app-layout>

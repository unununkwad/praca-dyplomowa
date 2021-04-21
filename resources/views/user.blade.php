<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User page') }}
        </h2>
    </x-slot>



    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                    <div class="card-header">
                        <h3 class="card-title">Wyszukaj termin spotkania</h3>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-12">
                            <form action="/user/search" method="GET" role="search">
                                <div class="form-group">
                                    <label>Wybierz lekarza:</label>
                                    <select class="form-control select2" style="width: 100%;" name="lekarz">
                                        <option selected>Dowolny</option>

                                        @if(isset($users))
                                            @foreach ($users as $user)
                                                @if($user->hasRole('lekarz'))
                                                    <option>{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    <br>

                                    <div class="form-group">
                                        <label>Wybierz dzień:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest" autocomplete="off">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="Date">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div><br>


                                    <button type="submit" class="btn btn-block btn-primary btn-lg">Szukaj</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>





                <div class="card">

                    <div class="card-body p-0">
                        <table class="table table-striped projects">
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
                                @if(isset($DbDate))
                                    @foreach ($DbDate as $DbDate1)
                                        @foreach ($DbDate1->add15Min() as $Date)
                                            <form action="/user/add-event/{{$DbDate1->id}}/{{$Date}}" method="POST" role="add">
                                            @csrf
                                                <tr>
                                                    <td>
                                                        #
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            {{$DbDate1->name}}
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            {{$Date}}
                                                        </h5>
                                                    </td>
                                                    <td class="project-actions text-right">
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-file-signature">
                                                            </i>
                                                            Zapisz się
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })




    // //Date range picker with time picker
    // $('#reservationtime').daterangepicker({
    //     timePicker: true,
    //     timePickerIncrement: 15,
    //     format: 'MM/DD/YYYY hh:mm A',
    //     locale: 'pl'
    // })


    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 15,
        locale: {
            "format": "DD-MM-YYYY",
            "separator": " - ",
            "applyLabel": "Akceptuj",
            "cancelLabel": "Anuluj",
            "fromLabel": "Od",
            "toLabel": "Do",
            "daysOfWeek": [
                "Pon",
                "Wt",
                "Śr",
                "Czw",
                "Pt",
                "Sob",
                "Niedz"
            ],
            "monthNames": [
                "Styczeń",
                "Luty",
                "Marzec",
                "Kwiecień",
                "Maj",
                "Czerwiec",
                "Lipiec",
                "Sierpień",
                "Wrzesień",
                "Październik",
                "Listopad",
                "Grzudzień"
            ],
            "firstDay": 0
        }
    });



    //Date picker
    $('#reservationdate').datetimepicker({
        format: "YYYY-MM-DD"
    });





  })


</script>

</x-app-layout>

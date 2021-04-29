<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Wyszukaj pacjenta') }}
                </h2>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary btn-lg float-right" href="/pacjent/profil">
                    Osobisty profil pacjenta
                </a>
            </div>
        </div>
    </x-slot>

    <section class="content">
    @if(isset($brak_wyniku) && isset($pesel))
        <div class="alert alert-danger alert-dismissible position-absolute w-100">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <center><h5><i class="icon fas fa-ban"></i> Wprowadzono niepoprawny PESEL!</h5></center>
        </div>
    @endif
    <div class="container-fluid">



        <div class="row" style="min-height:650px">
            <div class="col align-self-center">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <div class="card card-primary">
                            <div class="card-header">
                            </div>
                            <form action="/recepcja/search" method="GET" role="search">
                                <div class="card-body">
                                    <label>Wprowadź PESEL:</label>
                                    @if(isset($brak_wyniku) && isset($pesel))
                                    <input type="number" name="pesel" class="form-control" value="{{$pesel}}" min="10000000000" max="99999999999">
                                    @else
                                    <input type="number" name="pesel" class="form-control" min="10000000000" max="99999999999">
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Sprawdź</button>
                                </div>
                            </form>
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
</x-app-layout>

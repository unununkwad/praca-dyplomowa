<x-app-layout>




    <div class="container">

        <div class="panel panel-primary">
            <x-slot name="header">
            <div class="row">
                    <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Spotkania z pacjentami') }}
                </h2>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-primary btn-lg" href="/user/profil">
                            Osobisty profil pacjenta
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-primary btn-lg" href="/working-hours">
                            Ustaw godziny pracy
                        </a>
                    </div>
                    </div>
            </x-slot>
            <div class="panel-body" >
                <div class="response alert alert-success mt-2" style="display: none;"></div><br>
                    <div id='calendar'></div>
            </div>
        </div>
    </div>





    <!-- Fullcalendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/locale/main.js''></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/locale/pl.js'></script>
    <script>
        $(document).ready(function () {
            var SITEURL = "{{url('/')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var calendar = $('#calendar').fullCalendar({
                locale: 'pl',
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "agendaWeek,agendaDay"
                },
                titleFormat: 'D MMMM, YYYY',
                columnFormat: 'dddd D/M',
                minTime: '05:00:00',
                maxTime: '23:00:00',
                slotDuration: '00:15:00',
                slotLabelInterval: 15,
                slotLabelFormat: 'H(:mm)a',
                slotMinutes: 15,
                defaultView: "agendaWeek",
                navLinks: true,
                selectable: true,
                selectHelper: false,
                editable: false,
                //editable: true,
                eventLimit: true,
                
                events: SITEURL + "/lekarz",
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },

                eventAfterAllRender: function(view){
                    if ($("#calendar .fc-event").length > 0) {
                        var op = 999999;
                        $("#calendar .fc-content-col").each(function(index){
                            if($(this).find('.fc-event:first').length > 0){
                                var ot = $(this).find('.fc-event:first').position().top;
                                if(ot < op){
                                    op=ot;
                                }
                            }
                        });
                        if( op < 999999){
                            $("#calendar .fc-scroller").animate({
                                scrollTop: op
                            }, 250);
                        }
                    }
                },


                eventClick: function (event) {
                    location.href = SITEURL + '/user/profil/' + event.title;
                }
            });
        });


    </script>
    
</x-app-layout>
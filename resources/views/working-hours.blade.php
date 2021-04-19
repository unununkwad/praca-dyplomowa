<x-app-layout>


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
            //displayMessage("Added Successfully");
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
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectHelper: false,
                //editable: false,
                editable: true,
                eventLimit: true,
                allDaySlot: false,
                
                events: SITEURL + "/working-hours",
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
                
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
    
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    
                        $.ajax({
                            url: SITEURL + "/working-hours/create",
                            data: '&start=' + start + '&end=' + end,
                            type: "POST",
                            success: function (data) {
                                //displayMessage("Added Successfully");
                                $('#calendar').fullCalendar('removeEvents');
                                $('#calendar').fullCalendar('refetchEvents');
                            }
                        });
                        calendar.fullCalendar('renderEvent',
                                {
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                },
                        true
                                );
                    calendar.fullCalendar('unselect');
                },
                
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: SITEURL + '/working-hours/update',
                        data: '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            //displayMessage("Updated Successfully");
                        }
                    });
                },

                eventResize: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: SITEURL + '/working-hours/update',
                        data: '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            //displayMessage("Updated Successfully");
                        }
                    });
                },
                
                eventClick: function (event) {
                    var deleteMsg = confirm("Usunąć wybrane godziny?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/working-hours/delete',
                            data: "&id=" + event.id,
                            success: function (response) {
                                if(parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    //displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
                }
            });
        });

    
        function displayMessage(message) {
            $(".response").css('display','block');
            $(".response").html(""+message+"");
            setInterval(function() { $(".response").fadeOut(); }, 4000);
        }
    </script>

    <div class="container">

        <div class="panel panel-primary">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Godziny pracy') }}
                </h2>
            </x-slot>
            <div class="panel-body" >
                <div class="response alert alert-success mt-2" style="display: none;"></div><br>
                    <div id='calendar'></div>
            </div>
        </div>
    </div>
    
</x-app-layout>
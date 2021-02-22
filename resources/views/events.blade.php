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
    <script>
    $(document).ready(function () {
        var SITEURL = "{{url('/')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "agendaWeek,agendaDay"
            },
            defaultView: "agendaWeek",
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: false,
            editable: true,
            eventLimit: true,
            
            events: SITEURL + "/events",
            displayEventTime: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
 
                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
 
                    $.ajax({
                        url: SITEURL + "/events/create",
                        data: 'title=' + title + '&start=' + start + '&end=' + end,
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('refetchEvents' );
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                    true
                            );
                }
                calendar.fullCalendar('unselect');
            },
             
            eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + '/events/update',
                            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success: function (response) {
                                displayMessage("Updated Successfully");
                            }
                        });
                    },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/events/delete',
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
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
        
           
            /*
            $(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },
    defaultView: "month",
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectHelper: false,
    editable: true,
    eventLimit: true, // allow "more" link when too many events

    select: function(start, end) {
      var title = prompt("Event Content xDD:");
      var eventData;
      if (title) {
        eventData = {
          title: title,
          start: start,
          end: end,
          color: $("#colorPicker").val()
        };
        $("#calendar").fullCalendar("renderEvent", eventData, true); // stick? = true
      }
      $("#calendar").fullCalendar("unselect");
    },

    eventRender: function(event, element) {
      element
        .find(".fc-content")
        .prepend("<span class='closeBtn material-icons'>&#xe5cd;</span>");
      element.find(".closeBtn").on("click", function() {
        $("#calendar").fullCalendar("removeEvents", event._id);
      });  
    },

    eventClick: function(calEvent) {
      var title = prompt("Edit Event Content:", calEvent.title);
      calEvent.title = title;
      $("#calendar").fullCalendar("updateEvent", calEvent);
      
    },    
  });
});
*/





  


</script>












        <div class="container">

            <div class="panel panel-primary">
            <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Calendar') }}
        </h2>
    </x-slot>

              

            </div>

            <div class="panel panel-primary">
              <div class="panel-heading">MY Event Details</div>
              <div class="panel-body" >
              <div class="response alert alert-success mt-2" style="display: none;"></div>
                  <div id='calendar'></div>
              </div>
            </div>

            </div>
</x-app-layout>
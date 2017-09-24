$(document).ready(function(){
  moment.locale('es');
  var id_calendar = $('#createEventModal #fk_calendar').val();
  var calendar = $('#calendar').fullCalendar({  // assign calendar
    header:{
      left: 'prev,next today',
      center: 'title',
      right: 'agendaWeek,agendaDay'
    },
    defaultView: 'month',
    eventLimit: false,
    selectable: true,
    displayEventTime : false,
    allDaySlot: false,
    events: "/admin/api/calendar/data_calendar.php?view=1&calendar="+id_calendar,  // request to load current events
    editable: false,
    eventClick:  function(event) {
      var decision = confirm("Desea Eliminar el evento?");
      if (decision) {
        $.ajax({
          type: "POST",
          url: "/admin/api/calendar/delete.php",
          data: "&id=" + event.id_event,
          success: function(res) {
            $("#calendar").fullCalendar("refetchEvents");
          },
          error: function(res) {
            console.log(res);
            alert("Algo ha ido mal")
          }
        });
      }
    },
    select: function(start, end, jsEvent) {  // click on empty time slot
      if((moment(start).format("E") != 7) && (moment(start).format("E") != 6)){
        text_aula = $('#selected_aula').attr("data-name");
        if(text_aula){
          endf = start.toISOString()+" 18:00:00";
          end = moment(start.toISOString()+"T17:00:00-18:00").format('h:mm');
          startf = start.toISOString()+" 17:00:00";
          start_2 = start;
          moment.locale('es');
          start_2.locale(false);
          start = moment(start).format('dddd, MMMM Do YYYY, h:mm');
          startM = moment(start_2).format('dddd, MMMM Do YYYY');
          var fecha = startM +" 17:00 - 18:00";
          start = moment(start).format();
          end = moment(end).format();
          fk_aula = $('#selected_aula').attr("data-id");
          id_edicion = $('#selected_aula').attr("data-ediciones");
          text_edicion = $("#selected_edicion a").text();

          $('#createEventModal #edicion').html(text_edicion);
          $('#createEventModal #title').html(text_aula);
          $('#createEventModal #fk_aula').val(fk_aula);
          $('#createEventModal #start').val(start);
          $('#createEventModal #start').attr("data-start",startf);
          $('#createEventModal #end').val(end);
          $('#createEventModal #end').attr("data-end",endf);
          $('#createEventModal #when').text(fecha);
          $('#createEventModal').modal('toggle');
        }else{
          alert("debe seleccionar un aula");
        }
      }
    },
    eventDrop: function(event, delta){ // event drag and drop
      //  $.ajax({
      //      url: 'index.php',
      //      data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
      //      type: "POST",
      //      success: function(json) {
      //      //alert(json);
      //      }
      //  });
    },
    eventResize: function(event) {  // resize to increase or decrease time of event
      //  $.ajax({
      //      url: 'index.php',
      //      data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
      //      type: "POST",
      //      success: function(json) {
      //          //alert(json);
      //      }
      //  });
    }
  });

  // $('#submitButton').on('click', function(e){ // add event submit
  //   // We don't want this to act as a link so cancel the link action
  //   e.preventDefault();
  //   doSubmit(); // send to form submit function
  // });
  // $('#deleteButton').on('click', function(e){ // delete event clicked
  //   // We don't want this to act as a link so cancel the link action
  //   e.preventDefault();
  //   doDelete(); send data to delete function
  // });

  // function doDelete(){  // delete event
  //   $("#calendarModal").modal('hide');
  //   var eventID = $('#eventID').val();
  //   $.ajax({
  //     url: 'index.php',
  //     data: 'action=delete&id='+eventID,
  //     type: "POST",
  //     success: function(json) {
  //       if(json == 1)
  //       $("#calendar").fullCalendar('removeEvents',eventID);
  //       else
  //       return false;
  //     }
  //   });
  // }
  // function doSubmit(){ // add event
  //   $("#createEventModal").modal('hide');
  //   var title = $('#title').val();
  //   var startTime = $('#startTime').val();
  //   var endTime = $('#endTime').val();
  //   $.ajax({
  //     url: 'index.php',
  //     data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime,
  //     type: "POST",
  //     success: function(json) {
  //       $("#calendar").fullCalendar('renderEvent',
  //       {
  //         id: json.id,
  //         title: title,
  //         start: startTime,
  //         end: endTime,
  //       },true);
  //     }
  //   });
  // }

  /***********************************----********************************/
  $(".ediciones li").click(function(){
    var parts = $(this).attr("class").split("_");
    var id = parts[parts.length-1];
    $(".aulas li").hide();
    $(".aulas_"+id).show();
  });

  $(".anio li").click(function(){
    var parts = $(this).attr("class").split("_");
    var id = parts[parts.length-1];
    $(".ediciones li").hide();
    $(".anio_"+id).show();
  });
  $("#ctm-aulas-vcs li").click(function(){
    $("#ctm-aulas-vcs li").each(function(){
      $(this).removeAttr("id");
    });
    $(this).attr("id", "selected_aula");
  });
  $('#submitButton').on('click', function(e){
    e.preventDefault();
    doSubmit();
  });
  function doSubmit(){ // add event
    $("#createEventModal").modal('hide');
    var fk_aula = $('#fk_aula').val();
    var fk_calendar = $('#fk_calendar').val();
    var startTime = $('#start').attr("data-start");
    var endTime = $('#end').attr("data-end");
    $.ajax({
      url: '/admin/api/calendar/add.php',
      data: 'action=add&fk_aula='+fk_aula+'&start='+startTime+'&end='+endTime+'&fk_calendar='+fk_calendar,
      type: "POST",
      success: function(res) {
        $("#calendar").fullCalendar("refetchEvents");
        console.log(res);
      },
      error: function(res){
        console.log(res);
      }
    });
  }
});

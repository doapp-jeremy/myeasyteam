$(function() {
  
  var format = "%Y-%m-%d %h:%i%p";
  var defaultConv = new AnyTime.Converter({ format: format });
  //$('input[name="date"]').daterangepicker();  
  
  AnyTime.picker( "EventStart", { format: format, firstDOW: 1, 'earliest':  new Date()} );
  AnyTime.picker( "EventEnd", { format: format, firstDOW: 1, 'earliest': new Date() } );
  
  console.log('start');
  var start = $('#EventStart').val();
  console.log(start);
  if (!start)
  {
    // default to 6pm today
    var today = new Date();
    today.setHours(18);
    today.setMinutes(0);
    $('#EventStart').val(defaultConv.format(today));
  }
  
  // attach to change event for start to update end
  // TODO: attach to close of dialog
  $('#EventStart').bind('change', function(){
    var start = defaultConv.parse($('#EventStart').val());
    var end = start;
    end.setHours(start.getHours() + 1);
    $('#EventEnd').val(defaultConv.format(end));
  });
});

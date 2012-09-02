$(function() {
  
  var format = "%Y-%m-%d %h:%i%p";
  //$('input[name="date"]').daterangepicker();  
  
  AnyTime.picker( "start", { format: format, firstDOW: 1, 'earliest':  new Date()} );
  AnyTime.picker( "end", { format: format, firstDOW: 1, 'earliest': new Date() } );
  
  // attach to change event for start to update end
  // TODO: attach to close of dialog
  $('#start').bind('change', function(){
    var defaultConv = new AnyTime.Converter({ format: format });
    var start = defaultConv.parse($('#start').val());
    var end = $('#end').val();
    //if (!end)
    {
      var end = start;
      end.setHours(start.getHours() + 1);
      $('#end').val(defaultConv.format(end));
    }
    
    
  });
});

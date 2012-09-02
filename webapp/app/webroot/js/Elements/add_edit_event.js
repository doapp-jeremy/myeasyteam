$(function() {
  
  //$('input[name="date"]').daterangepicker();  
  
  AnyTime.picker( "start", { format: "%Y-%m-%d %h:%i%p", firstDOW: 1, 'earliest':  new Date()} );
  AnyTime.picker( "end", { format: "%Y-%m-%d %h:%i%p", firstDOW: 1, 'earliest': new Date() } );
});

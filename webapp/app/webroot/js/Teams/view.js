$(function() {
  
  var theModal = $('#theModal');
  
  $(".editEvent").delegate(".getIsReadyInfoModal", 'click', function (e) {
    e.preventDefault();
    
    theModal.css('max-height',600);
    alert($(this).val());
    
    theModal.modal('show');
    
  });
  
});

$(document).ready( function() {

      $('.aggiorna').on('click', function() {
            alert('ddddd');
      });

});

/*
$('.aggiorna').submit(function(event) {

      event.preventDefault();
      var $formImput = $(this);
      $.ajax({
        url: anObject.ajaxurl,
        data: {
          formImput: $formImput,
          action: 'imposta_evidenza'
        },
        type: 'post',
        dataType: 'text'
        success: function(data) {
          console.log('SUCCESS!');
        },
        error: function(data) {
          console.log('FAILURE');
        }
      });
});
*/

$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#message').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#message').fadeIn('slow');
    });
    $('#form, #fat, #login').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
		if(data == '1'){
			top.location.href='index.php?page=services';
		}
		else
		{
			$('#message').html(data);
		}
            }
        })
        
        return false;
    }); 
}) 

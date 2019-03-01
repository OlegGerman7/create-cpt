jQuery(document).ready(function($) {

    $( "#queries-submit" ).click(function() {
        title = jQuery('#title').val();
        author = jQuery('#author').val();
        description = jQuery('#description').val();
        priority = jQuery('#priority').val();

    var data = {
        action: 'my_action',
        title: title,
        author: author,
        description: description,
        priority: priority,
    };

    jQuery.post( object_name.url, data, function(response) {
        alert( 'Added custom post' );
    });
});

});
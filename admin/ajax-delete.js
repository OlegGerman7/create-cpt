jQuery(document).ready(function($) {

    $( ".queries-delete-button" ).click(function() {
        var id = $(this).attr('id');
        var postDelete = $(this).closest('.queries-post');
        var data = {
            action: 'my_action_delete',
            id: id,
        };
        jQuery.post( object_name.url, data, function(response) {
            alert( 'Post deleted' );
            postDelete.remove();
        });
    });
});
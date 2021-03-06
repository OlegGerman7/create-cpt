<?php add_action( 'wp_enqueue_scripts', 'myajax_data1', 100 );
function myajax_data1(){
    wp_enqueue_script('ajax-custom', plugins_url() . '/add-option-page/admin/ajax-custom.js' , array('jquery'), '', 'true' );
    wp_enqueue_script('ajax-delete', plugins_url() . '/add-option-page/admin/ajax-delete.js' , array('jquery'), '', 'true' );
    wp_localize_script( 'ajax-custom', 'object_name', array(
		'url' => admin_url('admin-ajax.php'),
	) );
}

add_action( 'wp_ajax_my_action', 'my_action_callback1' );
function my_action_callback1() {
    $post_data = array(
        'post_title'    => $_POST['title'],
        'post_status'   => 'publish',
        'post_type'     => 'custom',
        'meta_input'    => array(
        'support_message_author'       => $_POST['author'],
        'support_message_description'  => $_POST['description'],
        'support_message_priority'     => $_POST['priority'],
        ),
    );
    wp_insert_post( wp_slash($post_data) );
    wp_die();
}

add_action( 'wp_ajax_my_action_delete', 'my_action_callback_delete1' );
function my_action_callback_delete1() {
    $id_post = $_POST['id'];
    wp_delete_post( $id_post, 'false');
    wp_die();
}

get_header(); ?>
<div class="wrap">
    <?php
    $args = array(
        'post_type' => 'custom',
        'post_status' => 'publish',
        'orderby'   => 'meta_value_num',
        'meta_key'  => 'support_message_priority',
        'order'   => 'DESC',
        'posts_per_page' => -1,
    );
    ?>
    <div class="queries-container">
        <h1 class="queries-title">Queries message</h1>
        <div class="message-block">
        </div>
        <table class="queries-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = new WP_Query($args);
            while ( $query->have_posts() ) {
                $query->the_post(); ?>
                <tr class="queries-post" post-id="<?php the_ID() ?>">
                    <td><?php the_title(); ?></td>
                    <?php $id_post = get_the_ID(); ?>
                    <td><?php echo get_post_meta( $id_post, 'support_message_author', true); ?></td>
                    <td><?php echo get_post_meta( "$id_post", 'support_message_description', true); ?></td>
                    <td><?php echo get_post_meta( "$id_post", 'support_message_priority', true); ?></td>
                    <td><button class="queries-delete-button btn btn-danger" id="<?php the_ID(); ?>">Delete</button></td>
                </tr>
                <?php
            }
            wp_reset_postdata(); ?>
            </tbody>
        </table>
    </div>

 <?php $showQueries = get_option( 'option_name',  "1");
    if(!isset($showQueries['checkbox'])){
    echo  "<div><h2>You can not leave a queries today</h2></div>";
    } else { ?>
    <h2 class="queries-form-title">Add new queries message</h2>
    <form action = "" method="post" class="queries-form">
        <div class="row">
            <label for="queries-title">Title</label>
            <input id="title" type="text" name="queries-title" >
        </div>
        <div class="row">
            <label for="queries-author">Author</label>
            <input id="author" type="text" name="queries-author">
        </div>
        <div class="row">
            <label for="queries-text">Message</label>
            <textarea id="description" name="queries-text"></textarea>
        </div>
        <div class="row row-flex">
            <select id="priority" name="queries-priority" id="queries-priority">
                <option value="0">Low</option>
                <option value="1">High</option>
                <option value="2">Urgent</option>
            </select>
            <button type="submit" class="btn btn-primary" id="queries-submit">Add Queries</button>
        </div>
    </form>
<?php }
get_footer(); ?>
<!--
========================
How to use wp_query
========================
-->


<?php

    $args = array( //questo è un array che passa i parametri da controllare
            'type' => 'post',
            'post_per_page' =>3,
    );


$lastBlog = new WP_Query($args); //inizializzo una variabile passando la creazione dell oggetto new WP_Query 

if($lastBlog->have_posts())://se la $var ha dei posto
    while($lastBlog->have_posts()): $lastBlog->the_post(); // carica i post?>

<!--Stapa qui il tuo contenuto-->

<?php endwhile;
    endif;
    wp_reset_postdata( );
    ?>



<!--
=============================
How to use custom_post_type
=============================
-->

<?php
/*
Questo codice va inserito nel functions.php
*/

function nome_custom_post_type(){

    $labels = array(
        'name' => 'nome del cpt',//non del custom post type viene visualizzato tip pagine/articoli
        'singular_name' => 'nome al singolare,'//tenere uguale al plurale è più comodo
        'add_new'=>'Add Portfolio Item',//label for the button
        'all_items' => 'All Items',
		'add_new_item' => 'Add Item',
		'edit_item' => 'Edit Item',
		'new_item' => 'New Item',
		'view_item' => 'View Item',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
    );
    $args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('portfolio',$args);






}
add_action('init','nome_custom_post_type' )


?>
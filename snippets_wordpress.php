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
        'all_items' => 'All Items',//amministrazion pannel label 
		'add_new_item' => 'Add Item', //button label
		'edit_item' => 'Edit Item',//modifca elmento
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
		'capability_type' => 'post', //impostazione prendiamo tra quelle predefinite come post o page
		'hierarchical' => false,
		'supports' => array(//cosa vogliamo nei vari elementi che creiamo
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
/**
 * Per aggiungere la pagina singola per 'portfolio' e la pagina archive basta duplicare i due file e aggiungere -portfolio
 * Wordpress li riconoscera in automatico
 */


?>

<!--
================================================
Custom menu [In header o dove si vuole il menu]
================================================
-->

<?php
/**
 * Dopo aver registrato il menu con apposita funzione in function.php
 */
$locationDetails=get_nav_menu_locations(); //salva nella variabile tutti i menu registrati, attraverso la stampa posso vedere i nomi
$menuID = $locationDetails['nome menu'];//salvo nella variabile il menu scelto
$nomemenuMenuItems=wp_get_nav_menu_items( $menuID);//passado l'id del menu interessato recupero gli elementi

//prima dell'HTML di ogni elemento menu ciclo gli elementi
foreach($nomemenuMenuItems as $nomemenuMenuItem){
    /**
     * codice html con i vari riferimenti per gli elementi
     */
}

?>


<!--
==================================
Regitrare menu [in function.php]
==================================
-->
<?php
function nome_funzione_menu_theme_setup() {
	
	add_theme_support('menus');//aggiunta supporto per il menu a wordpress vedi https://developer.wordpress.org/reference/functions/add_theme_support/
	
	register_nav_menu('nome', 'dove'); //per registrare ogni menu
}

add_action('init', 'nome_funzione_menu_theme_setup');

?>


<!--
==================================
Custom Taxonomy
==================================
Rappresentano le categorie e i tag
Hierarchical taxonomy -> category with parent and child
No hierarchical -> tags haven't a parent or child
-->

<?php

function nome_custom_taxonomies() {

	//add new taxonomy hierarchical
	//se utilizzi type interferisce con il codice standard di wordpress

	$labels = array(
		'name' => 'Fields',
		'singular_name' => 'Field',
		'search_items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field:',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Work Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'field' )
	);
	
	register_taxonomy('field', array('portfolio'), $args);
	
	//add new taxonomy NOT hierarchical

	register_taxonomy('software', 'portfolio', array(
		'label' => 'nome_etichetta',
		'rewrite' => array('slug' =>'nome_slug' ),
		'hierarchical'=>false

	));


}
add_action( 'init' , 'nome_custom_taxonomies' );

//Per stampare il custom --> wp_get_post_terms();

?>



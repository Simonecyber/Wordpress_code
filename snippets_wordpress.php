
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
        'singular_name' => 'nome al singolare'//tenere uguale al plurale è più comodo
        ''
    );
    $args






}


?>


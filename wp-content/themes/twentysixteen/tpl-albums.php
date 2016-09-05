<?php
/*
Template Name: Liste des albums
*/
/**
On inclu notre header personnalisé "header-perso.php"
*/
get_header('perso'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
/**
La requête
*/
		$args = array(
			'post_type' => 'album',
			'tax_query' => array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => array('electro','grosse-daube', 'raggae', 'chanson-humoristique')
				),
			),
		);
		$the_query = new WP_Query( $args );
/**
Début de la boucle
*/
		while ($the_query->have_posts()) : $the_query->the_post();
/**
BLoc éxécuté pour chaque album
*/			$categories = wp_get_post_terms( $post->ID, 'genre', $args );
			$categorie = $categories[0]->name;
			echo "<h2>";
			the_title();
			echo "</h2>";
			echo '<p>Année de sortie: '.get_post_meta($post->ID,'_annee_sortie',true).' - '.$categorie.'</p>';
			the_content();
			the_post_thumbnail();
/**
Fin de la boucle
*/
		endwhile;
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php
/**
On inclu "ma sidebar personnalisée" dans le fichier "sidebar-perso.php"
*/
get_sidebar('perso');
/**
On inclu le footer
*/
get_footer('perso'); ?>

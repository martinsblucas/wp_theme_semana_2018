<?php /* Template Name: Galeria */ ?>
<?php get_header(); ?>
<main class="container">
	<section class="row">
    	<header>
    	<h1 class="titulo"><?php the_title(); ?></h1>
        <?php
		$posts = get_posts(
		array(
			"post_type" => "post",
			"orderby" => "date",
			"order" => "DESC",
			"posts_per_page" => -1,
			"category__in" => 44 
			)
		); 
		$count = count($posts);
		$big = 999999999; // need an unlikely integer
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$loop_noticias = new WP_Query(
			array(
			"post_type" => "post",
			"orderby" => "date",
			"order" => "DESC",
			"posts_per_page" => 8,
			"category__in" => 44,
			"paged" => $paged
			)
		);
		// The Loop
		if ( $loop_noticias->have_posts() ) {
		?>
        <?php if ($count > 5) { ?>
        <div class="pagination">
         <?php echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $loop_noticias->max_num_pages
			) );
			?>
        </div>
        <?php } else { } ?>
        </header>
		<?php 
        while ( $loop_noticias->have_posts() ) {
		$loop_noticias->the_post();
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'foto_noticia');
		$src = $thumb['0']; 
		?>
		<article class="col-sm-12 col-md-6 col-lg-4">
        <a href="<?php the_permalink(); ?>">
        	<figure class="overlay"><img src="<?php echo $src; ?>" /><div class="transparencia"></div></figure>
        	<h1><?php the_title(); ?></h1>
        </a>
        </article>
       	<?php
        }
		} else {
		// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		?>
        <?php if ($count > 5) { ?>
        <footer>
        <div class="pagination">
         <?php echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $loop_noticias->max_num_pages
			) );
			?>
        </div>
        </footer>
        <?php } else { } ?>
    </section>
</main>
 <?php get_footer(); ?>
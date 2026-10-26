<?php get_header(); ?>

<main id="content">
	<h1>Category Archive: <?php echo single_cat_title( '', false ); ?></h1>

<?php if ( have_posts() ): ?>

	<ol>
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<h2 class="heading-3"><a href="<?php echo esc_url( get_permalink() ); ?>" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</li>
	<?php endwhile; ?>
	</ol>

<?php else: ?>

	<p>No posts to display</p>

<?php endif; ?>
</main>

<?php get_footer(); ?>

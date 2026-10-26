<?php get_header(); ?>

<main id="content">
	<h1>Latest Posts</h1>

	<ol>
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<h2 class="heading-3"><a href="<?php echo esc_url( get_permalink() ); ?>" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</li>
	<?php endwhile; ?>
	</ol>
</main>

<?php get_footer(); ?>

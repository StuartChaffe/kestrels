<?php get_header(); ?>

<main id="content">
<?php if ( have_posts() ): ?>

	<h1>Search Results for '<?php echo get_search_query(); ?>'</h1>

	<ol class="search-results">
	<?php while ( have_posts() ) : the_post(); ?>
		<li>
			<h2 class="heading-3"><a href="<?php echo esc_url( get_permalink() ); ?>" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</li>
	<?php endwhile; ?>
	</ol><!-- /search-results -->

<?php else: ?>

	<h1>No results found for '<?php echo get_search_query(); ?>'</h1>

<?php endif; ?>
</main>

<?php get_footer(); ?>

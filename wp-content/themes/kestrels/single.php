<?php get_header(); ?>

<main id="content" class="main--blocks">
<?php while ( have_posts() ) : the_post(); ?>

	<article>
		<h1><?php the_title(); ?></h1>
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() . ' ' . get_the_time() ); ?></time>
		<?php the_content(); ?>
	</article>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>

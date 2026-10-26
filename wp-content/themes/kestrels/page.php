<?php get_header(); ?>

<main id="content" class="main--blocks">
<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>

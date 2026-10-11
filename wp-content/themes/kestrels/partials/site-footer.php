<?php
?>
<footer class="site-footer">
	<div class="site-footer__inner">
		<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>

		<?php get_template_part('partials/social-links', null, ['modifier_classes' => 'social-links--footer']); ?>

		<p> Website by <a href="https://stuartchaffe.co.uk">Stu</a></p>

	</div>
</footer>

<?php
?>
<footer class="site-footer">
	<div class="site-footer__inner container">
		<p><?php bloginfo('name'); ?></p>

		<?php get_template_part('partials/social-links', null, ['modifier_classes' => 'social-links--footer']); ?>

		<p> Website by <a href="https://stuartchaffe.co.uk">Stu</a></p>

	</div>
</footer>

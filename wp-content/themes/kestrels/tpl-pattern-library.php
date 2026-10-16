<?php
// Template Name: Pattern Library
?>

<?php get_header(); ?>

<style>
	.pattern-section {
		margin: 3rem 0;
	}
	.pattern-section h2.label {
		font-size: var(--text-size-l);
		border-bottom: 1px solid var(--color-secondary);
		padding-bottom: 0.5rem;
		margin: 8rem 0 1.5rem;
	}
	.pattern-section h3.label {
		font-size: var(--text-size-xs);
		text-transform: uppercase;
		letter-spacing: 0.05em;
		color: var(--color-text-base);
		margin: 2rem 0 1rem;
		font-family: var(--font-base);
		font-weight: var(--font-weight-heavy);
	}
	.pattern-section__logos {
		display: flex;
		gap: var(--gutter-s);
	}
	.pattern-section__logo {
		width: 200px;
		border-radius: var(--radius-s);
		margin-bottom: 8px;
		padding: 1rem;
		border: 1px solid var(--color-text-base);
	}
	.color-swatches {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
		gap: var(--gutter-s);
	}
	.color-swatch {
		--swatch-background: #ccc;
	}
	.color-swatch__sample {
		display: block;
		background-color: var(--swatch-background);
		min-height: 80px;
		border-radius: var(--radius-s);
		margin-bottom: 8px;
		border: 1px solid var(--color-tertiary);
	}
	.color-swatch__label {
		font-size: 11px;
		font-family: var(--font-mono);
		color: var(--color-grey-dark);
		letter-spacing: -0.02em;
		line-height: 1.4;
	}
	.color-swatch__label span {
		display: block;
		font-size: 13px;
		color: var(--color-text-dark);
		font-weight: var(--font-weight-semi);
	}
	.color-swatch--primary        { --swatch-background: var(--color-primary); }
	.color-swatch--secondary      { --swatch-background: var(--color-secondary); }
	.color-swatch--tertiary       { --swatch-background: var(--color-tertiary); }
	.color-swatch--quaternary     { --swatch-background: var(--color-quaternary); }
	.color-swatch--grey      	  { --swatch-background: var(--color-grey); }
	.color-swatch--cream          { --swatch-background: var(--color-cream); }
	.color-swatch--cream-light    { --swatch-background: var(--color-cream-light); }
	.color-swatch--cream-dark     { --swatch-background: var(--color-cream-dark); }
	.color-swatch--text-base      { --swatch-background: var(--color-text-base); }
	.color-swatch--text-dark      { --swatch-background: var(--color-text-dark); }
	.color-swatch--text-reversed  { --swatch-background: var(--color-text-reversed); }
	.color-swatch--text-link      { --swatch-background: var(--color-text-link); }
	.color-swatch--text-hover     { --swatch-background: var(--color-text-hover); }
</style>

<main class="main content" id="content">
	<div class="container--s">

		<h1 class="u-center"><i>Pattern</i> <br />Library</h1>

		<div class="pattern-section">
			<h2 class="label">Logos</h2>
			<h3 class="label">SVG</h3>
			<div class="pattern-section__logos"><div class="pattern-section__logo has-primary-background-color"><a href="<?php echo content_url(); ?>/uploads/logo.svg" download><img src="<?php echo content_url(); ?>/uploads/logo.svg" alt=""></a></div> <div class="pattern-section__logo has-secondary-background-color"><a href="<?php echo content_url(); ?>/uploads/logo-alt.svg" download><img src="<?php echo content_url(); ?>/uploads/logo-alt.svg" alt=""></a></div></div>

			<h3 class="label">PNG</h3>
			<div class="pattern-section__logos"><div class="pattern-section__logo has-primary-background-color"><a href="<?php echo content_url(); ?>/uploads/logo.png" download><img src="<?php echo content_url(); ?>/uploads/logo.png" alt=""></a></div> <div class="pattern-section__logo has-secondary-background-color"><a href="<?php echo content_url(); ?>/uploads/logo-alt.png" download><img src="<?php echo content_url(); ?>/uploads/logo-alt.png" alt=""></a></div> </div>
		</div>

		<!-- Colours -->
		<div class="pattern-section">
			<h2 class="label">Colours</h2>

			<h3 class="label">Brand</h3>
			<div class="color-swatches">
				<div class="color-swatch color-swatch--primary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Yellow</span>--color-primary<br>#FFE900</span>
				</div>
				<div class="color-swatch color-swatch--secondary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Black</span>--color-secondary<br>#1C1C1C</span>
				</div>
				<div class="color-swatch color-swatch--tertiary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>White</span>--color-tertiary<br>#000000</span>
				</div>
			</div>
		</div>

		<!-- Typography -->
		<div class="pattern-section">
			<h2 class="label">Typography <a href="https://fonts.google.com/specimen/DM+Sans?preview.script=Latn">DM Sans ⤴</a> <a href="https://fonts.google.com/specimen/Instrument+Serif?preview.layout=grid&preview.script=Latn&query=dm+sans">Instrument Serif ⤴</a></h2>

			<h3 class="label">Headings</h3>
			<h1><i>Welcome</i><br/>
			Kestrels</h1>
			<h1 class="heading-alt">Alt Heading</h1>
			<h2>Heading 2 &mdash; The quick brown fox</h2>
			<h3>Heading 3 &mdash; The quick brown fox</h3>
			<h4>Heading 4 &mdash; The quick brown fox</h4>
			<h5>Heading 5 &mdash; The quick brown fox</h5>

			<h3 class="label">Body</h3>
			<p class="has-medium-font-size"><strong>Lead paragraph</strong>. Vivamus magna. <i>Cras in mi at felis</i> aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend libero at lobortis mollis.</p>
			<p><strong>Body copy</strong>. Vivamus magna. <i>Cras in mi at felis</i> aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend libero at lobortis mollis. Quisque ultrices, lacus ut interdum varius, nisi nulla <a href="#">link example</a> sollicitudin tortor, ac semper tellus sapien at est.</p>
			<p class="small"><strong>Second paragraph</strong>. Aliquam erat volutpat. <i>In dui magna</i>, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque ipsum. Nulla ut erat id mauris vulputate elementum.</p>

			<h3 class="label">Blockquote</h3>
			<blockquote>
				<p>The object of this Institution be the establishment of a fund for the relief of necessitous Commercial Travellers, being members, who are aged or permanently incapacitated from earning a subsistence, and for their Widows.</p>
				<cite>CTBI annual report, 1851.</cite>
			</blockquote>

			<h3 class="label">Lists</h3>
			<ul>
				<li>Unordered list item one</li>
				<li>Unordered list item two</li>
				<li>Unordered list item three</li>
			</ul>
			<ol>
				<li>Ordered list item one</li>
				<li>Ordered list item two</li>
				<li>Ordered list item three</li>
			</ol>
			<ul class="custom">
				<li>Unordered list item one</li>
				<li>Unordered list item two</li>
				<li>Unordered list item three</li>
			</ul>
		</div>

		<!-- Figures & Media -->
		<div class="pattern-section">
			<h2 class="label">Figures &amp; Media</h2>

			<h3 class="label">Figure with caption</h3>
			<figure>
				<img src="https://placehold.co/1200x600" alt="Placeholder image" width="1200" height="100%">
				<figcaption><p>Figure caption — a short description of the image above.</p></figcaption>
			</figure>

			<h3 class="label">Video embed</h3>
			<div style="aspect-ratio: 16/9;">
				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video embed example" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

		<!-- Buttons -->
		<div class="pattern-section">
			<h2 class="label">Buttons</h2>
			<div class="btn-group">
				<a href="#" class="btn">Default</a>
				<a href="#" class="btn btn--secondary">Secondary</a>
				<button class="btn" type="button">Button element</button>
				<input class="btn" type="button" value="Input button">
				<a href="#" class="btn btn--link">Link</a>
			</div>
		</div>

	</div>
</main>

<?php the_content(); ?>

<?php get_footer(); ?>

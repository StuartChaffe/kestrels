<?php
// Template Name: Pattern Library
?>

<?php get_header(); ?>

<style>
	.pattern-section {
		margin: 3rem 0;
	}
	.pattern-section h2 {
		font-size: var(--text-size-l);
		border-bottom: 1px solid var(--color-grey);
		padding-bottom: 0.5rem;
		margin: 3rem 0 1.5rem;
	}
	.pattern-section h3 {
		font-size: var(--text-size-s);
		text-transform: uppercase;
		letter-spacing: 0.05em;
		color: var(--color-grey-dark);
		margin: 2rem 0 1rem;
	}
	.color-swatches {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
		gap: 1rem;
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
		border: 1px solid rgba(0,0,0,0.06);
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
	.color-swatch--grey-dark      { --swatch-background: var(--color-grey-dark); }
	.color-swatch--grey           { --swatch-background: var(--color-grey); }
	.color-swatch--grey-light     { --swatch-background: var(--color-grey-light); }
	.color-swatch--text-base      { --swatch-background: var(--color-text-base); }
	.color-swatch--text-dark      { --swatch-background: var(--color-text-dark); }
	.color-swatch--text-reversed  { --swatch-background: var(--color-text-reversed); }
	.color-swatch--text-link      { --swatch-background: var(--color-text-link); }
	.color-swatch--text-hover     { --swatch-background: var(--color-text-hover); }
</style>

<main class="main content" id="content">
	<div class="container">

		<h1>Pattern Library</h1>

		<!-- Colours -->
		<div class="pattern-section">
			<h2>Colours</h2>

			<h3>Brand</h3>
			<div class="color-swatches">
				<div class="color-swatch color-swatch--primary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Primary</span>--color-primary<br>#59BACC</span>
				</div>
				<div class="color-swatch color-swatch--secondary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Secondary</span>--color-secondary<br>#58AD69</span>
				</div>
				<div class="color-swatch color-swatch--tertiary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Tertiary</span>--color-tertiary<br>#FFBC49</span>
				</div>
				<div class="color-swatch color-swatch--quaternary">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Quaternary</span>--color-quaternary<br>#E2574C</span>
				</div>
			</div>

			<h3>Greys</h3>
			<div class="color-swatches">
				<div class="color-swatch color-swatch--grey-dark">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Grey Dark</span>--color-grey-dark<br>#6a6a6a</span>
				</div>
				<div class="color-swatch color-swatch--grey">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Grey</span>--color-grey<br>#ddd</span>
				</div>
				<div class="color-swatch color-swatch--grey-light">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Grey Light</span>--color-grey-light<br>#efefef</span>
				</div>
			</div>

			<h3>Text</h3>
			<div class="color-swatches">
				<div class="color-swatch color-swatch--text-base">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Text Base</span>--color-text-base<br>#333</span>
				</div>
				<div class="color-swatch color-swatch--text-dark">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Text Dark</span>--color-text-dark<br>#181822</span>
				</div>
				<div class="color-swatch color-swatch--text-reversed">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Text Reversed</span>--color-text-reversed<br>#fff</span>
				</div>
				<div class="color-swatch color-swatch--text-link">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Text Link</span>--color-text-link<br>#0087D0</span>
				</div>
				<div class="color-swatch color-swatch--text-hover">
					<span class="color-swatch__sample"></span>
					<span class="color-swatch__label"><span>Text Hover</span>--color-text-hover<br>#003451</span>
				</div>
			</div>
		</div>

		<!-- Typography -->
		<div class="pattern-section">
			<h2>Typography</h2>

			<h3>Headings</h3>
			<h1>Heading 1 &mdash; The quick brown fox</h1>
			<h2>Heading 2 &mdash; The quick brown fox</h2>
			<h3>Heading 3 &mdash; The quick brown fox</h3>
			<h4>Heading 4 &mdash; The quick brown fox</h4>
			<h5>Heading 5 &mdash; The quick brown fox</h5>

			<h3>Body copy</h3>
			<p class="lead">Lead paragraph. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend libero at lobortis mollis.</p>
			<p>Body copy. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend libero at lobortis mollis. Quisque ultrices, lacus ut interdum varius, nisi nulla <a href="#">link example</a> sollicitudin tortor, ac semper tellus sapien at est.</p>
			<p>Second paragraph. Aliquam erat volutpat. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque ipsum. Nulla ut erat id mauris vulputate elementum.</p>

			<h3>Blockquote</h3>
			<blockquote>
				<p>The quick brown fox jumps over the lazy dog. Pack my box with five dozen liquor jugs.</p>
			</blockquote>

			<h3>Lists</h3>
			<ul style="list-style: disc; padding-left: 1rem;">
				<li>Unordered list item one</li>
				<li>Unordered list item two</li>
				<li>Unordered list item three</li>
			</ul>
			<ol style="list-style: decimal; padding-left: 1rem;">
				<li>Ordered list item one</li>
				<li>Ordered list item two</li>
				<li>Ordered list item three</li>
			</ol>
		</div>

		<!-- Figures & Media -->
		<div class="pattern-section">
			<h2>Figures &amp; Media</h2>

			<h3>Figure with caption</h3>
			<figure>
				<img src="https://placehold.co/1200x600" alt="Placeholder image" width="1200" height="600">
				<figcaption><p>Figure caption — a short description of the image above.</p></figcaption>
			</figure>

			<h3>Video embed</h3>
			<div style="aspect-ratio: 16/9;">
				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Video embed example" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

		<!-- Buttons -->
		<div class="pattern-section">
			<h2>Buttons</h2>
			<div class="btn-group">
				<a href="#" class="btn">Default</a>
				<a href="#" class="btn btn--secondary">Secondary</a>
				<a href="#" class="btn btn--outline">Outline</a>
				<a href="#" class="btn btn--link">Link</a>
				<button class="btn" type="button">Button element</button>
				<input class="btn" type="button" value="Input button">
			</div>
		</div>

	</div>
</main>

<?php get_footer(); ?>

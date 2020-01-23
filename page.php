<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article class="single">
			<div class="left">
				<?php
					$galeria = get_field('galeria');
					$categ = get_the_terms(get_the_ID(), 'tipos_agenda');

					$inicio = get_field('fecha_inicio');
					$todo_el_dia = get_field('todo_el_dia');
					$cierre = get_field('fecha_cierre');

					if($galeria): foreach($galeria as $img):
				?>
					<div class="img">
						<div class="size"></div>
						<img src="<?php echo $img['url'] ?>" alt="">
					</div>
				<?php endforeach; endif; ?>
			</div>
			<div class="right">
				<h1><?php the_title() ?></h1>

				<div class="content">
					<?php the_content() ?>
				</div>
			</div>
		</article>

	<?php endwhile; endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

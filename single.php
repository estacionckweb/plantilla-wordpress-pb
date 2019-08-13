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
				<div class="info">
					<div class="categ_name <?php echo $categ[0]->slug ?>">
						<?php echo $categ[0]->name ?>
					</div>

					<div class="fecha">
						<?php if($todo_el_dia == 1): ?>
							<?php echo $inicio ?>
						<?php else: ?>
							<?php echo $inicio ?> a <?php echo $cierre ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="external_nav top_margin">
					<a href="" class="link">Ir al calendario</a>
					<a href="<?php echo get_post_type_archive_link(get_post_type()) ?>" class="link">Ir al archivo</a>
				</div>

				<div class="content">
					<?php the_content() ?>
				</div>

				<div class="external_nav btm_margin">
					<div class="link related">Relacionados</div>
				</div>
			</div>
		</article>

	<?php endwhile; endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php /* Template Name: Plantilla calendario */ get_header(); ?>

	<main role="main">
		<section>

		<?php //if (have_posts()): while (have_posts()) : the_post(); ?>


		<div class="calendario_container">
			<div id="calendario">
				
				<?php crearMes() ?>
				<?php crearMesSiguiente() ?>

			</div>
			<div class="listado">
					<a class="itemArchive">
						Ver archivo de la agenda
					</a>
				<?php
					global $query_string;
					$args = array(
						'post_type' => 'agenda',
					);
					$posts = query_posts($args);

					if (have_posts()): while (have_posts()) : the_post();

					$inicio = get_field('fecha_inicio');
					$todo_el_dia = get_field('todo_el_dia');
					$cierre = get_field('fecha_cierre');

					$galeria = get_field('galeria');

					if($todo_el_dia == 1) $cierre = '';

					$categ = get_the_terms(get_the_ID(), 'tipos_agenda');
				?>

					

					<div class="item" data-inicio="<?php echo $inicio ?>" data-cierre="<?php echo $cierre ?>">
						<div class="top">
							<div class="categ <?php echo $categ[0]->slug ?>"></div>
							<div class="nombre"><?php the_title() ?></div>
							<div class="fecha">
								<?php if($todo_el_dia == 1): ?>
									<?php echo $inicio ?>
								<?php else: ?>
									<?php echo $inicio ?> a <?php echo $cierre ?>
								<?php endif; ?>
							</div>
						</div>
						<div class="inside">
							<div class="categ_name <?php echo $categ[0]->slug ?>">
								<?php echo $categ[0]->name ?>
							</div>
							<a href="<?php echo get_permalink() ?>" class="link">Saber más</a>

							<div class="content">
								<div class="img">
									<img src="<?php echo $galeria[0]['sizes']['thumbnail'] ?>" alt="">
								</div>
								<div class="txt"><?php echo get_field('breve_descripcion'); ?></div>
							</div>
						</div>
					</div>

				<?php endwhile; endif; ?>
			</div>
		</div>

		

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

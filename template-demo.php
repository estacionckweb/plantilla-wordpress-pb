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
					<a class="itemArchive" href="<?php echo get_post_type_archive_link('agenda') ?>">
						Ver archivo de la agenda
					</a>
				<?php
					global $query_string;
					$args = array(
						'post_type' => 'agenda',
						'tax_query' => array(
							array(
							  'taxonomy' => 'tipos_agenda',
							  'field' => 'term_id', 
							  'terms' => 7, /// Where term_id of Term 1 is "1".
							  'include_children' => false
							)
							)
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
							<?php if($categ): foreach($categ as $item): ?>
							<?php
								$color = get_field('color', $item);
							?>
								<div class="categ <?php echo $item->slug ?>" style="border-color: <?php echo $color ?>"></div>
							<?php endforeach; endif; ?>
							<div class="nombre"><?php the_title() ?></div>
							<!-- <div class="fecha">
								<?php if($todo_el_dia == 1): ?>
									<?php echo $inicio ?>
								<?php else: ?>
									<?php echo $inicio ?> a <?php echo $cierre ?>
								<?php endif; ?>
							</div> -->
						</div>
						<div class="inside">
							<?php if($categ): foreach($categ as $item): ?>
								<?php
									$color = get_field('color', $item);
								?>
								<div style="background-color: <?php echo $color ?>" class="categ_name <?php echo $item->slug ?>">
									<?php echo $item->name ?>
								</div>
							<?php endforeach; endif; ?>
							
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

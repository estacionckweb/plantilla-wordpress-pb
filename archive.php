<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="archive">

		<?php
			$terms = get_terms( 'tipos_agenda', array(
				'hide_empty' => true,
			));
			// print_r($terms);
		?>

			<div class="external_nav btm_margin">
				<div class="link related">Archivo: <?php echo get_archive_post_type() ?></div>
				<a class="link">Ir al calendario</a>
				<?php foreach($terms as $term): print_r($term)?>
					<a href="<?php echo get_blogInfo('url')?>/?rest_route=/wp/v2/agenda?tipos_agenda=<?php echo $term->term_id ?>&per_page=20" class="link categ <?php echo $term->slug; ?>" data-slug="<?php echo $term->slug; ?>">
						<?php echo $term->name ?>
						<div class="dot" style="background: <?php echo get_field('color', $term); ?>"></div>
					</a>
				<?php endforeach; ?>
			</div>

			<div id="franjaTexto">
				<p>
					Archivo en construcción / Archive under construction
				</p>
			</div>

			<div class="inside">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<?php
					$galeria = get_field('galeria');
					$categ = get_the_terms(get_the_ID(), 'tipos_agenda');
					$class = '';

					if($categ): foreach($categ as $cat):
						$class .= $cat->slug . ' ';
					endforeach; endif;
				?>
					<a class="item_archive <?php echo $class; ?>" href="<?php echo get_permalink() ?>">
						<div class="img" style="background-image: url('<?php echo $galeria[0]['sizes']['large'] ?>')"></div>
						<div class="title">
							<?php if($categ): foreach($categ as $item): ?>
								<?php $color = get_field('color', $item); ?>
								<div class="categ <?php echo $item->slug ?>" style="border-color: <?php echo $color ?>"></div>
							<?php endforeach; endif; ?>
							<?php the_title(); ?>
						</div>
					</a>
				<?php endwhile; endif; ?>

				<a href="<?php echo get_blogInfo('url')?>/?rest_route=/wp/v2/agenda&per_page=20&page=" data-page="2" class="item_archive moreRest">
					<div class="loader">
						<div class="circles">
							<span class="one"></span>
							<span class="two"></span>
							<span class="three"></span>
						</div>
						<div class="pacman">
							<span class="top"></span>
							<span class="bottom"></span>
						</div>
					</div>

					<div class="icon"></div>
				</a>
			</div>

			

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>

<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="archive">

		<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="search-input" type="search" name="s" placeholder="<?php _e( 'Search', 'plataforma' ); ?>">
            <button class="search-submit" type="submit" role="button"><?php _e( 'Search', 'plataforma' ); ?></button>
		</form>
		
		<div class="external_nav btm_margin">
				<a class="link related"><?php echo sprintf( __( '%s results for ', 'plataforma' ), $wp_query->found_posts ); echo ' '. get_search_query(); ?></a>
			</div>

			<div id="franjaTexto">
				<p>
					Esto es un texto de portada para plataforma
				</p>
			</div>


			<div class="inside">

				<div class="item_archive info">
					
				</div>
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
							<div class="txt_crop">
								<?php the_title(); ?>
							</div>
						</div>
					</a>
				<?php endwhile; endif; ?>
			</div>

			

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>

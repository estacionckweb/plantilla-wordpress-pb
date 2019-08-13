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
				<a href="" class="link">Ir al calendario</a>
				<?php foreach($terms as $term): ?>
					<div class="link categ <?php echo $term->slug; ?>"><?php echo $term->name ?></div>
				<?php endforeach; ?>
			</div>

			<div class="inside">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<?php $galeria = get_field('galeria'); ?>
					<a class="item_archive" href="<?php echo get_permalink() ?>">
						<div class="img" style="background-image: url('<?php echo $galeria[0]['sizes']['large'] ?>')"></div>
						<div class="title"><?php the_title(); ?></div>
					</a>
				<?php endwhile; endif; ?>
			</div>

			

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>

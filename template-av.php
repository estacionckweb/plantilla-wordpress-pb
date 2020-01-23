<?php /* Template Name: Plantilla av */ get_header(); ?>

	<main role="main">
		<section class="canal_av">

		<?php if (have_rows('elementos')): while (have_rows('elementos')) : the_row(); ?>

        <div class="item_av">
            <?php echo get_sub_field('contenido') ?>
        </div>

        <?php endwhile; endif;?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>

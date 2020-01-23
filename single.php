<?php get_header(); ?>
<div id="franjaTexto">
				<p>
					Esto es un texto de portada para plataforma
				</p>
			</div>
	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article class="single">
			<div class="left">
				<div class="inside">
				<?php
						$galeria = get_field('galeria');
						$categ = get_the_terms(get_the_ID(), 'tipos_agenda');

						$inicio = get_field('fecha_inicio');
						$todo_el_dia = get_field('todo_el_dia');
						$cierre = get_field('fecha_cierre');

						if($galeria): foreach($galeria as $img):
					?>
						<div class="img" style="background-image: url('<?php echo $img['url'] ?>')">
						</div>
					<?php endforeach; endif; ?>
				</div>
				<div class="navBlock">
					<div class="itemNav next"></div>
					<div class="itemNav prev"></div>
				</div>
				
			</div>
			<div class="right">
				<h1><?php the_title() ?></h1>
				<div class="info">
				<?php if($categ): foreach($categ as $item): ?>
					<?php
						$color = get_field('color', $item);
					?>
					<div style="background-color: <?php echo $color ?>" class="categ_name <?php echo $item->slug ?>">
						<?php echo $item->name ?>
					</div>
				<?php endforeach; endif; ?>
					<?php
					
					$tags = get_the_tags(get_the_ID());
					// print_r($tags);
					if($tags) {foreach($tags as $tag): ?>
						<div class="tag">
							<?php echo $tag->name; ?>
						</div>
					
					<?php endforeach;} ?>
					<?php if($inicio): ?>
						<div class="fecha">
							<?php if($todo_el_dia == 1): ?>
								<?php echo $inicio ?>
							<?php else: ?>
								<?php echo $inicio ?> a <?php echo $cierre ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="external_nav top_margin">
					<!-- <a href="" class="link">Ir al calendario</a> -->
					<a href="<?php echo get_post_type_archive_link(get_post_type()) ?>" class="link">Ir al archivo</a>
				</div>

				<!-- <div class="nav">
					<a href="#" class="item">Cronograma</a>
					<a href="#" class="item">Inscripción</a>
				</div> -->

				<div class="content">
					<?php the_content() ?>
				</div>

				<div class="external_nav btm_margin">
					<div class="link related">Relacionados</div>
				</div>
<section class="archive">
	<div class="inside">
				<?php $orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>5, // Number of related posts that will be shown.
'ignore_sticky_posts'=>1,
'post_type'=>'agenda'
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {

while( $my_query->have_posts() ) {
$my_query->the_post(); 
$img = get_field('galeria', get_the_ID());
?>
<a class="item_archive laboratorio " href="<?php echo get_permalink() ?>">
                    <div class="img" style="background-image: url('<?php echo $img[0]['url'];?>')"></div>
                    <div class="title">
						<div class="txt_crop"><?php the_title(); ?></div>
                    </div>
                </a>
<? }
}
}
$post = $orig_post;
wp_reset_query(); ?>
</div>
</section>
			</div>
		</article>

	<?php endwhile; endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

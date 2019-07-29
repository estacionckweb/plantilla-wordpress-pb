<?php /* Template Name: Plantilla calendario */ get_header(); ?>

	<main role="main">
		<section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<?php
			$dia_num = date("j");
			$mes_num = date("m");
			$year = date("Y");
			
			$date_today = getdate(mktime(0,0,0,$mes_num,1,$year));
			$mes_nombre = $date_today["month"];

			$primer_dia_mes = $date_today['wday'];

			$loop = true;
			$today = 27;
			while(($today <= 32) && ($loop)):
				$date_today = getdate(mktime(0,0,0,$mes_num,$today,$year));
				if($date_today["mon"] != $mes_num):
					$ultimo_dia = $today - 1;
					$loop = false;
				endif;
				$today++;
			endwhile;
		?>

		<div class="calendario_container">
			<div id="calendario">
				<div class="item nav"></div>
				<div class="item nombre"></div>
				<div class="item nav"></div>
				<div class="item dia_nom">
					<div class="inside">Dom</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Lun</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Mar</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Mie</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Jue</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Vie</div>
				</div>
				<div class="item dia_nom">
					<div class="inside">Sab</div>
				</div>

				<?php
					$dia = 1;
					$wday = $primer_dia_mes;
					$primera_semana = true;

					while($dia <= $ultimo_dia):
						if($primera_semana):
							for($i = 1; $i <= $primer_dia_mes; $i++): ?>
								<div class="item vacio"></div>
							<?php endfor; $primera_semana = false; endif; ?>

						<?php
							$class = '';
							if($dia == $dia_num) $class = 'hoy';
						?>
						<div class="item dia_<?php echo $dia ?> <?php echo $class ?>"><?php echo $dia ?></div>
						
						<?php
							$wday++;
							$wday = $wday % 7;
							$dia++;
						?>
					<?php endwhile; ?>
					<?php while($wday <= 6): ?>
						<div class="item vacio"></div>
					<?php $wday++; endwhile; ?>
			</div>
			<div class="listado"></div>
		</div>
			

		<?php endwhile; ?>
		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

(function ($, root, undefined) {
	
	$(function () {

		// scketch del logo generativo

		var scketch = function(p){
			p.setup = function() {
				p.createCanvas(400,400);
			}

			p.draw = function(){
    			p.background(0);
				p.stroke(255);
				p.strokeCap(p.SQUARE);
				p.strokeWeight(5);

				var desfase = p.mouseX / 50;

				for(var i = -100; i < 100; i++){
					dibujarLineaArriba((i * 25) + desfase);
				}

				for(var i = -100; i < 100; i++){
					dibujarLineaBaja((i * 25) - desfase + 5);
				}

				for(var i = -100; i < 100; i++){
					dibujarLineaMedia((i * 25) + (desfase * 3));
				}

				p.noStroke();
				p.fill(0);
				p.rect(80,80,240,80);
				p.rect(80,240,240,80);
			}

			dibujarLineaArriba = function(x) {
				p.line(x, 0, 100 + x, 100);
			}

			dibujarLineaBaja = function(x) {
				p.line(x, 300, 100 + x, 400);
			}

			dibujarLineaMedia = function(x) {
				p.line(400 + x, 100, 200 + x, 300);
			}
		}

		if($('body').hasClass('home'))
			var logo = new p5(scketch, 'p5_canvas');
		
		// Linea del tiempo para la animación al inicio
		var tl_inicio = new TimelineMax();

		tl_inicio.add('start', '+=0.25')
		.staggerFromTo('#TITULO g', 0.25, {autoAlpha: 0}, {autoAlpha: 1}, 0.15, '+=0.25')
		.fromTo('#LINEA', 0.5, {autoAlpha: 0}, {autoAlpha: 1}, '-=0.25')
		.fromTo('#BOGOTA', 2, {autoAlpha: 0}, {autoAlpha: 1})
		.staggerFromTo('#menu .item', 0.25, {autoAlpha: 0, y: 10}, {autoAlpha: 1, y: 0}, 0.15, 'start')
		.fromTo('#p5_canvas', 0.25, {autoAlpha: 0}, {autoAlpha: 1}, 'start')
		;

		$('#calendario .mes .nav').on('click', function(){
			$mes_nuevo = $('#calendario .mes.hide');
			$('#calendario .mes').addClass('hide');
			$mes_nuevo.removeClass('hide');
		});

		$('.calendario_container .listado .item').on('click', function(){
			$item = $(this);
			$old_height = $item.height();
			$item.find('.inside').show();

			$new_height = $item.height();
			$item.find('.inside').hide();

			var tl_temp = new TimelineMax();
			tl_temp.add('start')
			.to($item, 0.25, {css: {'height': $new_height + 'px'}})
			.add(function() {
				$item.find('.inside').fadeIn();
			})
		});

	});
	
})(jQuery, this);

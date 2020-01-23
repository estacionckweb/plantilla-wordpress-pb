(function ($, root, undefined) {
  $(function () {
    // scketch del logo generativo

    var scketch = function (p) {
      let imgBg;
      let mask;

      p.preload = function () {
        // console.log('hola');
        imgBg = p.loadImage($('#logo').attr('data-img'));
      };

      p.setup = function () {
        p.createCanvas(400, 400);
        console.log('hola');
      };

      p.draw = function () {
        p.background(23);
        // mask = p.createGraphics(400,400);
        p.stroke($('#logo').attr('data-color'));
        p.strokeCap(p.SQUARE);
        p.strokeWeight(7);

        // mask.clear();


        var desfase = p.mouseX / 50;


        // p.blendMode(p.SCREEN);
        // p.background(23);
        p.image(imgBg, 0, 0, 400, 400);

        for (var i = -50; i < 50; i++) {
          dibujarLineaArriba(i * 25 + desfase);
        }

        for (var i = -50; i < 50; i++) {
          dibujarLineaBaja(i * 25 - desfase + 5);
        }

        for (var i = -50; i < 50; i++) {
          dibujarLineaMedia(i * 25 + desfase * 3);
        }

        p.noStroke();
        p.fill(23);
        p.rect(80, 80, 240, 80);
        p.rect(80, 240, 240, 80);
      };

      dibujarLineaArriba = function (x) {
        p.line(x, 0, 100 + x, 100);
      };

      dibujarLineaBaja = function (x) {
        p.line(x, 300, 100 + x, 400);
      };

      dibujarLineaMedia = function (x) {
        p.line(400 + x, 100, 200 + x, 300);
      };
    };

    var scketch2 = function (p) {
      var particulas_a = [];
      var particlulas_b = [];
      var particlulas_c = [];
      var nums = 50;
      var noiseScale = 40;

      p.setup = () => {
        p.createCanvas(400,400);
        for(var i = 0; i < nums; i++){
          particulas_a[i] = new Particle(p.random(0, p.width),p.random(0,p.height));
          particlulas_b[i] = new Particle(p.random(0, p.width),p.random(0,p.height));
          particlulas_c[i] = new Particle(p.random(0, p.width),p.random(0,p.height));
        }
      }

      p.draw = () => {
        p.noStroke();
        p.smooth();
          for(var i = 0; i < nums; i++){
          var radius = 1;
          var alpha = 100;

          p.fill(255);
          particulas_a[i].move();
          particulas_a[i].display(radius);
          particulas_a[i].checkEdge();

          particlulas_b[i].move();
          particlulas_b[i].display(radius);
          particlulas_b[i].checkEdge();

          particlulas_c[i].move();
          particlulas_c[i].display(radius);
          particlulas_c[i].checkEdge();
        }  
      }

      function Particle(x, y){
        this.dir = p.createVector(0, 0);
        this.vel = p.createVector(0, 0);
        this.pos = p.createVector(x, y);
        this.speed = 1;
      
        this.move = function(){
          var angle = p.noise(this.pos.x/noiseScale, this.pos.y/noiseScale)*p.PI*noiseScale;
          this.dir.x = p.sin(angle);
          this.dir.y = p.cos(angle);
          this.vel = this.dir.copy();
          this.vel.mult(this.speed);
          this.pos.add(this.vel);
          
          if(p.random(0, 1) >= 0.9){
            // this.pos.x = random(50, 500);
            // this.pos.y = random(50, 500);
            
            var numRandom = parseInt(p.random(0,4));
            if(numRandom == 0){
              this.pos.x = p.random(10,390);
              this.pos.y = p.random(10,80);
            } else if(numRandom == 1){
              this.pos.x = p.random(10,390);
              this.pos.y = p.random(160,240);
            } else if(numRandom == 2){
              this.pos.x = p.random(10,390);
              this.pos.y = p.random(320,390);
            } else if(numRandom == 3){
              
              var newRandom = parseInt(p.random(0,4));
              if(newRandom == 0){
                this.pos.x = p.random(10,80);
                this.pos.y = p.random(80,160);
              } else if(newRandom == 1){
                this.pos.x = p.random(320,390);
                this.pos.y = p.random(80,160);
              } else if(newRandom == 2){
                this.pos.x = p.random(10,80);
                this.pos.y = p.random(240,320);
              } else if(newRandom == 3){
                this.pos.x = p.random(320,390);
                this.pos.y = p.random(240,320);
              }
                
            }
          }
        }
      
        this.checkEdge = function(){
      
        }
      
        this.display = function(r){
          p.ellipse(this.pos.x, this.pos.y, r, r);
        }
      }
    };

    setTimeout(function () {
      scrollTira();
    }, 50);

    function scrollTira() {
      var texto = $('#franjaTexto p').width();
      var width = $('#franjaTexto').width();
      var vel = 3 * texto;

      $('#franjaTexto p').css({
        'left': width
      });
      $('#franjaTexto p').animate({
        'left': -texto
      }, (50000000 / width), 'linear', function () {
        scrollTira();
      });
    }

    var randomSketch = parseInt(Math.random() * 2);

    if ($("body").hasClass("home") && randomSketch == 0) var logo = new p5(scketch2, "p5_canvas");
    else if ($("body").hasClass("home") && randomSketch == 1) var logo = new p5(scketch, "p5_canvas");

    $('#carrousel').flickity({
      // options
      cellAlign: 'left',
      contain: true,
      prevNextButtons: false,
      pageDots: false
    });

    var elem = document.querySelector('.frontStar .inside');
    var frontSlider = new Flickity(elem, {
      // options
      cellAlign: 'left',
      contain: true
    });

    $('.frontStar .next').on('click', () => {
      frontSlider.next();
    })

    $('.frontStar .prev').on('click', () => {
      frontSlider.previous();
    })


    var elemSingle = document.querySelector('.single:not(.block) .left .inside');
    var frontSliderSingle = new Flickity(elemSingle, {
      // options
      cellAlign: 'left',
      contain: true
    });

    $('.left .next').on('click', () => {
      frontSliderSingle.next();
    })

    $('.left .prev').on('click', () => {
      frontSliderSingle.previous();
    })


    // Linea del tiempo para la animación al inicio
    var tl_inicio = new TimelineMax();

    tl_inicio
      .add("start", "+=0.25")
      .staggerFromTo(
        "#TITULO g",
        0.25, {
          autoAlpha: 0
        }, {
          autoAlpha: 1
        },
        0.15,
        "+=0.25"
      )
      .fromTo(
        "#LINEA",
        0.5, {
          autoAlpha: 0
        }, {
          autoAlpha: 1
        },
        "-=0.25"
      )
      .fromTo(
        "#BOGOTA",
        2, {
          autoAlpha: 0
        }, {
          autoAlpha: 1
        }
      )
      // .staggerFromTo(
      //   "#menu .item",
      //   0.25, {
      //     autoAlpha: 0,
      //     y: 10
      //   }, {
      //     autoAlpha: 1,
      //     y: 0
      //   },
      //   0.15,
      //   "start"
      // )
      .fromTo(
        "#p5_canvas",
        0.25, {
          autoAlpha: 0
        }, {
          autoAlpha: 1
        },
        "start"
      );

      var hash = location.hash.substr(1);

      

    $("#calendario .mes .nav").on("click", function () {
      $mes_nuevo = $("#calendario .mes.hide");
      $("#calendario .mes").addClass("hide");
      $mes_nuevo.removeClass("hide");
    });

    $(".calendario_container .listado .item").on("click", function () {
      if ($(this).hasClass("active")) {
        $item = $(this);
        $item.removeClass("active");
        $(".calendario_container .listado .item.inactive").removeClass(
          "inactive"
        );
        $(".calendario_container .mes .item.siHayActivo").removeClass(
          "siHayActivo"
        );
        $old_height = $item.height();
        $item.find(".inside").hide();
        $item.attr("style", "");

        $new_height = $item.height();

        var tl_temp = new TimelineMax();
        tl_temp.add("start").fromTo(
          $item,
          0.25, {
            css: {
              height: $old_height + "px"
            }
          }, {
            css: {
              height: $new_height + "px"
            }
          }
        );
      } else {
        $(".calendario_container .listado .item.active").click();
        $item = $(this);
        $item.addClass("active");
        $(".calendario_container .listado .item:not(.active)").addClass(
          "inactive"
        );
        $old_height = $item.height();
        $item.find(".inside").show();
        $item.attr("style", "");

        $new_height = $item.height();
        $item.find(".inside").hide();

        var tl_temp = new TimelineMax();
        tl_temp
          .add("start")
          .to($item, 0.25, {
            css: {
              height: $new_height + "px"
            }
          })
          .add(function () {
            $item.find(".inside").fadeIn();
          });

        activarCalendario($item, "siHayActivo");
      }
    });

    $(".calendario_container .listado .item").each(function () {
      $item = $(this);
      activarCalendario($item, "siHay");
    });

    function activarCalendario($item, classe) {
      inicio = $item.attr("data-inicio").split("/");
      cierre = $item.attr("data-cierre").split("/");
      if (cierre == "") {
        $mes = $("#calendario .mes_" + inicio[1]);
        $dia = $mes.find(".dia_" + inicio[0]);

        $dia.addClass(classe);
      } else {
        $mes = $("#calendario .mes_" + inicio[1]);
        $dia = $mes.find(".dia_" + inicio[0]);

        index_1 = $dia.index();

        $mes = $("#calendario .mes_" + cierre[1]);
        $dia = $mes.find(".dia_" + cierre[0]);

        index_2 = $dia.index();

        if (cierre[1] == inicio[1]) {
          for (var i = index_1; i < index_2; i++) {
            $mes.find(".item:nth-child(" + (i + 1) + ")").addClass(classe);
          }
        }
      }
    }

    $('.single .left .size').on('click', function () {
      if (!$('.single .left').hasClass('wide')) {
        $('.single .right').fadeOut(function () {
          $('.single .left').addClass('wide');
        });
      } else {
        $('.single .left').removeClass('wide');
        setTimeout(function () {
          $('.single .right').fadeIn();
        }, 500);
      }
    });

    $more = $('.archive .moreRest').clone();
    $infoArchivo = $('.archive .info.item_archive').clone();
    $('.archive .info.item_archive').remove();

    bindRestNav();

    $('.archive .external_nav .link.categ').on('click', function(e){
      e.preventDefault();
      var $item = $(this);

      var $contenido = $item.find('.contentinfo').clone();

      $('.archive .external_nav .link.categ.active').removeClass('active');
      $item.addClass('active');

      var url = $item.attr('href');

      $more.attr('data-page', 2);
      $more.attr('href', url + '&page=');

      $('.archive .inside').empty();
      $.getJSON(url, (data) => {
        $infoArchivo.empty();
        $infoArchivo.append($contenido);
        $('.archive .inside').append($infoArchivo);
        for (var i = 0; i < data.length; i++) {
          if (data[i].acf.galeria) {
            var $div = darBloqueItemObra(data[i].link, data[i].acf.galeria[0].sizes['large'], data[i].title.rendered, data[i].tipos_name, data[i].tipos_color);
            $('.archive .inside').append($div);
          }
        }
        if(data.length == 20){
        $('.archive .inside').append($more);
        $more.attr('data-page', page + 1);

        bindRestNav();}
      })
    });

    function bindRestNav() {

      $('.archive .moreRest').on('click', function (e) {
        e.preventDefault();
        var $item = $(this);
        var page = parseInt($item.attr('data-page'));
        var url = $item.attr('href');
        // console.log(page);

        var finalUrl = url + page;

        $item.addClass('active');


        $.getJSON(finalUrl, (data) => {
          // console.log(data);
          $item.remove();
          for (var i = 0; i < data.length; i++) {
            // if (data[i].acf.galeria) { data[i].acf.galeria[0].sizes['large']
              var $div = darBloqueItemObra(data[i].link, '', data[i].title.rendered, data[i].tipos_name, data[i].tipos_color);
              $('.archive .inside').append($div);
            // }
          }

          if(data.length == 20){
            $('.archive .inside').append($more);
            $more.attr('data-page', page + 1).removeClass('active');
            bindRestNav();}
        })
      });
    }

    function darBloqueItemObra(url, imgUrl, title, categArray, categColorArray) {
      var $div = $('<a class="item_archive"></a>');
      var $img = $('<div class="img"></div>');
      var $title = $('<div class="title"></div>');
      var $categorias = $('<div class="categ"></div>');

      $div.attr('href', url);
      $img.css({
        'background-image': 'url("' + imgUrl + '")'
      });

      // for (var t = 0; t < autoresArray.length; t++) {
      //     $autores.append('<li>' + autoresNames[t] + '</li>');
      // }

      for (var t = 0; t < categArray.length; t++) {
        $title.append('<div class="categ" style="border-color: ' + categColorArray[t] + '"></div>');
      }

      $title.append(title);


      $div
        .append($img)
        .append($title)
      // .append($autores)
      // .append($disciplinas)
      ;

      return $div;
    }

    if(hash != '') {
      // alert(hash);
      let $elems = $('.external_nav .link.categ');
      if($elems.length > 0) {
        $('.external_nav .link.categ.' + hash).click();
        console.log(hash);
        window.location.hash = '#';
      }
    }

    $('.btnMenu').on('click', () => {
      if($('.btnMenu').hasClass('active')){
        $('.btnMenu').removeClass('active');
        $('body').removeClass('activeMenu');
        $('.wrapper').removeClass('activeMenu');
        $('.sideMenu').removeClass('activeMenu');
      } else {
        $('.btnMenu').addClass('active');
        $('body').addClass('activeMenu');
        $('.wrapper').addClass('activeMenu');
        $('.sideMenu').addClass('activeMenu');
      }
    })

    $('.tags a').on('click', (e) => {
      var $elem = $(e.target);
      var url = $elem.attr('href');
      // console.log(e);
      $.getJSON(url, (data) => {
        // console.log(data);
        $elem.addClass('active');
        for(var i = 0; i < data.length; i++){
          var $new = $('<a></a>');
          $new.addClass('postLink');
          $new.html(' [ ' + data[i].title.rendered + ' ] ');
          $new.attr('href', data[i].link);
          $new.insertAfter($elem);
        }
      });
      
      return false;
    })

  });
})(jQuery, this);
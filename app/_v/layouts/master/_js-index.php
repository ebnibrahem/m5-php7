<!-- app main javascript -->

<!-- Scripts -->
<script src="<?= asset() ?>js/jquery-3.3.1.min.js"></script>
<script src="<?= asset() ?>js/popper.min.js" defer=""></script>
<script src="<?= asset() ?>js/bootstrap.min.js" defer=""></script>

<!-- <script src="<?= asset() ?>js/main.js?745" defer=""></script> -->
<script src="<?= asset() ?>js/js.js" defer=""></script>

<!-- custome javascript -->
<?php if ($javascript = M5\MVC\Config::get('javascript')) : ?>
   <script src="<?= asset() . $javascript ?>" defer=""></script>
<?php endif; ?>

<?php if ($stylesheet = M5\MVC\Config::get('stylesheet')) : ?>
   <link rel="stylesheet" type="text/css" href="<?= asset() . $stylesheet ?>">
<?php endif; ?>


<script>
   $(document).ready(function($) {
      $(".close_msg").click(function(event) {
         $(this).parent('div').fadeOut();
      });
      setTimeout(function() {
         // $("#msg-flash-error").fadeOut('slow');
         $("#msg-flash-error").addClass('fadeUp');
      }, 15000);

      // images slider
      $('#image-slider-content').removeClass('d-none');
      /*layout content*/
      $('#imageSlider').lightSlider({
         item: 4,
         slideMove: 4,
         auto: true,
         loop: true,
         slideMargin: 0,
         enableDrag: true,
         currentPagerPosition: 'left',
         responsive: [{
            breakpoint: 786,
            settings: {
               item: 1,
               slideMove: 1,
               slideMargin: 6,
            }
         }, ]
      });

      // partnersSlider slider
      $('#partner-slider-content').removeClass('d-none');
      /*layout content*/
      $('#partnersSlider').lightSlider({
         item: 4,
         slideMove: 4,
         auto: true,
         loop: true,
         slideMargin: 0,
         enableDrag: true,
         currentPagerPosition: 'left',
         responsive: [{
            breakpoint: 786,
            settings: {
               item: 1,
               slideMove: 1,
               slideMargin: 6,
            }
         }, ]
      });

   });

   $("#preloader").remove();
</script>

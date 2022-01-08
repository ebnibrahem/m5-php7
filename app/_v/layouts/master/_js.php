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

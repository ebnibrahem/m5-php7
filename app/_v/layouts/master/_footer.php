<?php
// require_once(V_PATH . parsePagePath('layouts.master._js') . '.php')
?>

<?php if ($_footer != 'override') : ?>
   <footer id="footer">

      <div id="rights">
         © جميع الحقوق محفوظة لموقع
         الأكاديمية الدولية لتنمية الموارد البشرية
         2021
      </div>

      <ul class="text-uppercase">
         <li class="">
            <a href="<?= url() ?>"><?= s('g.home') ?></a>
         </li>
         <li class="">
            <a href="<?= url('courses') ?>"><?= s('g.courses') ?></a>
         </li>
         <li class="">
            <a href="<?= url("pages/about") ?>"> <?= s('g.about') ?> </a>
         </li>
         <li class="">
            <a href="<?= url("pages/contact") ?>"> <?= s('g.contact') ?> </a>
         </li>
         <?php if (app()->getlanguage() == 'ar') : ?>
            <li><a href="<?= url('en') ?>">English</a></li>
         <?php endif ?>
         <?php if (app()->getlanguage() == 'en') : ?>
            <li><a href="<?= URL ?>">عربي</a></li>
         <?php endif ?>
      </ul>

   </footer>
<?php endif ?>

</body>

<div id="scroll_up" class="arrow_cyr" style="right: 10px;">
   <i class="fa fa-angle-up"></i>
</div>

</html>

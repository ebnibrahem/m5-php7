<!DOCTYPE html>
<html lang="<?= app()->getLanguage() ?>">
<?php define('site_name', $app->name); ?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title ?></title>

   <meta name="title" content="<?= !$title ? site_name : $title ?>">
   <meta name="keywords" content="<?= $SEO['keywords'] ?>">
   <meta name="description" content="<?= $SEO['description'] ?>">
   <meta name="author" content="<?= site_name ?>">
   <meta property="image" content="<?= !$SEO['image'] ? LOGO : $SEO['image'] ?>" />
   <meta property="type" content="<?= !$SEO['type'] ? 'atricle' : $SEO['type'] ?>" />

   <meta property="og:title" content="<?= !$SEO['title'] ? site_name : $title ?>" />
   <meta property="og:keywords" content="<?= $SEO['keywords'] ?>">
   <meta property="og:description" content="<?= $SEO['description'] ?>" />
   <meta property="og:image" content="<?= !$SEO['image'] ? LOGO : $SEO['image'] ?>" />
   <meta property="og:type" content="<?= !$SEO['type'] ? 'atricle' : $SEO['type'] ?>" />
   <meta property="og:url" content="<?= url() ?>" />

   <link rel="canonical" href="<?= $SEO['canonical'] ? $SEO['canonical'] : url("/") ?>" />


   <!-- app main Style -->
   <link rel="stylesheet" type="text/css" href="<?= asset('css/app.css' . CACHE_VAR) ?>">

   <!-- html font -->
   <link rel="stylesheet" type="text/css" href="<?= asset('css/fa_v5.14.all.min.css') ?>">

</head>

<?php
$getController = strtolower(app()->getController());
?>

<body id="body" class="<?= $getController ?> <?= app()->getLanguage() ?> " data-full_url=<?= URL ?>" data-url="<?= URL ?>" data-pageflag="index" data-auth="" oncontextmenu="return true">

   <?php if ($_header != 'override') : ?>

      <header id="header" class="<?= $getController ?>">
         <div id="toper" class="<?= $getController ?>">
            <div class="toper">
               <ul>
                  <li><a href="tel:00601137646003"><i class="fa fa-phone"></i>00601137646003</a></li>
                  <li><a href="to:info@iahrd.com"><i class="fa fa-envelope"></i>info@iahrd.com</a></li>
                  <li class="d-lg-none d-block"><a href="<?= url('en') ?>"><i class="fa fa-language"></i>EN</a></li>
               </ul>
            </div>
         </div>

         <div class="header">

            <div id="nav_menu_flag" class="<?= $getController ?>">
               <span></span>
               <span></span>
               <span></span>
            </div>

            <div id="logo">
               <a href="<?= url() ?>">
                  <img src="<?= asset("images/logo.png") ?>" alt="الأكاديمية الدولية لتنمية الموارد البشرية">
               </a>
            </div>

            <div id="nav-bar">
               <ul>
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
            </div>
            <!-- nav-bar -->


         </div>
      </header>
   <?php endif ?>
   <!-- header -->

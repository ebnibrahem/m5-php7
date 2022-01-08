<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> <?= s('g.admin') ?> </title>

   <!-- app main Style -->
   <link rel="stylesheet" type="text/css" href="<?= asset('css/app_admin.css' . CACHE_VAR) ?>">

   <!-- html font -->
   <link rel="stylesheet" type="text/css" href="<?= asset('css/fa_v5.14.all.min.css') ?>">

</head>

<body>

   <div id="admin-login-page">
      <div data-v-2616ec0a="" id="app-app">
         <div data-v-ff4f2d62="" data-v-2616ec0a="" class="loader loader-fixed d-none">
            <div data-v-ff4f2d62="">
               <div data-v-ff4f2d62="" class="loader-wrapper">
                  <div data-v-ff4f2d62="" class="loader-inner progress"></div>
               </div>
            </div>
         </div>
         <div data-v-2616ec0a="" id="baisan-toast" class="dismissed">
            <div class="baisan-toast">
               <div class="baisan-toast-message"><span>toasting message content</span></div>
               <div class="baisan-toast-dismiss">
                  ×
               </div>
               <!---->
            </div>
         </div>
         <div data-v-2616ec0a="" id="app-page">
            <div data-v-2616ec0a="" id="dash-menu" class="dark">
               <div id="dash-menu-logo"><a href="/"><img src="/images/logo.png"></a></div>
               <div class="my-2 text-center text-white">
                  <div>
                     App Admin
                  </div>
               </div>
               <div class="text-center my-3 d-lg-none d-block"><a> × </a></div>
               <ul id="dash-menu-aside">
                  <li><a href="/"><i class="fa fa-globe"></i>
                        الموقع
                     </a></li>
                  <li class=""><a href="#/" class="router-link-exact-active router-link-active"><i class="fa fa-th"></i>
                        الرئيسية
                     </a></li>
                  <li class=""><a href="#/categories" class=""><i class="fa fa-bars"></i>
                        الاقسام
                     </a></li>
               </ul>
            </div>
            <div data-v-2616ec0a="" id="dash-body">
               <div data-v-2616ec0a="" id="dash-body-header"><i data-v-2616ec0a="" id="menu-toggler" class="fa fa-bars _22 d-lg-none d-block"></i></div>
               <div data-v-2616ec0a="" id="content">
                  <div data-v-2616ec0a="" id="admin-home">
                     <div id="auth-user" class="mb-2">
                        <div class="mb-5"><span class="font-bold _12">
                              السلام عليكم, App Admin
                           </span>
                           <hr>
                        </div>
                     </div>
                     <?php
                     pa(M5\Library\Session::get('auth'));
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- #admin-login-page -->

</body>

</html>

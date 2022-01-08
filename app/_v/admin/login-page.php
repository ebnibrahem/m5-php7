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

      <div class="row justify-content-center">
         <div class="col-lg-5 col-10">
            <form action="" method="post" style="margin-top:100px" class="input-underline">
               <div class="card">
                  <div class="card-body p-5">
                     <div class="form-group mb-5">
                        <div class="text-center font-bold _22">
                           <?= s('g.admin') ?>
                        </div>
                     </div>
                     <?php if ($msg = M5\Library\Session::get('auth')) : ?>
                        <div> login-before </div>
                     <?php endif ?>
                     <?php if ($msg = M5\Library\Session::get('msg')) : ?>
                        <div>
                           <?= $msg ?>
                        </div>
                        <?php M5\Library\Session::end('msg') ?>
                     <?php endif ?>
                     <div class="form-group">
                        <input type="text" name="username" required="required" placeholder="<?= s('g.username') ?>" class="form-control" />
                     </div>
                     <div class="form-group">
                        <input type="password" name="password" required="required" placeholder="<?= s('g.password') ?>" class="form-control" autocomplete="password" />
                     </div>
                     <div class="form-group mt-5">
                        <button type="submit" name="loginBtn" value="loginBtn" class="btn btn-primary btn-block">
                           <?= s('g.login') ?>
                        </button>
                     </div>
                  </div>
               </div>
            </form>
            <div class="text-center mt-5">
               <a href="<?= url() ?>">
                  <?=
                  M5\Models\Application::getApp()->name;
                  ?>
               </a>
            </div>
         </div>
      </div>

   </div>
   <!-- #admin-login-page -->

</body>

</html>

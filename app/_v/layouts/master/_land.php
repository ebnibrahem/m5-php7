      <?php if ($_land != 'override') : ?>
         <div id="land" class="<?= app()->getLanguage() ?>">
            <div class="land">

               <div class="land-avatar text-center">

               </div>

               <div class="land-site">
                  <div class="land-site-wrapper">
                     <div class="site-logo optimize">
                        <img data-src="<?= asset("images/logo.png") ?>" src="<?= LOADING ?>" alt="<?= $app->name ?>" />
                     </div>
                     <div class="site-name">
                        <?= $app->name ?>
                     </div>
                     <div class="site-description">
                        <p>
                           <?= $app->description ?>
                        </p>
                     </div>
                     <div id="search">
                        <form id="header-form-search" action="<?= url('courses') ?>">
                           <div class="form-group">
                              <input id="q" type="text" name="q" class="form-control" placeholder="<?= s('g.search-tips'); ?>" required="required" value="<?= M5\Library\Clean::sqlInjection($_GET['q']) ?>">
                              <button type="submit" class="btn search-btn <?= app()->getLanguage() ?>">
                                 <i class="fa fa-search"></i>
                              </button>
                           </div>

                        </form>
                     </div>

                  </div>
               </div>

            </div>

         </div>
      <?php endif ?>

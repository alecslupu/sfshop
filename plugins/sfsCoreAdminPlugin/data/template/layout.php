<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>

    <?php include_javascripts()?>
    <?php include_stylesheets()?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    <div id="main">
      <?php if ($sf_user->isAuthenticated()):?>
        <?php include_component("sfsCoreAdminLayout","head"); ?>
      <hr class="noscreen" />
        <?php include_component("sfsCoreAdminLayout","menu"); ?>
      <hr class="noscreen" />
      <!-- Columns -->
      <div id="cols" class="box">
          <?php include_component("sfsCoreAdminLayout","left"); ?>
        <hr class="noscreen" />
        <!-- Content (Right Column) -->
        <div id="content" class="box">
          <?php endif;  ?>

          <?php echo $sf_content?>

          <?php if ($sf_user->isAuthenticated()):?>
        </div>
      </div>
      <hr class="noscreen" />
        <?php include_component("sfsCoreAdminLayout","footer"); ?>
      <?php endif;  ?>
    </div>
  </body>
</html>
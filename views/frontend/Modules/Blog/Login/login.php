<?php $title = 'Connexion'; ?>
<?php ob_start(); ?>
    <div class="container">
        <?php include "views/frontend/modules/blog/login/form_login.php"; ?></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php include 'views/frontend/templates/template.php'; ?>
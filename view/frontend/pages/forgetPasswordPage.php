<?php $title = 'Mot de passe oublié'; ?>
<?php ob_start(); ?>
    <div class="container">
    	<?php include "view/frontend/forms/form_forget.php"; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
    <?php require('view/frontend/templates/template.php'); ?>
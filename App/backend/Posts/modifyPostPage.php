<?php 
if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
    header('Location: index.php?action=noAdmin');
    exit();
}
?>
<?php $title = 'Modification des articles'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php require "App/frontend/includes/nav.php"; ?>
            <div class="container">
                <?php require "App/backend/includes/management.php"; ?>
                <h2 class="text-center">Gestion des articles</h2>
                <div class="post box">
                    <div class="row">
                        <h2>Modifier l'article</h2>
                        <?php require "App/backend/forms/form_modifypost.php" ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="divide50"></div>
<?php $content = ob_get_clean(); ?>
<?php require 'App/backend/templates/template.php'; ?>
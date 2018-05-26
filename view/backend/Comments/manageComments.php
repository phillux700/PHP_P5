<?php
    if(!isset($_SESSION['pseudo']) || ($_SESSION['autorisation']) != 1 ) {
    header('Location: index.php?action=noAdmin');
    exit();
}
?>
<?php $title = 'Gestion des commentaires'; ?>
<?php ob_start(); ?>
<body class="full-layout">
    <div class="body-wrapper">
        <?php require "view/frontend/includes/nav.php"; ?>
        <div class="container">
            <?php require "view/backend/includes/management.php"; ?>
            <h2 class="text-center">Gestion des commentaires</h2>
            <div class="divide20"></div>
            <p class="text-center">(Les commentaires déjà validés peuvent être supprimés directement sur le blog.)</p>
            <div class="divide20"></div>
            <h5 class="text-center">
                <?php if($nbCount > 1) : ?>
                Il y a <?php echo $nbCount; ?> commentaires à valider.
                <?php elseif($nbCount == 1) : ?>
                Il y a un commentaire à valider.
                <?php else: ?>
                Il n'y a aucun commentaire à valider.
                <?php endif; ?>
            </h5>
            <div class="divide20"></div>
            <?php
            while ($data = $submittedcomments->fetch())
            {
            ?>
            <div class="post box">
                <div class="row">
                    <h3><?php echo htmlspecialchars($data['post_id']); ?></h3>
                    <p>Commentaire de <?php echo htmlspecialchars($data['author']); ?> publié le <?php echo htmlspecialchars($data['creation_date_fr']); ?></p>
                    <p><?php echo htmlspecialchars($data['content']); ?></p>
                </div>
                <btn class="btn btn-default" style="float: right;">
                    <a href="index.php?action=validateComment&amp;id=<?php echo $data['id'] ?>">Valider</a>
                </btn>
                <btn class="btn btn-default" style="float: right;">
                    <a href="index.php?action=adminDeleteComment&amp;id=<?php echo $data['id'] ?>">Supprimer</a>
                </btn>
            </div><?php
            } 
            $submittedcomments->closeCursor();
            ?></div>
            <div class="divide100"></div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/backend/templates/template.php'; ?>
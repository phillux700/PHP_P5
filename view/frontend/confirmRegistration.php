<?php $title = 'Confirmation'; ?>
<?php ob_start(); ?>

<body class="full-layout">
    <div class="body-wrapper">
        <?php include "includes/nav.php"; ?>
            <!-- /#home -->
        <div class="container">
            <div class="divide30"></div>
            <div class="col-md-offset-2 col-md-6 col-sm-12">
            <p class="text-center">Votre inscription a bien été prise en compte.<br />
                Bienvenue sur le site !
                 </p>
        </div>

        </div>
            <!-- /.container -->
    </div>
    <!-- /.body-wrapper -->
    <?php include "includes/foot.php"; ?>
</body>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
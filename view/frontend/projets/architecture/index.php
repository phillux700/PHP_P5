<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>La maison de l'architecte</title>
    <meta name="description" content="Le site de la maison de l'architecture">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css"> 

      /* Styles de base */
      body {
        font-family: 'Bitter', serif;
        background-color: #eef;
        color: #333;
        background: url('assets/img/fond.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
        position: relative;
      }

      /* Titres */
      h1 {
        margin-bottom: 40px;
      }

      /* Images */
      img {
        width: 100%;
      }

      /* Jumbotron */
      .jumbotron {
        margin-top: 40px;
        background: rgba(255, 255, 255, 0.5);
      }
      .jumbotron img {
        padding-bottom: 20px;        
      }

      /* Footer */
      footer.row {
        margin: 20px 0 40px 0;
      }

    </style>

  </head>

  <body id="page-top" data-spy="scroll" data-target=".navbar">

    <header>

      <!-- Navigation
      ================================================== -->
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#page-top">La maison de l'architecture</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="hidden"><a href="#page-top"></a></li>
              <li><a href="#accueil">Accueil</a></li>
              <li><a href="#qui">Qui sommes-nous ?</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>   

    </header>

    <!-- Caroussel
    ================================================== -->
    <div id="monCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicateurs -->
      <ol class="carousel-indicators">
        <li data-target="#monCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#monCarousel" data-slide-to="1"></li>
        <li data-target="#monCarousel" data-slide-to="2"></li>
        <li data-target="#monCarousel" data-slide-to="3"></li>
      </ol>
      <!-- Diapositives -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="assets/img/archi1.jpg" alt="Architecture">
          <div class="carousel-caption">
            <h3>Un design futuriste</h3>
          </div>
        </div>
        <div class="item">
          <img src="assets/img/archi2.jpg" alt="Architecture">
          <div class="carousel-caption">
            <h3>Des formes sublimes</h3>
          </div>
        </div>
        <div class="item">
          <img src="assets/img/archi3.jpg" alt="Architecture">
          <div class="carousel-caption">
            <h3>Un élan vers le futur</h3>
          </div>
        </div>
        <div class="item">
          <img src="assets/img/archi4.jpg" alt="Architecture">
          <div class="carousel-caption">
            <h3>Une intégration aérienne</h3>
          </div>
        </div>
      </div>
      <!-- Contrôles -->
      <a class="left carousel-control" href="#monCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#monCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>  
    </div>

    <!-- Corps de page
    ================================================== -->
    <div class="container">

      <div class="jumbotron row" id="accueil">
        <h1 class="text-center">Bienvenue dans notre espace</h1>
        <img class="col-sm-12 col-md-5" src="assets/img/accueil.jpg" alt="Accueil">     
        <p class="col-sm-12 col-md-7">Nous sommes spécialisés dans tous types de constructions et nous prenons en charge les projets de A à Z. Vous pouvez nous confier en toute confiance des projets de toutes dimensions, des plus simples aux plus osés. Notre équipe est efficace, réactive et compétente. Nous entretenons toujours un dialogue de tous les instants avec nos clients. Bien qu'à la pointe de notre activité nous pratiquons des prix rigoureux et adaptés à tous les budgets.</p>
      </div>

      <div class="jumbotron row" id="qui">
        <h1 class="text-center">Une équipe efficace</h1>
        <img class="col-sm-12 col-md-5 col-md-push-7" src="assets/img/equipe.jpg" alt="Equipe"> 
        <p class="col-sm-12 col-md-7 col-md-pull-5">Notre équipe est jeune, experte et motivée. Notre entreprise est certifiée ISO 9001. Nous cherchons en permanence à améliorer la qualité de nos services et nous sommes à l'écoute de nos clients.</p>
      </div>

      <div class="jumbotron" id="contact">
        <h1 class="text-center">Un message pour nous ?</h1>
        <form class="row">
          <div class="form-group col-lg-4">
            <input type="email" class="form-control" placeholder="Votre email">
          </div>
          <div class="form-group col-lg-8">
            <textarea class="form-control" rows="3" placeholder="Votre message"></textarea>
          </div>
          <div class="form-group col-lg-12">
            <button type="submit" class="btn btn-default pull-right">Envoyer</button>
          </div>
        </form>
      </div>

    </div>

    <!-- Pied de page
    ================================================== -->
    <footer class="row text-center">
      <a class="btn btn-default" href="#"><i class="fa fa-twitter fa-2x"></i></a>
      <a class="btn btn-default" href="#"><i class="fa fa-facebook fa-2x"></i></a>
      <a class="btn btn-default" href="#"><i class="fa fa-google-plus fa-2x"></i></a>
      <a class="btn btn-default" href="#"><i class="fa fa-flickr fa-2x"></i></a>
      <a class="btn btn-default" href="#"><i class="fa fa-spotify fa-2x"></i></a>
    </footer>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Javascript de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 
    <script>
      // Scrollspy fluide
      $(function () {
        $('header a').on('click', function(e) {
          e.preventDefault();
          var hash = this.hash;
          $('html, body').animate({
            scrollTop: $(this.hash).offset().top
          }, 1000, function(){
            window.location.hash = hash;
          });
        });
      });
    </script>

  </body>

</html>
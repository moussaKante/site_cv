<!DOCTYPE html>
<?php require('connexion/connexion.php'); ?>
<?php
$resultat = $pdo -> query("SELECT * FROM utilisateur") ;
$utilisateur = $resultat->fetch();
$resultat = $pdo -> query("SELECT * FROM titre");
$titre = $resultat->fetch();
$resultat = $pdo -> query("SELECT * FROM loisir");
$loisir= $resultat->fetch();
$resultat = $pdo -> query("SELECT * FROM formation");
$formation=$resultat->fetchAll();
$resultat = $pdo -> query("SELECT * FROM experiences");
$experience = $resultat->fetchAll();
$resultat = $pdo -> query("SELECT * FROM competence");
$competence = $resultat->fetchAll();
if($_POST){
    $resultat = $pdo -> prepare("INSERT INTO contact (id_contact,prenom,email,telephone,message) VALUES(:id_contact,:prenom,:email,:telephone,:message)");
    $resultat -> bindParam(':id_contact',$_POST['id_contact'],PDO::PARAM_INT);
    $resultat -> bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
    $resultat -> bindParam(':email',$_POST['email'],PDO::PARAM_STR);
    $resultat -> bindParam(':telephone',$_POST['telephone'],PDO::PARAM_INT);
    $resultat -> bindParam(':message',$_POST['message'],PDO::PARAM_STR);
    $resultat -> execute();
}
 ?>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $utilisateur['prenom'].' '.$utilisateur['nom'].' - '.$titre['titre_cv']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="front/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="front/css/agency.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="front/css/styleFront.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><?= $utilisateur['prenom'].' '.$utilisateur['nom'];?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">A propos</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#mon_cv">Mon CV</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#formation">Formation</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#competence">Compétence</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <div class="parallax-window" data-parallax="scroll" data-image-src="front/img/header-bg.jpg">
        <header>
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in"><?= $utilisateur['prenom'].' '.$utilisateur['nom'] ?></div>
                    <div class="intro-heading"><?= $titre['titre_cv']; ?></div>
                    <a href="#services" class="page-scroll btn btn-xl">En savoir plus</a>
                </div>
            </div>
        </header>
    </div>

    <!-- Services Section -->
    <section id="services" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="col-sm-12">
                        <div class="team-member">
                            <img src="front/img/team/moi02.png" class="img-responsive img-circle" id="moi"alt="" >
                        </div>
                    </div>
                    <h2 class="section-heading">A propos</h2>
                    <h3 class="section-subheading text-muted-center ">Hier passionnée par le web , aujourd'hui jeune développeur,j'ai transformé ma passion en travail. Curieux et sérieux , je saurai repondre à toutes vos attentes.  </h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-desktop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Développement Web</h4>
                    <p class="text-muted-center">Toujours à l'affut de nouveauté, je suis disponible pour vos réalisations et ouvert à de nouvelles opportunités professionelles.</p>
                </div>
                <div class="col-md-6">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-tablet fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Responsive Design</h4>
                    <p class="text-muted-center">Je propose des sites responsives capables de s'adapter à tous vos écrans.</p>
                </div>
<!--                 <div class="col-md-4">
    <span class="fa-stack fa-4x">
        <i class="fa fa-circle fa-stack-2x text-primary"></i>
        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
    </span>
    <h4 class="service-heading"></h4>
    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
</div>
            </div> -->
        </div>
    </section>
<!-- <div class="parallax-window" data-parallax="scroll" data-image-src="front/img/header-bg.jpg"></div> -->
     <!-- About Mon CV -->
    <section id="mon_cv" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                     <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
                    </span>
                    <h2 class="section-heading">Mes Expériences professionelles </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                  <?php
                    $i=0;
                    while($i<count($experience)){
                            ?><li <?php if (($i % 2) == 0)
                                { echo 'class="timeline-inverted"';}?>>
                                <div class="timeline-image">
                                    <img class="img-circle img-responsive" src="front/img/about/<?= $experience[$i]['logo'] ?>" alt="<?= $experience[$i]['logo'] ?>" style="width: 100% ; height: 100%;">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4><?= $experience[$i]['dates']; ?></h4>
                                            <h4 class="subheading"><?= $experience[$i]['titre_exp'].' <br> '.$experience[$i]['sous_titre_exp'];?></h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class=""><?= $experience[$i]['description'];?></p>
                                    </div>
                                </div>
                            </li><?php
                            $i++;
                    }
                     ?>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-md-12 text-center">
                <a class="BoutonTelechargement" href="">
                <span class="fa-stack fa-2x">
                    <i class="fa fa-download fa-stack-2x text-primary"></i>
                    <i class="fa fa-desktop fa-stack-1x fa-inverse"></i>
                </span>
                Télecharger mon CV
                </a>
            </div> -->
            <div class="button">
                <a href="thomas_kante1.pdf">mon cv pdf</a>
                <p class="top">fichier :thomas_kante1.pdf</p>
            </div>
        </div>
    </section>
<!-- <div class="parallax-window" data-parallax="scroll" data-image-src="front/img/header-bg.jpg"></div> -->
  <!-- Services formation -->
    <section id="formation" class="bg-light-gray">
        <div class="container">
             <div class="row">
                <div class="col-lg-12 text-center">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-graduation-cap fa-stack-1x fa-inverse"></i>
                    </span>
                    <h2 class="section-heading">Mes formations</h2>
                </div>
            </div>

            <?php
                $i=0;
                while($i<count($formation)){?>
                <div class="col-md-6">
                <h4 class="service-heading"><?= $formation[$i]['titre_formation'] ?></h4>
                <p class="text-muted-left"><?= $formation[$i]['dates_formation'].'<br>'.$formation[$i]['description_formation'] ?></p>
                </div>
                 <?php
                 $i++;
             }

                 ?>

        </div>
    </section>
<!-- <div class="parallax-window" data-parallax="scroll" data-image-src="front/img/header-bg.jpg"></div> -->
  <!-- Services compétence -->
    <section id="competence" class="section" >
        <div class="container">
             <div class="row">
                <div class="col-lg-12 text-center">
                <span class="fa-stack fa-4x ">
                    <i class="fa fa-html5 fa-stack-2x text-primary"></i>
                </span>
                    <h2 class="section-heading">Mes Compétences</h2>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <h4 class="service-heading"><?= $competence[0]['titre_competence']; ?></h4>
            </div>
                <?php
                    $i=0;?>
                    <div class="row">
                    <?php while($i<count($competence)){?>
                        <?php if($i == 0) {
                           echo '<div class="col-md-6">';
                        } ?>
                            <p class="text-muted" id="<?= 'type_'.$competence[$i]['competence'];?>"><?= $competence[$i]['competence'] ?></p>


                        <?php if($i%round(count($competence)/2)== round(count($competence)/2)-1) {
                            echo '</div><div class="col-md-6">';
                        } ?>
                        <?php if($i == count($competence)-1 ) {
                           echo '</div>';
                        } ?>
                     <?php
                     $i++;
                    }

                ?>
                </div>
        </div>
    </section>

<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Portfolio</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="front/img/portfolio/thomaskante.png" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Round Icons</h4>
                    <p class="text-muted">Graphic Design</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="front/img/portfolio/sentinelle.png" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Startup Framework</h4>
                    <p class="text-muted">Website Design</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="front/img/portfolio/treehouse.png" class="img-responsive" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Treehouse</h4>
                    <p class="text-muted">Website Design</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                     <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                    </span>
                    <h2 class="section-heading">Me contacter</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" name="sentMessage" id="contactForm" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="PRENOM,NOM *" id="name" required data-validation-required-message="Veuillez entrer votre prenom,nom." name="prenom">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" id="email" required data-validation-required-message="Veuillez entrer votre adresse email." name="email">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="TELEPHONE *" id="phone" required data-validation-required-message="Veuillez entrer votre numéro de télephone." name="telephone">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="VOTRE MESSAGE *" id="message" required data-validation-required-message="Veuillez entrer votre message." name="message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Contactez moi!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; <?= $utilisateur['prenom'].' '.$utilisateur['nom'].' '. date('Y'); ?> </span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-github"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#"></a>
                        </li>
                        <li><a href="admin/authentification.php">Connexion Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals
    Use the modals below to showcase details about your portfolio projects! 
    
    Portfolio Modal 1 -->
      <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              Project Details Go Here
                              <h2>Project Name</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/thomaskante.png" alt="">
                              <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                              <p>
                                  <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                              <ul class="list-inline">
                                  <li>Date: July 2014</li>
                                  <li>Client: Round Icons</li>
                                  <li>Category: Graphic Design</li>
                              </ul>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div> 

 <!-- Portfolio Modal 2
  <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              <h2>Project Heading</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/startup-framework-preview.png" alt="">
                              <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                              <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  Portfolio Modal 3
  <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              Project Details Go Here
                              <h2>Project Name</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/treehouse-preview.png" alt="">
                              <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                              <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  Portfolio Modal 4
  <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              Project Details Go Here
                              <h2>Project Name</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/golden-preview.png" alt="">
                              <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                              <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  Portfolio Modal 5
  <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              Project Details Go Here
                              <h2>Project Name</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/escape-preview.png" alt="">
                              <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                              <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  Portfolio Modal 6
  <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                  <div class="lr">
                      <div class="rl">
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="row">
                      <div class="col-lg-8 col-lg-offset-2">
                          <div class="modal-body">
                              Project Details Go Here
                              <h2>Project Name</h2>
                              <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                              <img class="img-responsive img-centered" src="front/img/portfolio/dreams-preview.png" alt="">
                              <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                              <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div> -->

    <!-- jQuery -->
    <script src="front/vendor/jquery/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="front/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="front/js/jqBootstrapValidation.js"></script>
    <script src="front/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="front/js/agency.min.js"></script>

    <script src="front/js/parallax.js/parallax.js"></script>
    <script src="front/js/main.js"></script>
</body>

</html>

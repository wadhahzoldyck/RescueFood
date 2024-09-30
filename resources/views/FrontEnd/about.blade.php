@extends('FrontEnd.master')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">

    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Accueil</a></span> <span>À propos de nous</span></p>
          <h1 class="mb-0 bread">À propos de nous</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
          <div class="container">
              <div class="row">
                  <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
                      
                  </div>
                  <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
            <div class="heading-section-bold mb-4 mt-md-5">
                <div class="ml-md-0">
                  <h2 class="mb-4">Bienvenue sur RescueFood</h2>
              </div>
            </div>
            <div class="pb-md-5">
                <p>Nous sommes dédiés à la récupération et à la redistribution des aliments excédentaires afin de lutter contre le gaspillage alimentaire. Notre mission est de connecter les restaurants, les commerces et les organisations caritatives pour assurer que chaque repas compte.</p>
                <p>Dans un monde où des millions de tonnes de nourriture sont gaspillées chaque année, RescueFood s'engage à transformer ces surplus en opportunités pour ceux qui en ont besoin. Ensemble, nous pouvons réduire le gaspillage et nourrir nos communautés.</p>
                <p><a href="#" class="btn btn-primary">Découvrez nos actions</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
      <div class="row d-flex justify-content-center py-5">
        <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0">Abonnez-vous à notre Newsletter</h2>
            <span>Recevez des mises à jour par e-mail sur nos dernières initiatives et offres spéciales</span>
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <form action="#" class="subscribe-form">
            <div class="form-group d-flex">
              <input type="text" class="form-control" placeholder="Entrez votre adresse e-mail">
              <input type="submit" value="S'abonner" class="submit px-3">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
      
      <section class="ftco-section testimony-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center">
            <span class="subheading">Témoignages</span>
          <h2 class="mb-4">Nos clients satisfaits témoignent</h2>
          <p>Découvrez comment notre initiative a changé des vies et nourri des communautés.</p>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">RescueFood a transformé notre manière de consommer. Nous pouvons désormais contribuer à la lutte contre le gaspillage alimentaire tout en aidant ceux qui en ont besoin.</p>
                  <p class="name">Alice Dupont</p>
                  <span class="position">Coordinatrice de Projet</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">Grâce à RescueFood, nous avons pu rediriger des milliers de repas vers ceux qui en ont besoin. Une initiative incroyable !</p>
                  <p class="name">Jean Martin</p>
                  <span class="position">Directeur d'Association Caritative</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">C'est une belle initiative qui non seulement aide les personnes dans le besoin mais sensibilise aussi à l'importance de la lutte contre le gaspillage.</p>
                  <p class="name">Claire Moreau</p>
                  <span class="position">Bénévole</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">Participer à RescueFood a été l'une des meilleures décisions que j'ai prises. Je me sens utile et j'aide ma communauté.</p>
                  <p class="name">Lucie Bernard</p>
                  <span class="position">Partenaire</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                  <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                  </span>
                </div>
                <div class="text text-center">
                  <p class="mb-5 pl-4 line">La solidarité et l'entraide, voilà ce qui définit RescueFood. Une belle initiative pour un monde meilleur.</p>
                  <p class="name">Marc Lefevre</p>
                  <span class="position">Client satisfait</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

         @endsection

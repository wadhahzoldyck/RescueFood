<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admindashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('nourritures.index') }}">
          <i class="icon-food menu-icon"></i>
          <span class="menu-title">Nourritures</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dons.index') }}">
          <i class="icon-food menu-icon"></i>
          <span class="menu-title">Dons</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Livreur</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('livreursadmin.index') }}">List Livreur</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('livreursadmin.create') }}">Add Livreur</a></li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#recommandation-elements" aria-expanded="false"
            aria-controls="recommandation-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Recommandation</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="recommandation-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recommandations.create') }}">
                        Ajouter<br>Recommandation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recommandations.index') }}">
                        Liste<br>Recommandation
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#collection-elements" aria-expanded="false"
            aria-controls="collection-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Collections</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="collection-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collectadmin.create') }}">
                        Ajouter<br>Collection
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collectadmin.index') }}">
                        Liste<br>Collections
                    </a>
                </li>
            </ul>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" href="{{ route('beneficiaires.index') }}">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Beneficiaires</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('redistributions.index') }}">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Redistributions</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Livraison</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('livraison.index') }}"> List Livraison
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('livraison.create') }}"> Ajouter Livraison
                    </a></li>
            </ul>
        </div>
    </li>
    </ul>
  </nav>

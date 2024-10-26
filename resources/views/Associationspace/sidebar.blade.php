<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('associationdashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
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
            <li class="nav-item"><a class="nav-link" href="{{ route('livreurs.index') }}">List Livreur</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('livreurs.create') }}">Add Livreur</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#recommandation-elements" 
           aria-expanded="false" aria-controls="recommandation-elements">
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
        <a class="nav-link" data-toggle="collapse" href="#collection-elements" 
           aria-expanded="false" aria-controls="collection-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Collections</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="collection-elements">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collect.create') }}">
                        Ajouter<br>Collection
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('collect.index') }}">
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
            <li class="nav-item"><a class="nav-link" href="{{ route('livraison.index') }}">   List Livraison
            </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('livraison.create') }}">    Ajouter Livraison
            </a></li>          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ asset('pages/icons/mdi.html') }}">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ asset('pages/samples/login.html') }}"> Login </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ asset('pages/samples/register.html') }}"> Register </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-ban menu-icon"></i>
          <span class="menu-title">Error pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ asset('pages/samples/error-404.html') }}"> 404 </a></li>
            <li class="nav-item"><a class="nav-link" href="{{ asset('pages/samples/error-500.html') }}"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ asset('pages/documentation/documentation.html') }}">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>

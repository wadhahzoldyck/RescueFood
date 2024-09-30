<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">Vegefoods</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
            
            <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                <a href="{{ url('/about') }}" class="nav-link">About</a>
            </li>
            
            <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
            </li>
            
            <li class="nav-item cta cta-colored {{ request()->is('login') ? 'active' : '' }}">
                <a href="{{ url('/login') }}" class="nav-link">Login</a>
            </li>
        </ul>
    </div>
    
    </div>
  </nav>
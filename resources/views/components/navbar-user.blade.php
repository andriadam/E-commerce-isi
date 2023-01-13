<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">E-Commerce-ISI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('product.index') }}">Product</a>
          @guest
        <li class="nav-item">
          <a class="nav-link {{ Request::is('login*') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('register*') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
        </li>
        @endguest
        @auth
        <li class="nav-item">
          <a class="nav-link {{ Request::is('orders*') ? 'active' : '' }}" href="{{ route('user.order.index') }}">Pesanan Saya</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('cart*') ? 'active' : '' }}" href="{{ route('user.cart.list') }}">Keranjang
            <span class="top-0 start-100 translate-middle badge rounded-pill bg-info">
              {{ \Cart::getContent()->count(); }}
            </span>
          </a>

        </li>
        @endauth
      </ul>
      @auth
      <form class="d-flex ms-auto" action="{{ route('logout') }}" method="post">
        @csrf
        <button class="btn btn-light" type="submit">Logout</button>
      </form>
      @endauth
    </div>
  </div>
</nav>
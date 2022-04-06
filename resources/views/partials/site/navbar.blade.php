<!-- Navbar -->
<nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
  <div class="container-fluid ps-2 pe-0">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="/">
        {{ trans('panel.site_title') }}
    </a>
 
    <ul class="navbar-nav mx-auto">
       
       
        @if (Auth::user())
        <li class="nav-item">
          <a class="nav-link me-2 {{ request()->is('customer/home') ? 'active' : '' }}" href="/customer/home">
            Home
          </a>
        </li>
         <li class="nav-item">
            <a class="nav-link me-2" href="/customer/orders_history">
              Order History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 {{ request()->is('customer/profile') ? 'active' : '' }}" href="/customer/profile">
              Profile
            </a>
          </li>
        @else
            <li class="nav-item">
              <a class="nav-link me-2 {{ request()->is('login') ? 'active' : '' }}" href="/login">
                Sign In
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2 {{ request()->is('register') ? 'active' : '' }}" href="/register">
                Sign Up
              </a>
            </li>
        @endif
        <li class="nav-item">
          <a class="nav-link me-2 {{ request()->is('about_us') ? 'active' : '' }}" href="/about_us">
            About Us
          </a>
        </li>
      </ul>
  </div>
</nav>
<!-- End Navbar -->
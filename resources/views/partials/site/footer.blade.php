<!-- Navbar -->
<style>
  #footer  {
      position: fixed;
      height: 90px;
      bottom: 0;
      width: 100%;
      background-color: white;
  }
</style>

<footer class="navbar z-index-1" id="footer">
  <div class="container-fluid ps-2 pe-0">
    <ul class="navbar-nav mx-auto text-uppercase text-center">
       
       
        @if (Auth::user())
        <li class="nav-item">
        
          <a class="nav-link {{ request()->is('customer/home') || request()->is('customer/orders') ? 'active' : '' }}" href="/customer/home">
            <i class="material-icons text-lg">home</i> <br>  
            Home
          </a>
          
        </li>
         <li class="nav-item">
            <a class="nav-link {{ request()->is('customer/orders_history') ? 'active' : '' }}" href="/customer/orders_history">
            <i class="material-icons text-lg">list_alt</i> <br>
              Order  History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('customer/profile') ? 'active' : '' }}" href="/customer/profile">
            <i class="material-icons text-lg">account_circle</i> <br>
              Profile
            </a>
          </li>
        @else
            <li class="nav-item">
              <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">
                <i class="material-icons text-lg">login</i> <br>  
                LOGIN
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2 {{ request()->is('register') ? 'active' : '' }}" href="/register">
                <i class="material-icons text-lg">app_registration</i> <br> 
                REGISTER
              </a>
            </li>
        @endif
        <li class="nav-item">
          <a class="nav-link {{ request()->is('about_us') ? 'active' : '' }}" href="/about_us">
            <i class="material-icons text-lg">contact_page</i> <br>  
            About Us
            
          </a>
        </li>
      </ul>
  </div>
</footer>
<!-- End Navbar -->
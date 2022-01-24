<div class="drawer-side">
    <label for="my-drawer-1" class="drawer-overlay"></label> 
    <ul class="menu p-4 overflow-y-auto w-60 bg-base-100 text-base-content">
      <li class="justify-items-center">
        <div>
          <span class="title-text">Ez Queue</span>
        </div>
      </li>
      <li>
        <div>
          <span>Welcome Vendor,</span>
        </div>
      </li>
      <li class="nav-li">
        <a href="{{ route('vendor.home')}}"><span class="material-icons">home</span>&nbsp;&nbsp;Home</a>
      </li>
      <li class="nav-li">
        <a href="{{ route('vendor.profile')}}"><span class="material-icons">account_circle</span>&nbsp;&nbsp;Profile</a>
      </li>
      <li class="nav-li">
        <a href="{{ route('vendor.store')}}"><span class="material-icons">store</span>&nbsp;&nbsp;Stores</a>
      </li>  
      <li class="nav-li">
        <a href="{{ route('vendor.items')}}"><span class="material-icons">category</span>&nbsp;&nbsp;Items</a>
      </li>
      <li class="nav-li">
        <a href="{{ route('vendor.analytics')}}"><span class="material-icons">multiline_chart</span>&nbsp;&nbsp;Sales</a>
      </li>
      <li class="nav-li">
        <a><span class="material-icons">mail</span>&nbsp;&nbsp;Message</a>
      </li>
      <li class="nav-li">
        <a href="{{ route('admin.logout')}}"><span class="material-icons">logout</span>&nbsp;&nbsp;Logout</a>
      </li>
    </ul>
  </div>

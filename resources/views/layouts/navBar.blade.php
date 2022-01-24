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
          <span>Welcome Admin,</span>
        </div>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.home')}}"><span class="material-icons">home</span>&nbsp;&nbsp;Home</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.users')}}"><span class="material-icons">person</span>&nbsp;&nbsp;Users</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.vendors')}}"><span class="material-icons">person</span>&nbsp;&nbsp;Vendors</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.store')}}"><span class="material-icons">store</span>&nbsp;&nbsp;Stores</a>
      </li>  
      <li class="nav-li2">
        <a href="{{ route('admin.categories')}}"><span class="material-icons">category</span>&nbsp;&nbsp;Category</a>
      </li>
      <li class="nav-li2">
        <a  href="{{ route('admin.ad')}}"><span class="material-icons">photo</span>&nbsp;&nbsp;Ads</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.banner')}}"><span class="material-icons">panorama</span>&nbsp;&nbsp;Banners</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.analytics')}}"><span class="material-icons">multiline_chart</span>&nbsp;&nbsp;Analytics</a>
      </li>
      <li class="nav-li2">
        <a href="{{ route('admin.logout')}}"><span class="material-icons">logout</span>&nbsp;&nbsp;Logout</a>
      </li>
    </ul>
  </div>

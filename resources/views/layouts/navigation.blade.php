<div class="navbar bg-gray-800 shadow-sm">
  <label for="sidebar-toggle" class="cursor-pointer text-grey ml-4 sm:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </label>
  <div class="flex-1">
    
    <span class="text-base sm:text-lg md:text-xl lg:text-2xl text-indigo-500 ml-1 lg:ml-10 font-bold ">Room/Lab Equipment Inventory System</span>
  
 
  </div>
  <div class="flex-none mr-1 lg:mr-10">
  
    <label class="swap swap-rotate mr-2">
      <!-- this hidden checkbox controls the state -->
      <input type="checkbox" />
      <!-- sun icon -->
      <x-heroicon-o-sun class="w-5 h-5 text-gray-200 swap-on" />
      <x-heroicon-o-moon class="w-5 h-5 text-gray-200 swap-off" />
    </label>
    {{-- Notification --}}
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle hover:bg-gray-900">
          <x-untitledui-bell class=" w-5 h-5 text-gray-200 " />
      </div>
      <div
        tabindex="0"
        class="card card-compact dropdown-content bg-base-100 z-1 mt-3 w-52 shadow">
        <div class="card-body">
          <span class="text-lg font-bold">8 Items</span>
          <span class="text-info">Subtotal: $999</span>
          <div class="card-actions">
            <button class="btn btn-primary btn-block">View cart</button>
          </div>
        </div>
      </div>
    </div>
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar hover:bg-gray-900">
        <x-heroicon-o-user-circle class="w-6 h-6 text-gray-200"  />
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li>
          <a class="justify-between">
            Profile
            <span class="badge">New</span>
          </a>
        </li>
        <li><a>Settings</a></li>
        @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
              <li> <button type="submit">Logout</button></li>
        </form>

        @endauth

        @guest
            <li> <a href="{{ route('login') }}">Login</a></li>
        @endguest
      </ul>
    </div>
  </div>
</div>
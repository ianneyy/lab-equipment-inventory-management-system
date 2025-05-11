<div class="flex w-full min-h-screen">
  <!-- Sidebar toggle -->
  <input id="sidebar-toggle" type="checkbox" class="hidden" />

  <!-- Sidebar -->
  <div id="sidebar" class="bg-gray-800 text-grey min-h-screen transition-all duration-300
              w-16 overflow-hidden group" :class="{ 'w-64': document.getElementById('sidebar-toggle').checked }">
    <div class="flex items-center justify-between px-5 py-4">
      <span class="text-lg font-bold hidden group-[.w-64]:inline text-gray-300 ">{{ucwords(auth()->user()->roles)}}</span>
      <label for="sidebar-toggle" class="cursor-pointer text-grey">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </label>
    </div>
    <hr class="border-gray-700">
    <ul class="space-y-2 py-2">
      <li onclick="window.location='{{ url('/dashboard') }}'"
       class="flex items-center px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('dashboard') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
        <x-lucide-home  class="h-5 w-5 shrink-0 text-indigo-400" />
        
        <a href="{{ route('dashboard') }}" class="ml-3 hidden group-[.w-64]:inline text-gray-300">Dashboard</a>
      </li>

      @if (auth()->check() && auth()->user()->roles === 'admin')

      <li onclick="window.location='{{ url('/equipment') }}'"
       class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('equipment') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
       
        <x-lucide-computer class="h-5 w-5 shrink-0 text-indigo-400" />
        <a href="{{ route('equipment') }}" class="ml-3 hidden group-[.w-64]:inline text-gray-300">Equipment</a>
      </li>
      
      <li onclick="window.location='{{ url('/room') }}'"
       class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('room') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
        <x-lucide-building-2 class="h-5 w-5 shrink-0 text-indigo-400" />
        <a href="{{ route('room') }}" class="ml-3 hidden group-[.w-64]:inline text-gray-300">Rooms & Labs</a>
      </li>

      
      <li onclick="window.location='{{ url('/borrowing') }}'"
       class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('borrowing') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
       
        <x-lucide-clipboard-list class="h-5 w-5 shrink-0 text-indigo-400" />
        <span class="ml-3 hidden group-[.w-64]:inline text-gray-300">Borrowing</span>
      </li>

      
      <li onclick="window.location='{{ url('/maintenance') }}'" 
       class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('maintenance') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
       
        <x-lucide-drill class="h-5 w-5 shrink-0 text-indigo-400" />
        <span class="ml-3 hidden group-[.w-64]:inline text-gray-300">Maintenance</span>
      </li>


      
       <li onclick="window.location='{{ url('/audits') }}'" 
        class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
        {{ Request::is('audits') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
        <x-lucide-square-gantt-chart class="h-5 w-5 shrink-0 text-indigo-400" />
        <span class="ml-3 hidden group-[.w-64]:inline text-gray-300">Reports</span>
      </li>
      
       <li onclick="window.location='{{ url('/users') }}'"
        class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
       {{ Request::is('users') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
       
        <x-lucide-users class="h-5 w-5 shrink-0 text-indigo-400" />
        <a href="{{ route('users') }}" class="ml-3 hidden group-[.w-64]:inline text-gray-300">Users</a>
      </li>

      @endif

      @if (auth()->check() && auth()->user()->roles === 'student')
      <li onclick="window.location='{{ url('/request') }}'"
      class="flex items-center  px-5 py-3 hover:bg-gray-900 cursor-pointer
      {{ Request::is('request') ? 'bg-gray-900' : 'hover:bg-gray-900' }}">
        <x-fluentui-tray-item-add-24-o class="h-5 w-5 shrink-0 text-indigo-400" />
        <span class="ml-3 hidden group-[.w-64]:inline text-gray-300">Request Equipment</span>
      </li>
    @endif
    </ul>
  </div>

  {{-- <!-- Main content -->
  <div class="flex-1 p-6">
    @yield('content')
  </div> --}}


<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');
  
  sidebarToggle.addEventListener('change', function() {
    if (this.checked) {
      sidebar.classList.add('w-64');
      sidebar.classList.remove('w-16');
      sidebar.classList.remove('justify-center');

    } else {
      sidebar.classList.remove('w-64');
      sidebar.classList.add('w-16');
    }
  });
});
</script>

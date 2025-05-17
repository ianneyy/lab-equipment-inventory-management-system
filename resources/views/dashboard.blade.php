
<x-app-layout>
@include('layouts.sidebar')

    <div class="py-12 px-2 lg:px-10 flex-1 w-full">
        <div class="w-full px-4 ">
         {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
            {{-- <div class="p-6 bg-white border-b border-gray-200"> --}}
               <h2 class="text-3xl font-semibold text-gray-200">{{ucwords(auth()->user()->roles)}} Dashboard</h2>
               @if (auth()->check() && auth()->user()->roles === 'technician')
               <h4 class="text-gray-400 mb-6">Manage your assigned maintenance and repair tasks</h4>
                @else
                <h4 class="text-gray-400 mb-6">Welcome back, {{ucwords(auth()->user()->name)}}</h4>

               @endif
               @if (session('success'))
                <div id="successAlert" role="alert" class="alert alert-success mb-6 transition-opacity duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
                </div>
                @endif
               @if (session('error'))

                <div id="successAlert" role="alert" class="alert alert-error mb-6 transition-opacity duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                  </div>

                @endif

               @if (auth()->check() && auth()->user()->roles === 'admin')
               <!-- Flex container for cards -->
               <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-8">

                   <!-- Total Equipment Card -->
                   <div class="bg-gray-800 rounded-lg p-6 border-2 border-gray-700 w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                           
                           <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Total Equipment</p>
                                    <x-lucide-computer class="h-5 w-5 shrink-0 text-indigo-400" />
                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $totalEquipment ?? 245 }}</p>
                           </div>
                       </div>
                   </div>
                   
                   <!-- Active Borrowings Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
            
                           <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Active Borrowings</p>
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                    </svg>
                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $activeBorrowings ?? 18 }}</p>
                           </div>
                       </div>
                   </div>
                  
                   <!-- Maintenance Requests Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                            <div class="flex flex-col w-full gap-3">
                                 <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Pending Maintenance</p>
                                    <x-lucide-drill class="h-5 w-5 shrink-0 text-indigo-400" />
                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $pendingMaintenance ?? 7 }}</p>
                           </div>
                       </div>
                   </div>

                   <!-- Total Rooms Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                            <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Total Rooms/Labs</p>
                                    <x-lucide-building-2 class="h-5 w-5 shrink-0 text-indigo-400" />

                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $totalRooms ?? 12 }}</p>
                           </div>
                       </div>
                   </div>
               </div>
               @endif


               @if (auth()->check() && auth()->user()->roles === 'student' || auth()->check() && auth()->user()->roles === 'faculty/staff')
               <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-8">
                <!-- Total Equipment Card -->
                <div class="bg-gray-800 rounded-lg p-6 border-2 border-gray-700 w-full w-full sm:w-1/2 lg:w-1/4 ">
                    <div class="flex items-center">
                        
                        <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Total Borrowed</p>
                                 <x-lucide-computer class="h-5 w-5 shrink-0 text-indigo-400" />
                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $totalBorrowed ?? 245 }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Active Borrowings Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
         
                        <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Currently Borrowed</p>
                                 <x-lucide-hard-drive class="h-5 w-5 shrink-0 text-indigo-400" />

                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $currentlyBorrowed ?? 18 }}</p>
                        </div>
                    </div>
                </div>
               
                <!-- Maintenance Requests Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
                         <div class="flex flex-col w-full gap-3">
                              <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Pending Request</p>
                                 <x-lucide-clock class="h-5 w-5 shrink-0 text-indigo-400" />
                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $pendingBorrowed ?? 7 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Rooms Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
                         <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Overdue</p>
                                 <x-lucide-timer class="h-5 w-5 shrink-0 text-indigo-400" />

                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $overdueBorrowed ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                </div>  
                @endif
               <!-- Recent Borrowings Section -->
               @if (auth()->check() && auth()->user()->roles === 'admin')

               <div class="flex gap-6 mb-6 flex-col lg:flex-row">
                        <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden w-full">
                            <div class="px-6 py-4 bg-gray-800">
                                {{-- <h3 class="text-lg font-semibold text-gray-300">Recent Acitivies</h3>
                                <h4 class="text-gray-400 mb-6">Latest system activities</h4>
                                <div> --}}
                                    <h2 class="text-lg font-semibold text-gray-300 mb-4 mb-10">Equipment Distribution by Location</h2>
                                    <canvas id="locationChart" ></canvas>
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden w-full">
                            <div class="px-6 py-4 bg-gray-800">
                                <h3 class="text-lg font-semibold text-gray-300">Recent Acitivies</h3>
                                    <h4 class="text-gray-400 mb-6">Latest system activities</h4>
                                    @foreach ($audits as $audit)
                                        
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex flex-col ">
                                            <span class="text-gray-300 text-lg">{{$audit['user']}}</span>
                                            <span class="text-gray-400 text-sm flex items-center gap-2">  <x-heroicon-s-arrow-small-right class="h-4 w-4" /> {{$audit['event']}}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-300 text-sm">{{$audit['created_at']}}</span>
                                        </div>
                                    </div>
                                    @endforeach


                            </div>
                        </div>

                        

                  
               </div>
               <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden  w-full">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-300">Recent Borrowings</h3>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr class="bg-gray-800">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Equipment</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Borrower</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-700">
                                <tr class="bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">Dell Laptop XPS 15</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">John Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 4, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </td>
                                </tr>
                                <tr class="bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">Projector Epson EB-X41</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Jane Smith</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 3, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </td>
                                </tr>
                                <tr class="bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">HP LaserJet Pro</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Chris Martin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 2, 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Returned</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
               <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden mt-6">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-800 ">
                            <h3 class="text-lg font-semibold text-gray-300">Recent Maintenance Requests</h3>
                        </div>
                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class=" bg-gray-800 min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-800">
                                        <tr class="bg-gray-800">
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Equipment</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Issue</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Reported</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                                        <!-- Sample data, replace with actual data from controller -->
                                        <tr class="bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300 ">Computer Lab 3 - PC #12</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Blue screen error</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 5, 2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Pending</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">Projector - Room 201</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Lamp needs replacement</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 4, 2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">Scanner - Admin Office</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Paper jam issue</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 3, 2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">Network Switch - Server Room</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">Intermittent connection</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">May 2, 2023</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-800 text-right">
                            <a href="" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all maintenance requests &rarr;</a>
                        </div>
               </div>
               @endif

               @if (auth()->check() && auth()->user()->roles === 'student')
               <div x-data="{ tab: 'active' }">
                    <div class="flex px-4 mt-10 space-x-2 overflow-x-auto w-full sm:w-3/4">
                        <span @click="tab = 'active'" :class="tab === 'active' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Active Borrowings</span>
                        <span @click="tab = 'pending'" :class="tab === 'pending' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Pending Requests</span>
                        <span @click="tab = 'repair'" :class="tab === 'repair' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Repair Requests</span>
                        <span @click="tab = 'history'" :class="tab === 'history' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Borrowing History</span>
                        
                    </div>

                    <div class="p-6 bg-gray-800 border-2 border-gray-700  h-auto mt-5 rounded-lg">
                        <div x-show="tab === 'active'"  style="display: none;">
                            @include('components.dashboard.active')
                        </div>
                        <div x-show="tab === 'pending'"  style="display: none;">
                            @include('components.dashboard.pending')
                        </div>
                        <div x-show="tab === 'repair'"  style="display: none;">
                            @include('components.dashboard.repair')
                        </div>
                        <div x-show="tab === 'history'"  style="display: none;">
                            @include('components.dashboard.history')
                        </div>
                        
                    </div>
                </div>
               @endif

               @if (auth()->check() && auth()->user()->roles === 'technician')
               <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-8">
                <!-- Total Equipment Card -->
                <div class="bg-gray-800 rounded-lg p-6 border-2 border-gray-700 w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
                        
                        <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Total Request</p>
                                 <x-lucide-clipboard-list class="h-5 w-5 shrink-0 text-indigo-400" />
                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $taskCount ?? 245 }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Active Borrowings Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
         
                        <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Pending</p>
                                 <x-lucide-clock class="h-5 w-5 shrink-0 text-indigo-400" />

                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $pendingTask ?? 18 }}</p>
                        </div>
                    </div>
                </div>
               
                <!-- Maintenance Requests Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
                         <div class="flex flex-col w-full gap-3">
                              <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">In Progress</p>
                                 <x-lucide-wrench class="h-5 w-5 shrink-0 text-indigo-400" />
                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $inProgressTask ?? 7 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Rooms Card -->
                <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                    <div class="flex items-center">
                         <div class="flex flex-col w-full gap-3">
                             <div class="flex justify-between items-center w-full">
                                 <p class="text-gray-400 text-sm">Completed</p>
                                 <x-lucide-check-circle-2 class="h-5 w-5 shrink-0 text-indigo-400" />

                             </div>
                            <p class="text-3xl font-bold text-gray-200">{{ $completedTask ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                </div>  

                <div class="flex gap-6 w-full">
                    <div class="bg-gray-800 border-2 border-gray-700 rounded-lg p-6 w-full">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-200">Assigned Tasks</h2>
                            <h4 class="text-gray-400 mb-6">Your current repair and maintenance tasks</h4>
                            <div class="flex flex-col gap-2">
                                @foreach ($assignedTask as $ass)
                                    
                                <div class="border border-gray-700 rounded-md p-6">
                                    <div class="flex justify-end ">
                                        <span class="text-gray-400 text-sm">{{$ass->created_at}}</span>
                                    </div>

                                    <div class="flex flex-col">
                                        <span class="text-gray-300 font-bold text-md">{{$ass->equipment}}</span>
                                        <span class="text-gray-400 text-sm">{{$ass->id}}</span>
                                        <span class="text-gray-300 text-sm">{{$ass->issue}}</span>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <div class="bg-gray-800 border-2 border-gray-700 rounded-lg p-6 w-full">
                        <h2 class="text-2xl font-semibold text-gray-200">Pending Maintenance</h2>
                        <h4 class="text-gray-400 mb-4">Pending request waiting to be fix</h4>

                        <div class="flex flex-col gap-4">
                            @foreach ($pendingRequest as $pend)
                            <form action="{{url('/accept', $pend->id)}}" method="post">
                                @csrf
                            <div class="border-b border-gray-700 py-4">
                                <div class="flex justify-between text-gray-300 font-semibold text-md">
                                    <span>{{$pend->equipment}}</span>
                                    <span>{{$pend->created_at}}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex flex-col text-gray-400 text-sm">
                                        <span>{{$pend->issue}}</span>
                                        <span></span>{{$pend->id}}</span>
                                    </div>
                                    <button class="text-gray-300 text-sm bg-indigo-500 px-4 py-1 rounded-md">Accept</button>
                                </div>
                            </div>
                        </form>
                            @endforeach

                           
                        </div>
                    </div>
                </div>
               @endif

            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@29.3.5/styles/ag-grid.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@29.3.5/styles/ag-theme-alpine.css" />
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community@29.3.5/dist/ag-grid-community.min.js"></script> 
<script>
     setTimeout(() => {
            const alertBox = document.getElementById('successAlert');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // remove after fade-out
            }
        }, 3000); // 3 seconds

        const ctx = document.getElementById('locationChart').getContext('2d');
        const locationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Number of Equipment',
                    data: {!! json_encode($counts) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ddd'
                        },
                        grid: {
                            color: '#444'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#ddd'
                        },
                        grid: {
                            color: '#444'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#ccc'
                        }
                    }
                }
            }
        });
        

        

</script>
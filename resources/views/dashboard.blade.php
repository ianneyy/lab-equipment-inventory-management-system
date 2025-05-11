
<x-app-layout>
@include('layouts.sidebar')

    <div class="py-12 px-10 flex-1">
        <div class="w-full px-4 ">
         {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
            {{-- <div class="p-6 bg-white border-b border-gray-200"> --}}
               <h2 class="text-3xl font-semibold text-gray-200">{{ucwords(auth()->user()->roles)}} Dashboard</h2>
               <h4 class="text-gray-400 mb-6">Welcome back, {{ucwords(auth()->user()->name)}}</h4>

               @if (session('success'))
                <div id="successAlert" role="alert" class="alert alert-success mb-6 transition-opacity duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
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


               @if (auth()->check() && auth()->user()->roles === 'student')
               <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-8">
                <!-- Total Equipment Card -->
                <div class="bg-gray-800 rounded-lg p-6 border-2 border-gray-700 w-full sm:w-1/2 lg:w-1/4">
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

               <div class="flex flex-wrap gap-6">
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden w-full lg:w-1/2">
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
               </div>

               <div class="bg-gray-800 rounded-lg border-2 border-gray-700 overflow-hidden">
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
                    <div class="flex px-4 mt-10 space-x-2">
                        <span @click="tab = 'active'" :class="tab === 'active' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Active Borrowings</span>
                        <span @click="tab = 'pending'" :class="tab === 'pending' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Pending Requests</span>
                        <span @click="tab = 'repair'" :class="tab === 'repair' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Repair Requests</span>
                        <span @click="tab = 'history'" :class="tab === 'history' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Borrowing History</span>
                        
                    </div>

                    <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-5 rounded-lg">
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

            </div>
        </div>
    </div>
</x-app-layout>

<script>
     setTimeout(() => {
            const alertBox = document.getElementById('successAlert');
            if (alertBox) {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // remove after fade-out
            }
        }, 3000); // 3 seconds
</script>
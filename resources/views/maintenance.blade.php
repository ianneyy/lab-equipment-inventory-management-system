<x-app-layout>

@include('layouts.sidebar')


    <div class="py-12 px-2 lg:px-10 flex-1">
        <div class="w-full px-4 ">
            
         <div class="bg-gray-900 overflow-hidden  shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between mb-6">
                <div class="flex flex-col">
                    <h2 class="text-3xl font-semibold text-gray-200">Maintenance Management</h2>
                    <h4 class="text-gray-400">Track and manage equipment maintenance and repair requests</h4>
                </div>
                <button class="bg-indigo-400 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50">
                    <x-heroicon-o-plus class="h-4 w-4"/>
                    New Request</button>
            </div>
             @if (session('success'))
                <div id="successAlert" role="alert" class="alert alert-success mb-6 transition-opacity duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
                </div>
                @endif

            <div class="flex flex-wrap lg:flex-nowrap gap-6 mb-8">

                   <!-- Total Equipment Card -->
                   <div class="bg-gray-800 rounded-lg p-6 border-2 border-gray-700 w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                           
                           <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Total Requests</p>
                                    <x-hugeicons-return-request class="h-5 w-5 shrink-0 text-indigo-400"  />
                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $countRequest ?? 0 }}</p>
                           </div>
                       </div>
                   </div>

                   <!-- Active Borrowings Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
            
                           <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Available Technician</p>
                                    <x-fontisto-person class="h-5 w-5 shrink-0 text-indigo-400" />

                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $countTechnician ?? 0 }}</p>
                           </div>
                       </div>
                   </div>
                  
                   <!-- Maintenance Requests Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                            <div class="flex flex-col w-full gap-3">
                                 <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Pending</p>
                                    
                                    <x-lucide-drill class="h-5 w-5 shrink-0 text-indigo-400" />
                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $countPending ?? 0 }}</p>
                           </div>
                       </div>
                   </div>

                   <!-- Total Rooms Card -->
                   <div class="bg-gray-800 rounded-lg border-2 border-gray-700 p-6  w-full sm:w-1/2 lg:w-1/4">
                       <div class="flex items-center">
                            <div class="flex flex-col w-full gap-3">
                                <div class="flex justify-between items-center w-full">
                                    <p class="text-gray-400 text-sm">Completed</p>
                                    <x-lucide-check class="h-5 w-5 shrink-0 text-indigo-400" />

                                </div>
                               <p class="text-3xl font-bold text-gray-200">{{ $countCompleted ?? 0 }}</p>
                           </div>
                       </div>
                   </div>
            </div>
              
            <div x-data="{ tab: 'all' }">
                <div class="flex px-4 mt-10 space-x-2">
                    <span @click="tab = 'all'" :class="tab === 'all' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">All</span>
                    <span @click="tab = 'pending'" :class="tab === 'pending' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Pending</span>
                    <span @click="tab = 'inprogress'" :class="tab === 'inprogress' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">In Progress</span>
                    <span @click="tab = 'requests'" :class="tab === 'requests' ? 'text-white bg-gray-800' : 'text-gray-400'" class="px-4 py-2 rounded-md cursor-pointer text-sm">Completed</span>
                </div>

                <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-5 rounded-lg">
                    <div x-show="tab === 'all'"  style="display: none;">
                        @include('components.maintenance.all')
                    </div>
                    <template x-if="tab === 'pending'">
                        @include('components.maintenance.pending')
                    </template>
                    <template x-if="tab === 'inprogress'">
                        @include('components.maintenance.inprogress')
                    </template>
                    <template x-if="tab === 'requests'">
                        @include('components.maintenance.completed')
                    </template>
                </div>
            </div>
         </div>
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

    document.addEventListener('DOMContentLoaded', () => {
        const rowData = JSON.parse('{!! $maintenanceJson !!}');
        
        const columnDefs = [
            { field: "id", headerName: "Request ID",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            
            { field: "issue",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "date_reported", headerName: "Date Reported",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "tech_assigned", headerName: "Technician Assigned",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
             { field: "status",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
             

           
        ];

        const gridOptions = {
            columnDefs: columnDefs,
            rowData: rowData,
            domLayout: 'autoHeight',
            rowHeight: 64,
            defaultColDef: {
                resizable: true,
                flex: 1,
                sortable: true,
                filter: true,
            
            },
            pagination: true,
            paginationPageSize: 10,
            
        };
        document.getElementById('quickFilterInput').addEventListener('input', function () {
            gridOptions.api.setQuickFilter(this.value);
            });
        const gridDiv = document.querySelector('#myGrid');
        console.log('Grid Div:', gridDiv);
        
        // Create the grid
        const grid = new agGrid.Grid(gridDiv, gridOptions);


       
    });
     function removeUser(id) {
        console.log("Remove");
        if (confirm("Are you sure you want to remove this user?")) {
            fetch(`/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('User removed successfully');
                    location.reload(); // or remove from grid dynamically
                } else {
                    alert('Failed to remove user');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>

<style>
    .ag-theme-alpine .ag-row {
        border-bottom: none !important;
    background-color: #1f2937 !important; /* Tailwind's bg-gray-800 */
    color: #f9fafb !important; /* Tailwind's text-gray-100 */
}
    .ag-theme-alpine {
        --ag-selected-row-background-color: #374151;
        --ag-background-color: #1f2937; /* Tailwind's gray-900 */
        --ag-foreground-color: #f3f4f6; /* Tailwind's gray-100 */
        --ag-header-background-color: #111827; /* darker for header */
        --ag-row-hover-color: #374151; /* Tailwind gray-700 for hover */
        --ag-border-color: #4b5563; /* Tailwind gray-600 */
    }
</style>



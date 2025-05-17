<x-app-layout>
    @include('layouts.sidebar')

    <div class="py-12  flex-1 px-2 lg:px-10" x-data="{ tab: 'list' }">
        <div class="w-full px-4">
            @if ($errors->any())
    <div class="mb-4 p-4 bg-red-600 text-white rounded">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div x-show="tab === 'add'" x-transition>
                    @include('components.user.add')
                </div>
                <div x-show="tab === 'list'" x-transition>

                <div class="flex items-center justify-between p-6">
                    <div class="flex flex-col">
                        <h2 class="text-xl lg:text-3xl font-semibold text-gray-200">User Management</h2>
                        <h4 class="text-sm lg:text-base text-gray-400">Manage system users and their access permissions</h4>
                    </div>

                    <button @click="tab = 'add'" class="text-xs lg:text-base bg-indigo-400 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50">
                        <x-heroicon-o-plus class="h-4 w-4" />
                        Add
                    </button>
                </div>

                <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-4 rounded-lg">
    
                    
                        <h2 class="text-lg lg:text-2xl font-semibold text-gray-200 mb-6">System Users</h2>
                        <input type="text" id="quickFilterInput" placeholder="Search by ID, name, or serial number..." class="mb-4 p-2 rounded bg-gray-800 text-gray-300 border border-gray-700 w-3/4">
                        <div id="myGrid" class="ag-theme-alpine bg-gray-900"></div>
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
     
    document.addEventListener('DOMContentLoaded', () => {
        const rowData = JSON.parse('{!! $usersJson !!}');
        
        const columnDefs = [
            { field: "id", headerName: "Equipment ID",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            
            { field: "name",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "email",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "roles",
             headerName: "Role",

             cellRenderer: function(params) {
                const baseClass = "px-2 py-1 rounded text-sm font-semibold";
                const role = params.value;
                let style = "bg-gray-700 text-gray-300";
                  if (role === "admin") {
                    style = "bg-indigo-500 text-white";
                } else if (role === "student") {
                    style = "bg-gray-500 text-white";
                }

                return `<span class="${baseClass} ${style}">${role}</span>`;
                },
                // cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
            
                // cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                // headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
             {
                headerName: "Action",
                field: "id",
                cellRenderer: function(params) {
                    return `
                     <div class="flex gap-2 justify-center items-center h-full">
                        <button  onclick="editUser('${params.value}')" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-sm">Edit</button>
                        <button onclick="removeUser('${params.value}')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Remove</button>
                    </div>
                    
                    `;
                },
                cellClass: 'text-center',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 text-center',
                width: 130,
                sortable: false,
                filter: false
            }

           
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



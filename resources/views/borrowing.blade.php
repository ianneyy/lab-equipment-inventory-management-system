<x-app-layout>

@include('layouts.sidebar')

    <div class="py-12 px-2 lg:px-10 flex-1">
        <div class="w-full px-4 ">
         <div class="bg-gray-900 overflow-hidden  shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="text-3xl font-semibold text-gray-200">Borrowing Management</h2>
                    <h4 class="text-gray-400">Manage equipment borrowing requests and returns</h4>
                </div>
                <button class="bg-indigo-400 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50">
                    <x-heroicon-o-plus class="h-4 w-4"/>
                    New Request</button>
            </div>
            <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-10 rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-200 mb-6">Borrowing Requests</h2>
                <input type="text" id="quickFilterInput" placeholder="Search by ID, borrower, or equipment..." class="mb-4 p-2 rounded bg-gray-800 text-gray-300 border border-gray-700 w-3/4">
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
        const rowData = JSON.parse('{!! $borrowingJson !!}');
        
        const columnDefs = [
            { field: "id", headerName: "Request ID",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            
            { field: "borrower",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "equipment",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "borrowed_date", headerName: "Borrow Date",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
              { field: "return_date", headerName: "Return Date",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },

              { field: "status", headerName: "Status",
              cellRenderer: function(params) {
                const baseClass = "px-2 py-1 rounded text-sm font-semibold";
                const status = params.value;
                let style = "bg-gray-700 text-gray-300";
                  if (status === "Rejected") {
                    style = "bg-red-500 text-white";
                } else if (status === "Approved") {
                    style = "bg-green-500 text-white";
                }

                return `<span class="${baseClass} ${style}">${status}</span>`;
                },
                // cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },

             {
                headerName: "Action",
                field: "id",
                cellRenderer: function(params) {
                    if (params.data.status === 'Rejected' || params.data.status === 'Returned') {
                        return '';  // Don't show any icons if the status is "Rejected"
                    }
                    if (params.data.status === 'Approved' || params.data.status === 'Overdue') {
                        return `
                        <div class="flex gap-3 justify-center items-center h-full">
                        <x-hugeicons-delivery-return-01  onclick="returned('${params.value}')" class="w-5 h-5 text-indigo-500 cursor-pointer  hover:text-indigo-300" />
                        </div>
                        `;  
                    }
                    if (params.data.status === 'Pending') {
                        return `
                        <div class="flex gap-3 justify-center items-center h-full">
                         <x-lucide-check onclick="approve('${params.value}')" class="w-5 h-5 text-gray-200 text-green-500 cursor-pointer hover:text-green-300"  />
                        <x-lucide-x onclick="reject('${params.value}')" class="w-5 h-5 text-red-500 cursor-pointer  hover:text-red-300"  />
                        </div>
                        `;  
                    }
                    return `
                    
                     <div class="flex gap-3 justify-center items-center h-full">
                        <x-lucide-check  onclick="approve('${params.value}')" class="w-5 h-5 text-gray-200 text-green-500 cursor-pointer hover:text-green-300"  />
                        <x-lucide-x onclick="reject('${params.value}')" class="w-5 h-5 text-red-500 cursor-pointer  hover:text-red-300"  />
                        <x-hugeicons-delivery-return-01  onclick="returned('${params.value}')" class="w-5 h-5 text-indigo-500 cursor-pointer  hover:text-indigo-300" />
                       
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
                filter: true
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
     function reject(id) {
        if (confirm("Are you sure you want to reject this user?")) {
            fetch(`/reject/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('User rejected successfully');
                    location.reload(); // or remove from grid dynamically
                } else {
                    alert('Failed to reject user');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }

      function returned(id) {
        if (confirm("Are you sure you want to marked as returned this user?")) {
            fetch(`/returned/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('User marked as returned successfully');
                    location.reload(); // or remove from grid dynamically
                } else {
                    alert('Failed to marked as returned');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
      function approve(id) {
        if (confirm("Are you sure you want to approved this user?")) {
            fetch(`/approve/${id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    alert('User approved successfully');
                    location.reload(); // or remove from grid dynamically
                } else {
                    alert('Failed to approve user');
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



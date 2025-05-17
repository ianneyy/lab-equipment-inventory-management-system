<x-app-layout>

@include('layouts.sidebar')

    <div class="py-12 px-2 lg:px-10 flex-1">
        <div class="w-full px-4 ">
         <div class="bg-gray-900 overflow-hidden  shadow-sm sm:rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h2 class="text-lg lg:text-3xl font-semibold text-gray-200">Equipment Inventory</h2>
                    <h4 class="text-sm lg:text-base text-gray-400">Manage and track all equipment in the system</h4>
                </div>
                <button class="bg-indigo-400 px-2 py-1 lg:px-4 lg:py-2  flex items-center gap-3 rounded-md text-gray-50 text-xs lg:text-lg ">
                    <x-heroicon-o-plus class="h-4 w-4"/>
                    Add Equipment</button>
            </div>

            <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-10 rounded-lg">
                <h2 class="text-lg lg:text-2xl font-semibold text-gray-200 mb-6">Equipment List</h2>
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
        const rowData = JSON.parse('{!! $equipmentJson !!}');
        console.log('Equipment Data:', rowData);
        
        const columnDefs = [
            { field: "id", headerName: "Equipment ID",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            
            { field: "name",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "description",
                cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "srn", headerName: "Serial Number",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "acq", headerName: "Acquisition Date",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800',
             },
            { field: "cost", headerName: "Cost",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800',
             },
            { field: "supp_info", headerName: "Supplier Information",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
             },
            { field: "room_name", headerName: "Room Located",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800',
             },
            { field: "status",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800',
             },
            { field: "condition",
                cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800',
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
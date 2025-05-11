<x-app-layout>

    @include('layouts.sidebar')
    
    
        <div class="py-12 px-10 flex-1">
            <div class="w-full px-4 ">
                
             <div class="bg-gray-900 overflow-hidden  shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex flex-col">
                        <h2 class="text-3xl font-semibold text-gray-200">Reports</h2>
                        <h4 class="text-gray-400">Generate and view system reports</h4>
                    </div>
                    <div class="flex gap-4">
                        <button class="border-2 border-indigo-500 hover:bg-indigo-500 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50 text-sm">
                            <x-lucide-printer class="h-4 w-4"/>
                            Print
                        </button>
                            <button class="border-2 border-indigo-500 hover:bg-indigo-500 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50 text-sm">
                            <x-lucide-download class="h-4 w-4"/>
                            Export
                        </button>
                    </div>
                </div>
                <div class="flex gap-4 w-full">

            
                    <div class="w-50" >
                        <button popovertarget="cally-popover1" class="input input-border border-2 border-gray-700 text-indigo-500 text-sm" id="cally1" style="anchor-name:--cally1">
                            <x-lucide-calendar class="h-4 w-4 ml-5"/>
                            <span id="cally1-date-text">Pick a date</span>
                        </button>
                        
                        <div popover id="cally-popover1" class="dropdown bg-gray-600 rounded-box shadow-lg text-gray-200" style="position-anchor:--cally1">
                            <calendar-date class="cally" id="cally-date">
                            <svg aria-label="Previous" class="fill-current size-4" slot="previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
                            <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m8.25 4.5 7.5 7.5-7.5 7.5"></path></svg>
                            <calendar-month></calendar-month>
                            </calendar-date>
                        </div>
                    </div>

                    <button class="bg-indigo-500 px-4 py-2 flex items-center gap-3 rounded-md text-gray-50 text-sm">
                        
                        Generate Report
                    </button>
                </div>
                
                   
                    <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-10 rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-200 mb-6">Audit and Logs</h2>
                        <input type="text" id="quickFilterInput" placeholder="Search by ID, name, or serial number..." class="mb-4 p-2 rounded bg-gray-800 text-gray-300 border border-gray-700 w-3/4">
                        <div id="myGrid" class="ag-theme-alpine bg-gray-900"></div>
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
           const rowData = JSON.parse('{!! $auditsJson !!}');
           console.log(rowData);
           const columnDefs = [
               { field: "id", headerName: "Log ID",
                   cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                   headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
               
                { field: "event", headerName: "Events",
                   cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                   headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
               { field: "user", headerName: "User",
                   cellClass: 'text-gray-300 font-medium  whitespace-nowrap',
                   headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
              
                { field: "user_role", headerName: "User Role",


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
                //    cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                //    headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
                
                {
                   field: "old_values",headerName: "Old Value",
                   valueGetter: params => params.data.old_values?.status ?? '—',
                   cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                   headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
                { field: "new_values", headerName: "New Value",
                valueGetter: params => params.data.new_values?.status ?? '—',
                   cellClass: 'text-gray-300 font-medium whitespace-nowrap',
                   headerClass: 'text-gray-400 uppercase text-xs font-medium bg-gray-800 ',
                },
    
                { field: "created_at",
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
   


           const calendar = document.getElementById("cally-date");
            const dateText = document.getElementById("cally1-date-text");
            const popover = document.getElementById("cally-popover1");

            calendar.addEventListener("change", function (event) {
            const selectedDate = event.target.value;
            // If the calendar component emits a `value` that’s a Date object or string
            if (selectedDate) {
                const formattedDate = new Date(selectedDate).toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
                });

                dateText.textContent = formattedDate;
                if (popover && typeof popover.hidePopover === "function") {
                popover.hidePopover();
                } else {
                popover.removeAttribute("popover"); // Fallback for some implementations
                }
            }
            });
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
   
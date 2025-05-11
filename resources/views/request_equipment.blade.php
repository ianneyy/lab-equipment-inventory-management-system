<x-app-layout>

    @include('layouts.sidebar')
    
        <div class="py-12 px-10 flex-1">
            <div class="w-full px-4 ">
             <div class="bg-gray-900 overflow-hidden  shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex flex-col">
                        <h2 class="text-3xl font-semibold text-gray-200">
                            Request Equipment Borrowing</h2>
                        <h4 class="text-gray-400">Submit a request to borrow equipment for your academic needs</h4>
                    </div>
                    
                </div>

                @if (session('success'))
                <div id="successAlert" role="alert" class="alert alert-success mb-6 transition-opacity duration-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
                </div>
                @endif
                <div class="flex justify-between mt-10">
                    <div class="flex gap-4">
                        <div class="flex text-center justify-center items-center bg-indigo-500 rounded-full h-10 w-10 text-gray-200">1</div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-300">Select Equipment</span>
                            <span class="text-sm text-gray-500">Choose the equipment you need</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        @if(isset($selectedEquipment)|| isset($borrowedEquipment))

                        <div class="flex text-center justify-center items-center bg-indigo-500 rounded-full h-10 w-10 text-gray-200">2</div>
                        @else
                        <div class="flex text-center justify-center items-center border-2 border-indigo-500 rounded-full h-10 w-10 text-gray-200">2</div>
                        @endif

                        <div class="flex flex-col">
                            <span class="text-sm text-gray-300">Borrowing Details</span>
                            <span class="text-sm text-gray-500">Provide borrowing information</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        @if(isset($borrowedEquipment))
                        <div class="flex text-center justify-center items-center bg-indigo-500 rounded-full h-10 w-10 text-gray-200">3</div>
                        @else
                        <div class="flex text-center justify-center items-center border-2 border-indigo-500 rounded-full h-10 w-10 text-gray-200">3</div>
                        @endif
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-300">Review & Submit</span>
                            <span class="text-sm text-gray-500">Confirm your request</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-800 border-2 border-gray-700 h-auto mt-10 rounded-lg">
                    @if(!isset($selectedEquipment) && !isset($borrowedEquipment))
                    <h2 class="text-2xl font-semibold text-gray-200">Select Equipment</h2>
                    <h4 class="text-gray-400 mb-6">Browse and select the equipment you want to borrow</h4>

                    <div class="flex justify-between gap-6">
                        <label class="input w-full bg-gray-800 border-2 border-gray-700 rounded-md focus-within:border-indigo-500 transition-colors duration-200">
                            <svg class="h-[1em] opacity-50 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g
                                stroke-linejoin="round"
                                stroke-linecap="round"
                                stroke-width="2.5"
                                fill="none"
                                stroke="currentColor"
                            >
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </g>
                            </svg>
                            <input type="search" class="grow text-gray-200 focus:text-white outline-none" placeholder="Search" />
                           
                        </label>
                        <div class="flex gap-2">

                            <div class="dropdown dropdown-bottom dropdown-end ">
                                <div tabindex="0" role="button" class="btn bg-gray-800 shadow-none text-sm border-2 border-gray-700  w-50 text-gray-300">All Categories <x-eva-arrow-ios-downward-outline class="ml-2 h-5 w-5 shrink-0 text-indigo-400" /> </div>   
                                <ul tabindex="0" class="dropdown-content menu bg-gray-500 rounded-box z-1 w-52 p-2 shadow-sm">
                                <li><a>Item 1</a></li>
                                <li><a>Item 2</a></li>
                                </ul>
                            </div>
                            <div class="flex items-center border-2 border-gray-700 p-2 rounded-md">
                                <x-lucide-filter class="h-5 w-5 shrink-0 text-indigo-400 cursor-pointer"/>
                            </div>
                        </div>
                    </div>
                    
                    <form
                    x-data="{ loading: false }" 
                    x-on:submit="loading = true" 
                     action="{{route('borrowing.details')}}" method="post">
                        <div class="mt-10 flex gap-4 flex-wrap">
                            @csrf
                            @foreach ($equipment as $item)
                            @php
                                $status = strtolower($item->status);
                                $badgeClass = match ($status) {
                                    'available' => 'badge-success',
                                    'in use' => 'badge-warning',
                                    'maintenance' => 'badge-info',
                                    default => 'badge-secondary',
                                };
                            @endphp
                            
                            <label class="relative block w-100">
                            <input type="checkbox" class="checkbox checkbox-primary peer absolute top-2 left-2 z-10 p-1 text-gray-300 text-xs" name="equipment_ids[]" value="{{ $item->id }}" />
                            <div class="flex border-2 border-indigo-900 rounded-lg p-4 gap-3 cursor-pointer hover:shadow-md transition-all relative peer-checked:border-blue-500">
                                
                            
                                <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center ml-6">
                                <!-- Placeholder for image -->
                                <span class="text-gray-400 text-sm">IMG</span>
                                </div>
                            
                                <div class="flex flex-col text-sm ml-2">
                                    <span class="font-semibold text-gray-300">{{$item->name}}</span>
                                    <span class="text-xs text-gray-500">{{$item->id}}</span>
                                
                                    <div class="flex flex-col gap-y-1 mt-2 text-xs">
                                        <div class="text-gray-500">Category:<span class="text-gray-300"> {{$item->description}}</span></div>
                                        <div class="text-gray-500">Location:<span class="text-gray-300"> {{$item->room_name}}</span></div>
                                        <div class="flex items-center gap-1">
                                        <span class="text-gray-500">Status:</span>
                                        <span class="badge {{ $badgeClass }} badge-sm">{{$item->status}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </label>
                            @endforeach
                    </div>

                    <div class="w-full flex justify-end mt-10">
                        

                        <button 
           
                        x-bind:disabled="loading"
                        type="submit"
                        class="bg-indigo-500 text-gray-200 rounded-lg px-6 py-2 text-sm hover:bg-indigo-400 flex items-center gap-2">
            
                        <svg x-show="loading" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
            
                        <span x-show="!loading">Borrow</span>
                        <span x-show="loading">Processing...</span>
                    </button>
                    </div>
                </form>
                @endif

                @if(isset($selectedEquipment))

                @include('components.borrowing.details')
                @endif

                @if (isset($borrowedEquipment))
                @include('components.borrowing.submit')
                
                @endif
                </div>
               
             </div>
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
         document.addEventListener('DOMContentLoaded', () => {

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
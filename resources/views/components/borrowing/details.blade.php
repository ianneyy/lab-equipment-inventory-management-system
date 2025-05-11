<div>
    <h2 class="text-2xl font-semibold text-gray-200">Borrowing Details</h2>
    <h4 class="text-gray-400 mb-6">Provide information about your borrowing request</h4>
    <form 
    x-data="{ loading: false }" 
    x-on:submit="loading = true" 
    action="{{route('borrowing.submit')}}" method="post">
        @csrf
    <div class="flex justify-between">
        <div class="w-full flex gap-6">
            <div class="w-full flex flex-col ">
                <div>
                    <label class="fieldset-legend text-gray-200 text-sm">Student ID Number</label>
                    <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full" class="bg-gray-800" placeholder="eg. 0322-0001" name="student_id"/>
                </div>
                <div>
                    <label class="fieldset-legend text-gray-200 text-sm">Name</label>
                    <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-white" placeholder="eg. Gideon Alcantanga"  value="{{$user->name}}" name="name"/>
                </div>
                <div>
                    <label class="fieldset-legend text-gray-200 text-sm">Return Date</label>
                    <button type="button" popovertarget="cally-popover1" class="input input-border border-2 border-gray-700 text-indigo-500 text-sm w-full shadow-none" id="cally1" style="anchor-name:--cally1">
                        <x-lucide-calendar class="h-4 w-4 ml-5"/>
                        <span id="cally1-date-text">Pick a date</span>
                    </button>
                    <input name="return_date" id="selected-date" value="" class="hidden">

                    <div popover id="cally-popover1" class="dropdown dropdown-top bg-gray-600 rounded-box shadow-lg text-gray-200" style="position-anchor:--cally1">
                        <calendar-date class="cally" id="cally-date">
                        <svg aria-label="Previous" class="fill-current size-4" slot="previous" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
                        <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="m8.25 4.5 7.5 7.5-7.5 7.5"></path></svg>
                        <calendar-month></calendar-month>
                        </calendar-date>
                    </div>
                </div>
            </div>
            
            <div class="w-full">
            
                <div>
                    <label class="fieldset-legend text-gray-200 text-sm">Purpose of Borrowing</label>
                    <textarea type="textarea" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 pt-3  h-45 w-full" placeholder="Why do you want to borrow it?" name="purpose"></textarea>
                </div>
            </div>
        </div>
        @foreach ($selectedEquipment as $selected)
        <input value="{{$selected->id}}" name="selected[]" class="hidden">
            {{-- <span>{{$selected->id}}</span> --}}
        @endforeach
       

    </div>
    <div class="w-full flex justify-between mt-10"> 
        <button class=" text-gray-200 rounded-lg px-6 py-2 text-sm hover:bg-indigo-400">Back</button>
        <button 
           
            x-bind:disabled="loading"
            type="submit"
            class="bg-indigo-500 text-gray-200 rounded-lg px-6 py-2 text-sm hover:bg-indigo-400 flex items-center gap-2">

            <svg x-show="loading" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>

            <span x-show="!loading">Next</span>
            <span x-show="loading">Processing...</span>
        </button>
    </div>
    </form>
</div>

<script>
    // Assuming the date picker fires an event when a date is selected
    document.getElementById('cally-date').addEventListener('change', function(e) {
        // Capture the selected date (you can adjust this to get the actual value from your calendar component)
        var selectedDate = e.target.value;

        // Set the hidden input field with the selected date
        document.getElementById('selected-date').value = selectedDate;

        // Optionally update the text on the button with the selected date
        document.getElementById('cally1-date-text').innerText = selectedDate;
    });
</script>
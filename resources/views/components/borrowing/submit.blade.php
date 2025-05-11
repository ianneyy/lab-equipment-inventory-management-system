<div>
    <h2 class="text-2xl font-semibold text-gray-200">Review & Submit</h2>
    <h4 class="text-gray-400 mb-6">Review your borrowing request before submittin</h4>
    <form 
    x-data="{ loading: false }" 
    x-on:submit="loading = true" 
    action="{{route('borrowing.request')}}" method="post">
        @csrf
    <div class="flex gap-20 justify-between  mt-10">
        <div class="w-full">
            <h2 class="text-gray-300 text-lg">Selected Equipment</h2>
            @foreach ($borrowedEquipment as $borrowed)
                
            <div class="p-4 flex rounded-md border border-indigo-900 w-full mt-4 ">
                <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                    <!-- Placeholder for image -->
                    <span class="text-gray-400 text-sm">IMG</span>
                </div>

                <div class="flex flex-col ml-2">
                    <span class="text-gray-300">{{$borrowed->name}}</span>
                    <input type="text" name="equipment[]" value="{{$borrowed->name}}" class="hidden">
                    <span class="text-gray-500">{{$borrowed->id}}</span>
                    <span class="text-gray-500">{{$borrowed->room_name}}</span>
                </div>
            </div>
            @endforeach

        </div>
        <div class="w-full">
            <h2 class="text-gray-300 text-lg mb-6">Borrowing Details</h2>
            <div class="flex justify-between pr-20">

            <div>
                <div class="flex flex-col mt-4">
                    <span class="text-gray-500">Student ID</span>
                    <span class="text-gray-300">{{$student_id}}</span>
                </div>
                <div class="flex flex-col mt-4">
                    <span class="text-gray-500">Name</span>
                    <span class="text-gray-300">{{$user->name}}</span>
                    <input type="text" name="borrower" value="{{$user->name}}" class="hidden">

                </div>
                <div class="flex flex-col mt-4">
                    <span class="text-gray-500">Purpose</span>
                    <span class="text-gray-300">{{$purpose}}</span>
                </div>
            </div>
            <div>
                <div class="flex flex-col mt-4">
                    <span class="text-gray-500">Return Date</span>
                    <span class="text-gray-300">{{$return_date}}</span>
                    <input type="text" name="return_date" value="{{$return_date}}" class="hidden">

                </div>
                <div class="flex flex-col mt-4">
                    <span class="text-gray-500">Borrow Date</span>
                    <span class="text-gray-300">{{$today}}</span>
                    <input type="text" name="borrowed_date" value="{{$today}}" class="hidden">

                </div>
            </div>
        </div>


        </div>
    </div>

    <hr class="mt-6 border border-gray-700">

    <div class="mt-6">
        <h2 class="text-gray-300 text-xl">Terms & Conditions</h2>
        <div class="mt-6">
            <span class="text-gray-300">By submitting this request, you agree to:</span>
            <div class="flex flex-col gap-2 mt-4 px-4">
                <span class="text-gray-400">Return the equipment in the same condition as when borrowed</span>
                <span class="text-gray-400">Return the equipment on or before the agreed return date</span>
                <span class="text-gray-400">Use the equipment only for the stated academic purpose</span>
                <span class="text-gray-400" >Be responsible for any damage or loss that occurs while the equipment is in your possession</span>
            </div>
            <div class="flex gap-4 mt-4 items-center">
                <input type="checkbox" class="checkbox checkbox-primary p-1 text-gray-300 border border-indigo-500 h-5 w-5 rounded-md" />
                <span class="text-gray-300">I agree to the terms and conditions for borrowing equipment</span>
            </div>
        </div>
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

            <span x-show="!loading">Submit Request</span>
            <span x-show="loading">Submitting...</span>
        </button>

    </div>
    </form>
</div>
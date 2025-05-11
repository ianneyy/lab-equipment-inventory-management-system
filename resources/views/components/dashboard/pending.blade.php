<div>
    <h2 class="text-2xl font-semibold text-gray-200">Pending Requests</h2>
    <h4 class="text-gray-400 mb-6">Borrowing requests awaiting approval</h4>

    @foreach ($pendingBorrowing as $pending)

    <div class="w-full flex justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
        <div class="flex flex-col">
            <span class="text-lg text-gray-200 font-semibold">{{ $pending->equipment ?? "Dell" }}</span>
            <span class="mb-2 text-gray-400">Request ID: {{ $pending->id ?? "1" }}</span>
            <div class="flex gap-4">
                <div class="flex flex-col text-sm">
                    <span class="text-gray-300">Return Date: {{ $pending->return_date ?? " 2023-05-20" }}</span>
                    <span class="text-gray-300">Borrow Date: {{ $pending->borrowed_date ?? "2023-05-20" }}</span>
                </div>
                
            </div>

        </div>
        <div class=" flex items-center">
            <span class="text-white badge badge-warning p-4">Awaiting Approval</span> 
        </div>
    </div>
    @endforeach

</div>
<div>
    <h2 class="text-2xl font-semibold text-gray-200">Borrowing History</h2>
    <h4 class="text-gray-400 mb-6">Record of your past equipment borrowings</h4>
    @foreach ($returnedBorrowing as $returned)

    <div class="w-full flex justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
        <div class="flex flex-col">
            <span class="text-lg text-gray-200 font-semibold">{{ $returned->equipment ?? "Dell" }}</span>
            <span class="mb-2 text-gray-400">Request ID: {{ $returned->id ?? "1" }}</span>
            <div class="flex gap-4">
                <div class="flex flex-col text-sm">
                    <span class="text-gray-300">Return Date: {{ $returned->return_date ?? " 2023-05-20" }}</span>
                    <span class="text-gray-300">Borrow Date: {{ $returned->borrow_date ?? "2023-05-20" }}</span>
                </div>
                <div class="flex flex-col text-sm">
                    <span class="text-gray-300">Status: {{ $returned->issue ?? "Returned" }}</span>
                </div>
            </div>

        </div>
        <div class=" flex items-center text-center">
            <button onclick="window.location='{{ url('/request') }}'"
            " class="flex gap-2 bg-gray-800 border border-indigo-500 w-auto px-4 py-2 text-gray-100 rounded-md text-sm hover:bg-indigo-600">
            <x-lucide-history  class="h-5 w-5 shrink-0 text-indigo-400" />
                Borrow Again</button>
        </div>
    </div>
    @endforeach

</div>
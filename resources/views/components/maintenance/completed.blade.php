<div>
    <h2 class="text-2xl font-semibold text-gray-200">Completed Requests</h2>
    <h4 class="text-gray-400 mb-6">Maintenance requests that have been resolved</h4>
    @foreach ($completed as $c)
        <div class="w-full flex justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
            <div class="flex flex-col">
                <span class="text-lg text-gray-200 font-semibold">{{ $c->equipment }}</span>
                <span class="mb-2 text-gray-400">Request ID: {{ $c->id }}</span>
                <span class="text-gray-300">Issue: {{ $c->issue }}</span>
            <span class="text-gray-300">Date Reported: {{ $c->date_reported }}</span>
                <span class="text-gray-300">Technician: {{ $c->tech_assigned }}</span>
            </div>
            <div class=" flex items-center">
                <button class="bg-indigo-400 px-4 py-2 text-gray-100 rounded-lg text-sm hover:bg-indigo-600">{{ $c->updated_at }}</button>
            </div>
        </div>
        @endforeach
</div>
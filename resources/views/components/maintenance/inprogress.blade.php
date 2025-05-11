<div>
    <h2 class="text-2xl font-semibold text-gray-200">In Progress Requests</h2>
    <h4 class="text-gray-400 mb-6">Maintenance requests waiting to be assigned or started</h4>
        @foreach ($inprogress as $ip)
        <form action="{{ url('/complete', $ip->id) }}" method="POST" >
            @csrf
             @method('PUT')
        <div class="w-full flex justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
            <div class="flex flex-col">
                <span class="text-lg text-gray-200 font-semibold">{{ $ip->equipment }}</span>
                <span class="mb-2 text-gray-400">Request ID: {{ $ip->id }}</span>
                <span class="text-gray-300">Issue: {{ $ip->issue }}</span>
                <span class="text-gray-300">Assigned To: {{ $ip->tech_assigned }}</span>
            </div>
            <div class=" flex items-center">
                <button type="submit" class="bg-indigo-400 px-4 py-2 text-gray-100 rounded-lg text-sm hover:bg-indigo-600">Mark as Complete</button>
            </div>
        </div>
    </form>
        @endforeach

</div>
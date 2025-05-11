<div>
    <h2 class="text-2xl font-semibold text-gray-200">Pending Requests</h2>
    <h4 class="text-gray-400">Maintenance requests waiting to be assigned or started</h4>
    @foreach ($pending as $item)
  

    <div class="w-full flex justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
        <div class="flex flex-col">
            <span class="text-lg text-gray-200 font-semibold">{{ $item->equipment }}</span>
            <span class="mb-2 text-gray-400">Request ID: {{ $item->id }}</span>
            <span class="text-gray-300">Issue: {{ $item->issue }}</span>
            <span class="text-gray-300">Date Reported: {{ $item->date_reported }}</span>
        </div>
        <div class=" flex items-center">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button">
                <button class="bg-indigo-400 px-4 py-2 text-gray-100 rounded-lg text-sm hover:bg-indigo-600">Assign Technician</button>
            </div>
            <ul
                tabindex="0"
                class="menu menu-md dropdown-content bg-gray-700 text-gray-200 rounded-box z-1 mt-3 w-52 p-2 shadow mb-2">
                 @foreach ($technician as $tech)
                <li>
                    <form method="POST" action="{{ route('assign.technician',$item->id) }}">
                        @csrf
                        <input type="hidden" name="tech_name" value="{{ $tech->name }}" class="hidden">
                        <button type="submit" class="w-full text-left py-2">
                            {{ $loop->iteration }}. {{ $tech->name }}
                        </button>
    </form>

                </li>
                @endforeach
            </ul>
        </div>
        </div>
        
    </div>

    @endforeach
</div>
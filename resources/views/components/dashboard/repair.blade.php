<div>
    <h2 class="text-2xl font-semibold text-gray-200">Repair Requests</h2>
    <h4 class="text-gray-400 mb-6">Equipment repair requests and their status</h4>
    <div class="w-full flex flex-col sm:flex-row justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
        <div class="flex flex-col">
            <span class="text-lg text-gray-200 font-semibold">{{ $ip->equipment ?? "Dell" }}</span>
            <span class="mb-2 text-gray-400">Request ID: {{ $ip->id ?? "1" }}</span>
            <div class="flex gap-4 flex-col sm:flex-row">
                <div class="flex flex-col text-sm">
                    <span class="text-gray-300">Equipment ID: {{ $ip->tech_assigned ?? "153dt42" }}</span>
                    <span class="text-gray-300">Issue Type: {{ $ip->tech_assigned ?? " 2023-05-20" }}</span>
                </div>
                <div class="flex flex-col  text-sm">
                    <span class="text-gray-300">Request Date: {{ $ip->issue ?? "2023-05-20" }}</span>

                </div>
            </div>

        </div>
        <div class=" flex items-center text-center">
         <span class="text-gray-300">In Progress</span>
        </div>
</div>
</div>
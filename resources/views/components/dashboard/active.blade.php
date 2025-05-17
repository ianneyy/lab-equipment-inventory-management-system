<div>
    <h2 class="text-2xl font-semibold text-gray-200">Active Borrowings</h2>
    <h4 class="text-gray-400 mb-6">Equipment currently in your possession</h4>
    @foreach ($activeBorrowing as $active)
    <div class="w-full flex flex-col sm:flex-row justify-between gap-4 border-2 border-gray-700 rounded-lg mt-6 p-4">
        <div class="flex flex-col">
            <span class="text-lg text-gray-200 font-semibold">{{ $active->equipment ?? "Dell" }}</span>
            <span class="mb-2 text-gray-400">Request ID: {{ $active->id ?? "1" }}</span>
            <div class="flex gap-4 flex-col sm:flex-row" >
                <div class="flex flex-col  text-sm">
                    <span class="text-gray-300">Return Date: {{ $active->return_date ?? "2023-05-20" }}</span>
                    <span class="text-gray-300">Borrow Date: {{ $active->borrowed_date ?? "2023-05-20" }}</span>
                </div>
                <div class="flex flex-col  text-sm">
                    <span class="text-gray-300">Status: {{ $active->status ?? "Approved" }}</span>
                </div>
            </div>
            <div class="flex gap-4">
                <span class="text-gray-400">Days Remaining: </span>
                <span class="font-bold text-indigo-500">{{$remainingDays}}</span>
            </div>
        </div>
        <div class="flex items-center justify-end sm:justify-start">
            <button 
                onclick="openModal(this)"
                data-equipment="{{ $active->equipment }}"
                data-id="{{ $active->id }}"
                class="text-white px-4 py-2 rounded-md text-xs flex gap-2 items-center border border-gray-800 hover:border-red-500">
                <x-lucide-wrench class="h-5 w-5 shrink-0 text-red-500" /> Report Issue
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal Template -->
<dialog id="modal-template" class="modal">
  <div class="modal-box w-11/12 max-w-5xl bg-gray-800 border-2 border-gray-700">
    <form 
      x-data="{ loading: false }" 
      x-on:submit="loading = true" 
      action="{{route('submit-issue')}}" method="post">
      @csrf
      <h2 class="text-2xl font-semibold text-gray-200">Issue Details</h2>
      <h4 class="text-gray-400 mb-6">Borrowing requests awaiting approval</h4>
      <div class="flex gap-20 justify-between mt-10">
        <div class="w-full">
          <h2 class="text-gray-300 text-lg mb-10">Equipment to Report</h2>
          <div class="p-4 flex rounded-md border border-indigo-900 w-full mt-4">
            <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
              <span class="text-gray-400 text-sm">IMG</span>
            </div>
            <div class="flex flex-col ml-2">
              <span class="text-gray-300" id="equipmentName"></span>
              <span class="text-gray-500" id="requestId"></span>

              <input class="text-gray-300 hidden" id="equipmentNameValue" name="equipment" value=""></input>
              <input class="text-gray-300 hidden" id="requestIdValue" name="id" value=""></input>
            </div>
          </div>
        </div>

        <div class="w-full">
          <h2 class="text-gray-300 text-lg mb-5">Issue Information</h2>
          <div>
            <label class="fieldset-legend text-gray-400 text-sm">Detailed Description of the Issue</label>
            <textarea 
              class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 pt-3 h-45 w-full placeholder:whitespace-pre-wrap placeholder:break-words text-white" 
              placeholder="Please describe the problem in detail." name="issue"></textarea>
          </div>
        </div>
      </div>

      <div class="w-full flex justify-between mt-10"> 
            <!-- Back Button to Close the Dialog -->
            <button type="button" class="btn text-gray-200  rounded-lg px-6 py-2 text-sm hover:bg-indigo-400 shadow-none" onclick="closeModal()">Back</button>
        <button 
          x-bind:disabled="loading"
          type="submit"
          class="bg-indigo-500 text-gray-200 rounded-lg px-4 py-2 text-sm hover:bg-indigo-400 flex items-center gap-2">
          <svg x-show="loading" class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
          </svg>
          <span x-cloak ="!loading">Submit Repair Issue</span>
          <span x-show="loading">Processing...</span>
        </button>
      </div>
    </form>
  </div>
</dialog>

<script>
    // Function to open the modal and pass data
    function openModal(button) {
        const equipment = button.getAttribute('data-equipment');
        const id = button.getAttribute('data-id');
        
        // Create a unique modal ID based on the request ID
        const modalId = 'modal-' + id;
        let modal = document.getElementById(modalId);

        if (!modal) {
            // Clone the modal template if not yet created
            modal = document.getElementById('modal-template').cloneNode(true);
            modal.id = modalId;
            document.body.appendChild(modal);
        }

        // Fill the modal with the corresponding data
        modal.querySelector('#equipmentName').textContent = equipment;
        modal.querySelector('#requestId').textContent = id;
        modal.querySelector('#requestIdValue').value = id;
        modal.querySelector('#equipmentNameValue').value = equipment;

        // Show the modal
        modal.showModal();
    }

    // Function to close the modal
    function closeModal() {
        const modal = document.querySelector('dialog[open]');
        if (modal) {
            modal.close();
        }
    }
</script>

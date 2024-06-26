
  
  <!-- Main modal -->
  <div id="iframe-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative  z-99999 p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="filename" class="text-xl font-semibold text-gray-900 dark:text-white">
                    Requirements Review
                </h3>
                <button type="button" class="stClose text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <!-- Iframe to display the file -->
                  <iframe id="fileViewer" class="block mx-auto" src="" width="100%" height="600px" frameborder="0"></iframe>
                  
                  <div>
                    {{-- {{ Auth::user()->isReceiver }} --}}
                    @if (Auth::user()->role !== 1 && Auth::user()->isReceiver)
                        <label for="message" class="block mb-2 text-sm font-bold text-blue-900 dark:text-white">Comments/Instructions</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add your comments or messages here..."></textarea>
                    @endif   
                     
                      <input type="text" name="" id="filename-orig" class="hidden">
                      <input type="text" name="" id="subname" class="hidden">
                      {{-- is returning docs --}}
                      <input type="text" name="" id="isReturned" class="hidden">
                  </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                {{-- {{ Auth::user()->role }} --}}
                @if (Auth::user()->role !== 1 && Auth::user()->isReceiver)
                    <button data-modal-hide="static-modal" type="button" id="btn-iframe-accepted" class="btn-iframe-accepted text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Accepted</button>
                    <button data-modal-hide="static-modal" type="button" id="btn-iframe-declined" class="btn-iframe-declined py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                @endif
                
            </div>
        </div>
    </div>
</div>

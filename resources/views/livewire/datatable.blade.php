<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-auto">
    <div class="flex justify-end py-2">
        <div class="py-2 mr-16 relative text-gray-600">
            <input class="border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                   type="search" name="search" placeholder="Search">
            <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                     viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                     width="512px" height="512px">
                <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
              </svg>
            </button>
        </div>

        <div class="flex py-2 pr-16 text-sm text-gray-600">
            <div>
                <label for="pagination" class="mr-2 mb-0">Results Per Page</label>
                <select name="pagination"
                        id="pagination"
                        class="border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                        wire:model="pagination"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <div class="flex py-2 pr-16 text-sm text-gray-600">
            <div class="relative">
                <div>
                    <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300
                                   shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100
                                   focus:ring-indigo-500 {{ count($checked) === 0 ? 'disabled:opacity-50' : '' }}"
                            id="selection-button"
                            aria-haspopup="true"
                            aria-expanded="true"
                            {{ count($checked) === 0 ? 'disabled' : '' }}
                    >
                        {{ count($checked) }} Records Selected

                        <!-- Heroicon name: chevron-down -->
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="absolute hidden right-0 mt-1 py-2 w-48 bg-white rounded-lg shadow-lg" id="selection-menu">
                    <a href=""
                       class="block px-4 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100"
                       wire:click="deleteChecked"
                    >Delete</a>
                </div>
            </div>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Select
                </th>

                @foreach ($columns as $column)
                    <th scope="col" class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($this->records() as $record)
                <tr class="@if ($this->isChecked($record)) bg-gray-200 @endif">
                    <td class="flex justify-center">
                        <input type="checkbox" class="my-8" value="{{ $record->id }}" wire:model="checked">
                    </td>
                    @foreach ($columns as $column)
                        <td class="px-6 py-4 whitespace-nowrap overflow-clip overflow-hidden">
                            {{ $record->{$column} }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="bg-white px-4 py-3 border-t bg-gray-100 border-gray-200 sm:px-6">
            {{ $this->records()->links() }}
    </div>
</div>

<script>
const selectionButton = document.getElementById('selection-button');
const selectionMenu = document.getElementById('selection-menu');

selectionButton.onclick = function () {
    selectionMenu.classList.toggle('hidden');
}
</script>


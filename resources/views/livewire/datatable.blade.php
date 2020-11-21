<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col" class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($this->records() as $record)
                <tr>
                    @foreach ($columns as $column)
                        <td class="px-6 py-4 whitespace-nowrap">
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


<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>

        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($this->records() as $record)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $record->id }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

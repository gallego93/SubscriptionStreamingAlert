<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @can('clients.create')
                <a href="{{ route('clients.create') }}">
                    <button class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{!!
                        trans('clients.add_new_record') !!}</button>
                </a>
                @endcan
            </div>
            <form action="{{ route('clients.index') }}" method="GET">
                <input class="rounded px-2 py-1" name="search" value="{{ request('search') }}" placeholder="{!!
                    trans('messages.search_records') !!}">
                <button type="submit"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white rounded ">{!!
                    trans('messages.search') !!}</button>
            </form>
            <form action="{{ route('clients.index') }}" method="GET" class="flex items-center">
                <!-- Preserva los parámetros de búsqueda en este formulario -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="field" value="{{ request('field') }}">

                <label for="per_page" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{!!
                    trans('messages.records_per_page') !!}</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1">
                    <option value="5" {{ request('per_page')==5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page')==10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page')==20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                </select>
                <button type="submit" class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{!!
                    trans('messages.apply') !!}</button>
            </form>
        </div>
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {!! trans('clients.name') !!}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {!! trans('clients.address') !!}
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {!! trans('clients.phone') !!}
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {!! trans('clients.email') !!}
                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg></a>
                        </div>
                    </th>
                    @can('clients.edit')
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{!! trans('clients.edit') !!}</span>
                    </th>
                    @endcan
                    @can('clients.delete')
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{!! trans('clients.delete') !!}</span>
                    </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $row->address }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $row->phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $row->email }}
                    </td>
                    @can('clients.edit')
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('clients.edit', $row->id) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{!!
                            trans('clients.edit') !!}</a>
                    </td>
                    @endcan
                    @can('clients.delete')
                    <td class="px-6 py-4 text-right">
                        <form method="post" action="{{ route('clients.destroy', $row->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {!! trans('clients.delete') !!}
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $clients->appends(request()->except('page'))->links() }}
        </div>
    </div>
    <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        @if ($clients->isEmpty())
        <p>{!! trans('messages.no_records') !!}</p>
        @endif
    </div>
</x-app-layout>
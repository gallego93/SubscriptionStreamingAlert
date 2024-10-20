<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <!-- -->
            </div>
            <form action="{{ route('permissions.index') }}" method="GET">
                <input class="rounded px-2 py-1" name="search" value="{{ request('search') }}" placeholder="{!!
                    trans('messages.search_records') !!}">
                <button type="submit"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white rounded ">{!!
                    trans('messages.search') !!}</button>
            </form>
            <form action="{{ route('permissions.index') }}" method="GET" class="flex items-center">
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
                        {!! trans('permissions.name') !!}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {!! trans('permissions.description') !!}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row->name }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row->description }}
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $permissions->appends(request()->except('page'))->links() }}
        </div>
    </div>
    <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        @if ($permissions->isEmpty())
        <p>{!! trans('permissions.there_are_no_records') !!}</p>
        @endif
    </div>
</x-app-layout>
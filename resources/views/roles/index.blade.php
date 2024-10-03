<x-app-layout>
    <x-slot name="header">
        <div class="h-10 grid grid-cols-3 gap-4 content-start">
            <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                @can('roles.create')
                <a href="{{ route('roles.create') }}">
                    <button class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">{!!
                        trans('roles.add_new_record') !!}</button>
                </a>
                @endcan
            </div>
            <form action="{{ route('roles.index') }}" method="GET">
                <input class="rounded px-2 py-1" name="search" value="{{ request('search') }}"
                    placeholder="Buscar roles...">
                <button type="submit"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white rounded ">Buscar</button>
            </form>
            <form action="{{ route('roles.index') }}" method="GET" class="flex items-center">
                <!-- Preserva los parámetros de búsqueda en este formulario -->
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="field" value="{{ request('field') }}">

                <label for="per_page"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Registros por
                    página:</label>
                <select name="per_page" id="per_page" class="border border-gray-300 rounded px-2 py-1">
                    <option value="5" {{ request('per_page')==5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page')==10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page')==20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                </select>
                <button type="submit"
                    class="font-semibold ml-2 bg-blue-500 text-white px-2 py-1 rounded">Aplicar</button>
            </form>
        </div>
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {!! trans('roles.name') !!}
                    </th>
                    @can('roles.edit')
                    <th scope="col" class="px-6 py-3">
                        {!! trans('roles.edit') !!}
                    </th>
                    @endcan
                    @can('roles.delete')
                    <th scope="col" class="px-6 py-3">
                        {!! trans('roles.delete') !!}
                    </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $row)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $row->name }}
                    </th>
                    @can('roles.edit')
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('roles.edit', $row->id) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{!! trans('roles.edit')
                            !!}</a>
                    </td>
                    @endcan
                    @can('roles.delete')
                    <td class="px-6 py-4 text-right">
                        <form method="post" action="{{ route('roles.destroy', $row->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {!! trans('roles.delete') !!}
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $roles->appends(request()->except('page'))->links() }}
        </div>
    </div>
    <div class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        @if ($roles->isEmpty())
        <p>{!! trans('roles.there_are_no_records') !!}</p>
        @endif
    </div>
</x-app-layout>
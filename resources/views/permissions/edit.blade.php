<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {!! trans('permissions.permissions') !!}
        </h2>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{!! trans('permissions.update') !!}</h2>
            <form method="post" action="{{ route('permissions.update', $permission->id) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!!
                            trans('permissions.name') !!}</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{isset($permission) ? $permission->name : ''}}"
                            placeholder="{!! trans('permissions.name') !!}">
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 mt-4 sm:mt-6 rounded">
                            {!! trans('permissions.send') !!}
                        </button>
                    </div>
            </form>
        </div>
    </section>
</x-app-layout>
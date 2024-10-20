<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {!! trans('clients.clients') !!}
        </h2>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{!! trans('clients.update_record') !!}</h2>
            <form method="post" action="{{ route('clients.update', $client->id) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!!
                            trans('clients.name') !!}</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{isset($client) ? $client->name : ''}}" placeholder="{!! trans('clients.name') !!}">
                    </div>
                    <div class="w-full">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!!
                            trans('clients.address') !!}</label>
                        <input type="text" name="address" id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{isset($client) ? $client->address : ''}}"
                            placeholder="{!! trans('clients.address') !!}">
                    </div>
                    <div class="w-full">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!!
                            trans('clients.phone') !!}</label>
                        <input type="text" name="phone" id="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{isset($client) ? $client->phone : ''}}"
                            placeholder="{!! trans('clients.phone') !!}">
                    </div>
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!!
                            trans('clients.email') !!}</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{isset($client) ? $client->email : ''}}"
                            placeholder="{!! trans('clients.email') !!}">
                    </div>
                    <div class="form-group">
                        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{!! trans('roles.assing_roles') !!}
                        </h3>
                        <ul
                            class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="vue-checkbox" type="checkbox" name="email_send" value="0" {{
                                        $client->email_send ?
                                    'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                                    dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                                    focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="vue-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!!
                                        trans('clients.send_email') !!}</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="vue-checkbox" type="checkbox" name="whatsapp_send" value="0" {{
                                        $client->whatsapp_send ?
                                    'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                                    dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700
                                    focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="vue-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!!
                                        trans('clients.send_whatsapp') !!}</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mt-4 sm:mt-6 rounded">
                            {!! trans('clients.update_record') !!}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
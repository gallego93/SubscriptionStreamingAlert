<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {!! trans('subscriptions.subscriptions') !!}
        </h2>
    </x-slot>

<section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
            {!! trans('subscriptions.update_record') !!}
        </h2>

        <form method="post" action="{{ route('subscriptions.update', $subscription->id) }}">
            @csrf
            @method('PUT')

            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                <div class="sm:col-span-2">
                    <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! trans('subscriptions.client_id') !!}
                    </label>
                    <select id="client_id" name="client_id" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($clients as $id => $name)
                        <option value="{{ $id }}" {{ $id == $subscription->client_id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! trans('subscriptions.product_id') !!}
                    </label>
                    <select id="product_id" name="product_id" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($products as $id => $name)
                        <option value="{{ $id }}" {{ $id == $subscription->product_id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full">
                    <label for="initial_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! trans('subscriptions.initial_date') !!}
                    </label>
                    <input type="date" name="initial_date" id="initial_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{isset($subscription) ? $subscription->initial_date : ''}}" placeholder="{!! trans('subscriptions.initial_date') !!}">
                </div>

                <div class="w-full">
                    <label for="final_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! trans('subscriptions.final_date') !!}
                    </label>
                    <input type="date" name="final_date" id="final_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{isset($subscription) ? $subscription->final_date : ''}}" placeholder="{!! trans('subscriptions.final_date') !!}">
                </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-5 mt-4 sm:mt-6 rounded">
                    {!! trans('subscriptions.update_record') !!}
                </button>
            </div>
        </form>
    </div>
  </section>
</x-app-layout>
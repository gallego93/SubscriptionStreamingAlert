<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {!! trans('messages.update_credential') !!}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {!! trans('messages.services_credential') !!}
        </p>
    </header>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.store') }}" method="POST" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="category" :value="__('Servicio')" />
            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full"
                placeholder="twilio, stripe, mailgun, etc." required autofocus autocomplete="category" />
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        <div>
            <x-input-label for="keys[]" :value="__('Clave')" />
            <x-text-input id="keys[]" name="keys[]" type="text" class="mt-1 block w-full"
                placeholder="TWILIO_SID, TWILIO_TOKEN, etc." required autofocus autocomplete="keys[]" />
            <x-input-error class="mt-2" :messages="$errors->get('keys[]')" />
        </div>

        <div>
            <x-input-label for="values[]" :value="__('Valor')" />
            <x-text-input id="values[]" name="values[]" type="text" class="mt-1 block w-full"
                placeholder="Valor de la clave" required autofocus autocomplete="values[]" />
            <x-input-error class="mt-2" :messages="$errors->get('values[]')" />
        </div>

        <div>
            <x-primary-button type="button" class="btn btn-secondary" id="add-field">Agregar más campos
            </x-primary-button>
        </div>

        <x-primary-button type="submit" class="btn btn-primary">Guardar Configuración</x-primary-button>
    </form>

    <script>
        document.getElementById('add-field').addEventListener('click', function() {
            const formGroup = `
            <div class="mt-6 space-y-6">
                <div>
                    <x-input-label for="keys[]" :value="__('Clave')" />
                    <x-text-input id="keys[]" name="keys[]" type="text" class="mt-1 block w-full"
                        placeholder="TWILIO_SID, TWILIO_TOKEN, etc." required autofocus autocomplete="keys[]" />
                    <x-input-error class="mt-2" :messages="$errors->get('keys[]')" />
                </div>

                <div>
                    <x-input-label for="values[]" :value="__('Valor')" />
                    <x-text-input id="values[]" name="values[]" type="text" class="mt-1 block w-full"
                        placeholder="Valor de la clave" required autofocus autocomplete="values[]" />
                    <x-input-error class="mt-2" :messages="$errors->get('values[]')" />
                </div>
            </div>
        `;
            this.insertAdjacentHTML('beforebegin', formGroup);
        });
    </script>
</section>
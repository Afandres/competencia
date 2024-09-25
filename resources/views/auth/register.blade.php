<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Correo Electronico') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="new-email" />
            </div>

            <div class="mt-4">
                <x-label for="document_type" value="{{ __('Tipo de Documento') }}" />
                <select id="document_type" name="document_type" class="block mt-1 w-full" required>
                    <option value="" disabled selected>{{ __('Selecione su Tipo de Documento') }}</option>
                    <option value="Tarjeta de Identidad">{{ __('Tarjeta de Identidad') }}</option>
                    <option value="Cedula de Cuidadania">{{ __('Cedula Cuidadania') }}</option>
                    <option value="Cedula Extrajera">{{ __('Cedula Extrajera') }}</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="number_document" value="{{ __('Numero de Documento ') }}" />
                <x-input id="number_document" class="block mt-1 w-full" type="number" name="document_number" :value="old('document_number')" required autocomplete="new-document_number" />
            </div>

            <div class="mt-4">
                <x-label for="telephone" value="{{ __('Telefono') }}" />
                <x-input id="telephone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" required autocomplete="new-telephone" />
            </div>

            <div class="mt-4">
                <x-label for="address" value="{{ __('Dirrecion') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" required autocomplete="new-address" />
            </div>

            <div>
                <x-label for="name_user" value="{{ __('Cargo') }}" />
                <select id="name_user" name="name_user" class="block mt-1 w-full" required>
                    <option value="" disabled selected>{{ __('Selecione su Cargo') }}</option>
                    <option value="apprentice">{{ __('Aprendiz') }}</option>
                    <option value="officials">{{ __('Funcionario') }}</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Ya estas registrado?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>



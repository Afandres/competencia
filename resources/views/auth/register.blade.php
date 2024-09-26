<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user.register.store') }}">
            @csrf
            <div class="mt-4">
                <x-label for="document_number" value="{{ __('Numero de Documento ') }}" />
                <x-input id="document_number" class="block mt-1 w-full" type="number" name="document_number" :value="old('document_number')" required autocomplete="new-document_number" />
                <x-input id="role_id" type="hidden" name="role_id"/>
                <x-input id="personid" type="hidden" name="personid"/>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <div id="name" class="text-center text-bold"></div>
                    <br>
                    <div id="rol" class="text-center text-bold"></div>
                    <br>
                </div>
            </div>
            <div class="container_paswword">
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
    
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
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

                <x-button class="ms-4" id="solicitar">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('.container_paswword').hide();
        $('#document_number').on('change', function() {
            var document_number = $(this).val();
            console.log(document_number);
            var role = $('#role').val();
 
            if (document_number) {
                $.ajax({
                    url: '{{ route('user.register.search_person') }}',
                    method: 'GET',
                    data: {
                        document_number: document_number,
                        role: role
                    },
                    success: function(response) {
                        $('#name').text('');
                        $('#rol').text('');

                        $('#solicitar').prop('disabled', true);

                        if (response.person) {
                            $('#name').text(response.person.name);
                            $('#personid').val(response.person.id);

                            if (response.rol == 'Funcionario') {
                                $('#rol').text('Rol : Funcionario');
                                $('#role_id').val('funcionario');
                                $('#solicitar').prop('disabled', false)
                                $('.container_paswword').show();
                            } else if (response.rol == 'Aprendiz') {
                                $('#rol').text('Rol : Aprendiz');
                                $('#role_id').val('aprendiz');
                                $('#solicitar').prop('disabled', false)
                                $('.container_paswword').show();
                            } else {
                                $('#rol').text('No eres funcionario o aprendiz');
                                $('#solicitar').prop('disabled', true)
                            }
                        }
                        

                        if (response.error) {
                            $('#solicitar').prop('disabled', true);
                            $('#name').text(response.error);

                        }
                        
                        $('#role').val(response.rol);
                    },
                    error: function() {
                        console.error('Error en la solicitud AJAX');
                    }
                });
            } else {
                
            }
        });
    });
</script>


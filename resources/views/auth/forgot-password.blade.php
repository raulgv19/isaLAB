<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        <a href="/">
                <img src="{{ asset('/media/img/login-img.png') }}" alt="" width="100px" style="margin: 0 auto;">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Ha olvidado su contraseña? No hay problema. Sólo tienes que indicarnos tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Enviar link de reseteo al correo') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

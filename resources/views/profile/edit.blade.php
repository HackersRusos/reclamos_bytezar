<<<<<<< HEAD
<x-app-layout>
  <div class="bg-blue-100 dark:bg-gray-800 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

      {{-- Información de perfil ocupa todo el ancho --}}
      <section class="p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6">
        @include('profile.partials.update-profile-information-form')
      </section>

      {{-- Grilla para contraseña y eliminar cuenta --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Cambio de contraseña (2 columnas) --}}
        <section class="md:col-span-2 p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6">
          @include('profile.partials.update-password-form')
        </section>

        {{-- Eliminar cuenta (1 columna) --}}
        <section class="md:col-span-1 p-6 border rounded-lg bg-card shadow-md text-card-foreground space-y-6">
          @include('profile.partials.delete-user-form')
        </section>

      </div>

    </div>
  </div>
</x-app-layout>

=======
@extends('layouts.app')

@section('content')
    {{-- Encabezado --}}
    <header class="bg-white dark:bg-gray-800 shadow mb-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
            <h2 class="font-semibold text-xl leading-tight">
                {{ __('Perfil') }}
            </h2>
        </div>
    </header>

    {{-- Nombre y correo --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 flex justify-center">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 w-full sm:w-2/3 md:w-1/2">
            <p class="text-lg text-gray-900 dark:text-gray-100"><strong>👤 Nombre:</strong> {{ Auth::user()->name }}</p>
            <p class="text-lg text-gray-900 dark:text-gray-100"><strong>✉️ Correo:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>

    {{-- Actualizar contraseña (oculto hasta que se toque el botón) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 flex justify-center">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 w-full sm:w-2/3 md:w-1/2" x-data="{ showPasswordForm: false }">
            <div class="text-center">
                <button @click="showPasswordForm = !showPasswordForm"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                    <span x-show="!showPasswordForm">Actualizar contraseña</span>
                    <span x-show="showPasswordForm">Ocultar formulario</span>
                </button>
            </div>

            <div x-show="showPasswordForm" x-transition class="mt-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    {{-- Borrar cuenta --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 flex justify-center">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 w-full sm:w-2/3 md:w-1/2">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
>>>>>>> origin/Sofia

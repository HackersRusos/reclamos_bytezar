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


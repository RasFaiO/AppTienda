<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('categoria.create')}}">
                    <x-button class="mt-4">
                        {{ __('New Category') }}
                    </x-button>
                </a>
            </div>
            <div>
                @include('tienda.categoria.search')
            </div>
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sounded-lg divide-y dark:divide-gray-900">
                @foreach ($categorias as $categoria)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>Id:
                                        {{-- {{$chirp->user->name}} --}}
                                        {{$categoria->id}} <br></h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    {{-- {{$chirp->user->name}} --}}
                                    <h3>
                                        {{ __('Name:')}}
                                        {{$categoria->nombre}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    {{-- {{$chirp->user->name}} --}}
                                    <h3>
                                        {{ __('Description:')}}
                                        {{$categoria->descripcion}} <br>
                                    </h3>
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    <p>{{ __('Created at:')}}</p> {{
                                    $categoria->created_at}}
                                </small>
                                @unless ($categoria->created_at ==($categoria->updated_at))
                                <small class="text-sm text-gray-600 dark:text-gray-400">
                                    &middot; {{ __('Edited') }}
                                </small>
                                @endunless

                            </div>
                        </div>
                        {{-- <p class="mt-4 text-lg text-gray-900 dark:text-gray-100"> {{$categoria->message}} </p> --}}
                    </div>
                    {{-- Otra manera de validar es con is --}}
                    {{-- @if (auth()->user()->id === $chirp->user_id) --}}
                    {{-- @if (auth()->user()->is($chirp->user)) --}}
                    {{-- @can('update', $categoria) --}}
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>

                            </button>
                        </x-slot>
                        <x-slot name="content">
                            {{-- le pasamos la ruta a la que queremos redireccionar --}}
                            <x-dropdown-link :href="route('categoria.edit', $categoria)">
                                {{ __('Edit Category') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('categoria.destroy', $categoria) }}" class="eliminar">
                                @csrf @method('DELETE')
                                <x-dropdown-link>
                                    {{-- event.preventDefault(); this.closest('form').submit(); --}}
                                    {{ __('Delete Category') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    {{-- @endif --}}
                    {{-- @endcan --}}
                </div>
                @endforeach
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 pt-4">
                </div>
                <div class="col-span-1 pt-4">
                    {{ $categorias->links() }}
                </div>
                <div class="col-span-1 pt-4">
                </div>
            </div>
        </div>
    </div>
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const night = window.matchMedia('(prefers-color-scheme: dark)');
            if (night.matches){
                // console.log('dark');
                var botonConfirmar = '#111827';
                var botonCancelar = '#d33';
                var bodyColor = '#1f2937';
                var textColor = '#fff';
            } else {
                // console.log('no dark');
                var botonConfirmar = '#111827';
                var botonCancelar = '#d33';
                var bodyColor = '';
            }
    </script>

    @switch(session('status'))
    @case('created')
    <script>
        Swal.fire({ 
                position: "top-end", 
                title: "{{ __('Category created successfully!') }}",
                icon: "success",
                showConfirmButton: false,
                color: textColor,
                background: bodyColor,
                timer: 2000
                });
    </script>
    @break
    @case('deleted')
    <script>
        Swal.fire({ 
                position: "top-end", 
                title: "{{ __('Your category has been deleted.') }}",
                icon: "success",
                showConfirmButton: false,
                color: textColor,
                background: bodyColor,
                timer: 2000});
                // Swal.fire({
                //     title: "{{ __('Deleted!') }}",
                //     text: "{{ __('Your category has been deleted.')}}",
                //     icon: "success",
                //     color: textColor,
                //     background: bodyColor,
                //     confirmButtonColor: botonConfirmar
                // });
    </script>
    @break
    @case('updated')
    <script>
        Swal.fire({ 
                position: "top-end", 
                title: "{{ __('Category updated successfully!') }}",
                icon: "success",
                showConfirmButton: false,
                color: textColor,
                background: bodyColor,
                timer: 2000
                });
    </script>
    @break
    @default
    @endswitch
    <script>
        const alertaEliminar = document.querySelectorAll('.eliminar');
        alertaEliminar.forEach(function (alerta) {
            alerta.addEventListener('click',function(e){
                e.preventDefault();
                Swal.fire({ 
                    title: "{{ __('Are you sure?')}}",    
                    text: "{{ __('You won´t be able to revert this!') }}",
                    icon: "warning",
                    showCancelButton: true,
                    color: textColor,
                    background: bodyColor,
                    confirmButtonColor: botonConfirmar,
                    cancelButtonColor: botonCancelar,
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
            });
        });
    </script>
    @endsection
</x-app-layout>
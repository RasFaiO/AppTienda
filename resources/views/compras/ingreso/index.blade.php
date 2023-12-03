<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Income') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('ingreso.create')}}">
                <x-button class="mt-4">
                    {{ __('New Income') }}
                </x-button>
            </a>
            </div>
            <div>
                @include('compras.ingreso.search')
            </div>
            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sounded-lg divide-y dark:divide-gray-900">
                @foreach ($ingresos as $ingreso)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('Date:')}}
                                        {{$ingreso->created_at}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('Provider:')}}
                                        {{$ingreso->persona->nombre}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('receipt:')}}
                                        {{$ingreso->tipo_comprobante.': '.$ingreso->serie_comprobante.' - '.$ingreso->num_comprobante}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('Tax:')}}
                                        {{$ingreso->impuesto}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('Total:')}}
                                        {{$ingreso->totalizado}} <br>
                                    </h3>
                                </span>
                                <span class="text-gray-800 dark:text-gray-200">
                                    <h3>
                                        {{ __('State:')}}
                                        {{$ingreso->estado}} <br>
                                    </h3>
                                </span>
                                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    <p>{{ __('Created at:')}}</p> {{
                                    $ingreso->created_at}}
                                </small>
                                @unless ($ingreso->created_at == ($ingreso->updated_at))
                                <small class="text-sm text-gray-600 dark:text-gray-400">
                                    &middot; {{ __('Edited') }}
                                </small>
                                @endunless

                            </div>
                        </div>
                    </div>
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
                            {{-- Detalles de ingreso --}}
                            <x-dropdown-link :href="route('ingreso.show', $ingreso)">
                                {{ __('Entry Details') }}
                            </x-dropdown-link>
                            {{-- Cancela ingreso --}}
                            <form method="POST" action="{{ route('ingreso.destroy', $ingreso) }}"
                                class="eliminar">
                                @csrf @method('DELETE')
                                <x-dropdown-link>
                                    {{ __('Cancel Entry') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endforeach
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 pt-4"></div>
                <div class="col-span-1 pt-4">
                    {{ $ingresos->links() }}
                </div>
                <div class="col-span-1 pt-4"></div>
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
                    title: "{{ __('Receipt created successfully!') }}",
                    icon: "success",
                    showConfirmButton: false,
                    color: textColor,
                    background: bodyColor,
                    timer: 2000
                    });
                </script>
                @break
            @case('canceled')
                <script>
                    Swal.fire({ 
                    position: "top-end", 
                    title: "{{ __('The receipt has been canceled.') }}",
                    icon: "success",
                    showConfirmButton: false,
                    color: textColor,
                    background: bodyColor,
                    timer: 2000});
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
                        confirmButtonText: "{{ __('Yes, delete it!') }}"
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
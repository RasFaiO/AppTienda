<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sale Info') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm sounded-lg divide-y dark:divide-gray-900">
                <div class="min-h-screen p-6 bg-gray-300 rounded-xl dark:bg-gray-800 flex items-center justify-center">
                    <div class="container max-w-screen-lg mx-auto dark:bg-gray-800">
                        <div>
                            <div class="text-center">
                                <h2 class="font-semibold dark:text-gray-200 text-xl text-gray-600">
                                    {{ __('Sale') }}
                                </h2>
                                <p class="text-gray-500 dark:text-gray-200 mb-6">
                                    {{ __('Sales detail information') }}
                                </p>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-800 rounded-xl shadow-lg p-4 px-4 md:p-8 mb-6">
                                <div class="text-sm">
                                    <form method="POST" action=" {{ route('ingreso.store') }} ">
                                        @csrf
                                        {{-- Aplicamos column-gap --}}
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 sm:grid-cols-3">
                                            
                                            @foreach ($ingreso as $item)
                                                <div class="sm:col-span-3 dark:text-gray-200 grid">
                                                    <label for="nombre">{{ __('Client') }}</label>
                                                    <input type="text" name="nombre" id="nombre"
                                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                        value="{{ old('nombre',$item->cliente) }}" disabled/>
                                                </div>

                                                <div class="dark:text-gray-200 grid">
                                                    <label for="tipo_comprobante">{{ __('Receipt') }}</label>
                                                    <input type="text" name="tipo_comprobante" id="tipo_comprobante"
                                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                        value="{{ old('tipo_comprobante',$item) }}" disabled/>
                                                </div>

                                                <div class=" dark:text-gray-200">
                                                    <label for="serie_comprobante">{{ __('voucher series') }}</label>
                                                    <input type="text" name="serie_comprobante" id="serie_comprobante"
                                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                        value="{{ old('serie_comprobante',$item) }}" disabled />
                                                </div>

                                                <div class="dark:text-gray-200">
                                                    <label for="num_comprobante">{{ __('Voucher number') }}</label>
                                                    <input type="text" name="num_comprobante" id="num_comprobante"
                                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                        value="{{ old('num_comprobante',$item) }}" placeholder="" disabled />
                                                </div>
                                                {{-- Ingreso --}}
                                                <div class="sm:col-span-3">
                                                    <div class="mt-4 pt-4">
                    
                                                        <div class="px-2 py-2 dark:bg-gray-700 bg-gray-300 overflow-x-auto md:overflow-x-visible rounded-lg">
                                                            <table id="detalles" class="w-full table-auto border-spacing-1 border-separate">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">{{ __('Article')}}</th>
                                                                        <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">{{ __('Quantity')}}</th>
                                                                        <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">{{ __('Sale price')}}</th>
                                                                        <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">{{ __('% Discount')}}</th>
                                                                        <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">{{ __('SubTotal')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($detalles as $detalle)
                                                                    <tr class="hover:bg-gray-800 lg:hover:scale-105">
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">
                                                                            {{ $detalle->articulos->nombre }}
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">
                                                                            {{ $detalle->cantidad }}
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">
                                                                            {{ $detalle->precio_venta }}
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">
                                                                            {{ $detalle->descuento }}
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">
                                                                            {{ $detalle->subtotal.'.00' }}
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">
                                                                            {{ __('Total paid:') }}
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">
                                                                            
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">
                                                                            
                                                                        </td>
                                                                        <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">
                                                                            
                                                                        </td>
                                                                        <td class="px-4 py-2 text-center border dark:border-gray-300 dark:text-gray-300 rounded-lg hover:bg-gray-800 hover:scale-105">
                                                                            <h4 class="" id="total">$/ {{ $item->total_venta }}</h4>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-3 text-right">
                                                    <div class="inline-flex items-end" id="botones">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <a class="mr-4 text-xs font-bold"
                                                            href="{{ route('venta.index') }}">
                                                            <div class="bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                                {{ __('Return') }}
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
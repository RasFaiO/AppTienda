<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Provider') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm sounded-lg divide-y dark:divide-gray-900">
                <div class="min-h-screen p-6 bg-gray-300 rounded-xl dark:bg-gray-800 flex items-center justify-center">
                    <div class="container max-w-screen-lg mx-auto dark:bg-gray-800">
                        <div>
                            <div class="text-center">
                                <h2 class="font-semibold dark:text-gray-200 text-xl text-gray-600">{{ __('Edit Provider')
                                    }}</h2>
                                <p class="text-gray-500 dark:text-gray-200 mb-6"></p>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-800 rounded-xl shadow-lg p-4 px-4 md:p-8 mb-6">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                    <div class="text-gray-600 ">
                                        <p class="font-medium dark:text-gray-200 text-lg">
                                            {{ __('Update provider data') }}
                                        </p>
                                    </div>

                                    <form class="lg:col-span-2" method="POST"
                                        action=" {{ route('proveedor.update', $persona) }} ">
                                        @csrf @method('PUT')
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="nombre">{{ __('Name')}}</label>
                                                <input type="text" name="nombre" id="nombre"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('nombre', $persona)}}" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200 grid grid-cols ">
                                                <label for="tipo_documento">{{ __('Document type') }}</label>
                                                <select name="tipo_documento" id="tipo_documento"
                                                    class="rounded-lg dark:bg-gray-800">
                                                    
                                                    @switch(old('tipo_documento', $persona))
                                                        @case('CC')
                                                            <option value="CC" selected>
                                                                <p>
                                                                    {{ __('CC') }}
                                                                </p>
                                                            </option>
                                                            <option value="Passport">
                                                                <p>
                                                                    {{ __('Passport') }}
                                                                </p>
                                                            </option>
                                                            <option value="NIT">
                                                                <p>
                                                                    {{ __('NIT') }}
                                                                </p>
                                                            </option>
                                                            @break
                                                        @case('Passport')
                                                            <option value="CC">
                                                                <p>
                                                                    {{ __('CC') }}
                                                                </p>
                                                            </option>
                                                            <option value="Passport" selected>
                                                                <p>
                                                                    {{ __('Passport') }}
                                                                </p>
                                                            </option>
                                                            <option value="NIT">
                                                                <p>
                                                                    {{ __('NIT') }}
                                                                </p>
                                                            </option>
                                                            @break
                                                        @case('NIT')
                                                        <option value="CC">
                                                            <p>
                                                                {{ __('CC') }}
                                                            </p>
                                                        </option>
                                                            <option value="Passport">
                                                                <p>
                                                                    {{ __('Passport') }}
                                                                </p>
                                                            </option>
                                                            <option value="NIT" selected>
                                                                <p>
                                                                    {{ __('NIT') }}
                                                                </p>
                                                            </option>
                                                            @break
                                                        @default
                                                            <option value="" disabled selected>
                                                                <p>
                                                                    {{ __('Select') }}
                                                                </p>
                                                            </option>
                                                            <option value="CC">
                                                                <p>
                                                                    {{ __('CC') }}
                                                                </p>
                                                            </option>
                                                            <option value="Passport">
                                                                <p>
                                                                    {{ __('Passport') }}
                                                                </p>
                                                            </option>
                                                            <option value="NIT">
                                                                <p>
                                                                    {{ __('NIT') }}
                                                                </p>
                                                            </option>
                                                        @break
                                                    @endswitch
                                                    
                                                </select>
                                            </div>


                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="num_documento">{{ __('Document number')}}</label>
                                                <input type="text" name="num_documento" id="num_documento"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('num_documento', $persona)}}" placeholder="" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="direccion">{{ __('Address')}}</label>
                                                <input type="text" name="direccion" id="direccion"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('direccion', $persona)}}" placeholder="" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="telefono">{{ __('Phone number')}}</label>
                                                <input type="tel" name="telefono" id="telefono"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('telefono', $persona)}}" placeholder="" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="email">{{ __('E-mail')}}</label>
                                                <input type="email" name="email" id="email"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('email', $persona)}}" placeholder="" />
                                            </div>
                                            <div class="md:col-span-5 dark:text-gray-200 mx-6">
                                                <x-validation-errors />
                                            </div>
                                            <div class="md:col-span-7 text-right">
                                                <div class="inline-flex items-end">

                                                    <a class="text-xs font-bold mr-4"
                                                        href="{{ route('proveedor.index') }}">
                                                        <div class="bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                            {{ __('Cancel') }}
                                                        </div>
                                                    </a>
                                                    <x-button class="mt-4">
                                                        {{ __('Update Provider') }}
                                                    </x-button>
                                                </div>
                                            </div>
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
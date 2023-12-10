<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New user') }}
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
                                    {{ __('User') }}
                                </h2>
                                <p class="text-gray-500 dark:text-gray-200 mb-6">
                                    {{ __('input user data to create') }}    
                                </p>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-800 rounded-xl shadow-lg p-4 px-4 md:p-8 mb-6">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                    <div class="text-gray-600">
                                        <p class="font-medium dark:text-gray-200 text-lg">{{ __('New User') }}</p>
                                    </div>

                                    <form class="lg:col-span-2" method="POST" action=" {{ route('usuario.store') }} ">
                                        @csrf
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="name">{{ __('Name') }}</label>
                                                <input type="text" name="name" id="name"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('name') }}" required autofocus autocomplete="name"/>
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="email">{{ __('Email') }}</label>
                                                <input type="email" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('email') }}" required autocomplete="username" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="password">{{ __('Password') }}</label>
                                                <input type="password" name="password" id="password" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" required autocomplete="new-password"/>
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200">
                                                <label for="password_confirmation">{{ __('Confirm password') }}</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" required autocomplete="new-password" />
                                            </div>

                                            <div class="md:col-span-5 dark:text-gray-200 mx-6">
                                                <x-validation-errors />
                                            </div>
                                            <div class="md:col-span-5 text-right">
                                                <div class="inline-flex items-end">
                                                    <a class="mr-4 text-xs font-bold" href="{{ route('usuario.index') }}"> 
                                                        <div class="bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                            {{ __('Cancel') }}
                                                        </div>
                                                    </a>
                                                    <x-button class="mt-4">
                                                        {{ __('Create User')}}
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
@if (session('status'))
    <div class="bg-green-600 text-green-100 text-center text-lg font-bold p-2">
        {{ session('status') }}
    </div>   
@endif

<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>
    {{-- slot principal --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="px-6 py-6 text-2xl font-medium text-gray-900 dark:text-white">Hello World</h1>
                {{-- <x-welcome /> --}}
            </div>
        </div>
    </div>
    {{-- slot principal --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="px-6 py-6 text-2xl font-medium text-gray-900 dark:text-white">Hello World2</h1>
                {{-- <x-welcome /> --}}
            </div>
        </div>
    </div>
</x-app-layout>

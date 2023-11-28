<form class="lg:col-span-2" method="GET" action=" {{ route('tienda.categoria.index'), $searchText }} ">
    @csrf
    <x-input 
        name="searchText"
        class=" border mt-1 rounded px-4 bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
        value="{{ $searchText }}"
        placeholder="{{ __('Quick search...') }}">
        
    </x-input>
    <x-button class="mt-4">
        {{ __('Search') }}
    </x-button>
</form>
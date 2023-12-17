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
                <div class="grid gap-2 gap-x-2 grid-cols-2 dark:text-gray-200 text-center">
                    <figure class="p-2 m-2">
                        <h2 class="uppercase text-lg">{{ __('sales per month')}}</h2>
                        <canvas id="ventaMes"></canvas>
                    </figure>
                    <figure>
                        <h2 class="uppercase text-lg">{{ __('purchases per month')}}</h2>
                        <canvas id="compraMes"></canvas>
                    </figure>
                    <figure class="p-2 m-2">
                        <h2 class="uppercase text-lg">{{ __('Products most selled')}}</h2>
                        <canvas id="top5"></canvas>
                    </figure>
                    <figure>
                        <h2 class="uppercase text-lg">{{ __('daily sales')}}</h2>
                        <canvas id="ventasDiarias"></canvas>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>

            
            const night = window.matchMedia('(prefers-color-scheme: dark)');
            if (night.matches){
                // console.log('dark');
                Chart.defaults.color = '#fff';
            } else {
                // console.log('no dark');
                Chart.defaults.color = '#000';
            }
            
            function getDataColors(opacity){
                const colors = ['#7448c2','#21c0d7','#d99e2b','#cd3a81','#9c99cc','#e14eca','#ff0000','#ffffff','#d6ff00','#000fff'];
                return colors.map(color => opacity ? `${color + opacity}` : color);
            }

            const articleData = JSON.parse(`<?php echo $article; ?>`);
            const sellData = JSON.parse(`<?php echo $sell; ?>`);

            function printCharts(){
                productos();
                ventas();
            }
            
            function ventas() {
                const data = {
                    labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    datasets: [{
                        label: '{{__('Sales amount')}}',
                        data: sellData.ventas,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.5
                    }]
                };
                new Chart('ventaMes',{
                    type: 'line', 
                    data,
                });
            }

            function productos(){
                topFive();
                const data = {
                    labels: top_label,
                    datasets: [{
                        data: top_data,
                        borderColor: getDataColors(),
                        backgroundColor: getDataColors(20)
                    }]
                }
                const options = {
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'center',
                            labels: {
                                font: {
                                    size: '15'
                                }
                            }
                        }
                        
                    }
                }
                new Chart('top5', {
                    type: 'doughnut', 
                    data, 
                    options,
                });
            }

            function topFive(){
                // con sort((a,b)) estamos indicando que nos organice el arreglo de mayor a menor cuando retornamos b-a
                const max = articleData.articulos.sort((a,b) => {
                    return b['cantidad']-a['cantidad'];
                });
                contador = 0;
                top_label = [];
                top_data = [];
                max.forEach(element => {
                    if (contador < 5) {
                        top_label.push(element.nombre);
                        top_data.push(element.cantidad);
                    }
                    contador++;
                });
            }
    
            printCharts();
    
            
        </script>
    @endsection
</x-app-layout>

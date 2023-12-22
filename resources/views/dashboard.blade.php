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
                <div class="grid gap-2 gap-x-2 md:grid-cols-2 dark:text-gray-200 text-center">
                    <figure class="p-2 m-2 bg-gray-700 hover:scale-105">
                        <h2 class="uppercase text-lg">{{ __('Purchases per month')}}</h2>
                        <canvas id="compraMes"></canvas>
                    </figure>
                    <figure class="p-2 m-2 bg-gray-700 hover:scale-105">
                        <h2 class="uppercase text-lg">{{ __('Sales per month')}}</h2>
                        <canvas id="ventaMes"></canvas>
                    </figure>
                    <figure class="p-2 m-2 bg-gray-700 hover:scale-105">
                        <h2 class="uppercase text-lg">{{ __('Products most selled')}}</h2>
                        <canvas id="top5"></canvas>
                    </figure>
                    <figure class="p-2 m-2 bg-gray-700 hover:scale-105 grid content-center">
                        <h2 class="uppercase text-lg">{{ __('Daily sales')}}</h2>
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

            const articleData = JSON.parse(`<?php echo $article; ?>`);
            const sellData = JSON.parse(`<?php echo $sell; ?>`);
            const purcData = JSON.parse(`<?php echo $purc; ?>`);
            const dayData = JSON.parse(`<?php echo $day; ?>`);

            function printCharts(){
                compras();
                ventas();
                productos();
                ventDiarias();
            }

            function compras() {
                const data = {
                    labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    datasets: [{
                        label: '{{__('Purchases per month')}}',
                        data: purcData.compras,
                        fill: true,
                        borderColor: '#9c99cc',
                        backgroundColor: '#9c99cc',
                        pointBorderColor: '#fff',
                        tension: 0.5,
                        pointRadius: 10,
                        pointBorderWidth: 3,
                        hoverRadius: 9,
                        pointStyle: 'crossRot'
                    }]
                };
                new Chart('compraMes',{
                    type: 'line', 
                    data,
                    // options,
                });
            }
            
            function ventas() {
                const data = {
                    labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    datasets: [{
                        label: '{{__('Sales per month')}}',
                        data: sellData.ventas,
                        fill: false,
                        borderColor: '#4BC0C0',
                        pointBorderColor: '#fff',
                        tension: 0.3,
                        pointRadius: 10,
                        pointBorderWidth: 3,
                        hoverRadius: 9,
                        pointStyle: 'rect'
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
                        label: '{{ __('Amount') }}',
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

            function ventDiarias() {
                const dataDia = dataDias(15);
                const labelDia = labelDias(15);
                const data = {
                    labels: labelDia,
                    datasets: [{
                        label: '{{__('Daily sales')}}',
                        data: dataDia,
                        backgroundColor: getDataColors(20),
                        borderColor: getDataColors(),
                        borderWidth: 1
                    }]
                };

                const options = {
                    scales: {
                        y: {
                            beginAtZero:true
                        }
                    }
                }
                new Chart('ventasDiarias', {
                    type: 'bar', 
                    data, 
                    options,
                });
            }

            function meses() {
                const fechaActual = new Date();
                const topMes = new Date();
                const nDaysInMillis = ((24 * (14)) * 60) * 60 * 1000; 
                let cantDias = 0;
                const labelDia = [];
                const aDayInMillis = 1440 * 60 * 1000;
                const options = {
                    month: 'short',
                    day: 'numeric'
                }
                topDias.setTime(fechaActual.getTime());
                topDias.setTime(topDias.getTime() - nDaysInMillis);
                while (cantDias < n) {
                    labelDia.push(topDias.toLocaleDateString(undefined, options));
                    topDias.setTime(topDias.getTime() + aDayInMillis);
                    cantDias = cantDias+1;
                }
                // return labelDia;
            }

            function getDataColors(opacity){
                const colors = ['#7448c2','#21c0d7','#d99e2b','#cd3a81','#9c99cc','#e14eca','#ff0000','#ffffff','#d6ff00','#000fff','#ED4C29','#79ED29'];
                return colors.map(color => opacity ? `${color + opacity}` : color);
            }

            function dataDias(n) {
                const dias = dayData.data;
                const daysToMake = n;
                const dataDia = [];
                let i = 1;
                while (i <= daysToMake) {
                    let sumaVentas = 0;
                    dias.forEach(element => {
                        const diaN = element.dia;
                        if (diaN == i){
                            sumaVentas++;
                        }
                    })
                    dataDia.push(sumaVentas);
                    i++;
                }
                return dataDia;
            }

            function labelDias(n) {
                const fechaActual = new Date();
                const topDias = new Date();
                const nDaysInMillis = ((24 * (n-1)) * 60) * 60 * 1000; 
                let cantDias = 0;
                const labelDia = [];
                const aDayInMillis = 1440 * 60 * 1000;
                const options = {
                    month: 'short',
                    day: 'numeric'
                }
                topDias.setTime(fechaActual.getTime());
                topDias.setTime(topDias.getTime() - nDaysInMillis);
                while (cantDias < n) {
                    labelDia.push(topDias.toLocaleDateString(undefined, options));
                    topDias.setTime(topDias.getTime() + aDayInMillis);
                    cantDias = cantDias+1;
                }
                return labelDia;
            }
            
            function topFive(){
                // con sort((a,b)) estamos indicando que nos organice el arreglo de mayor a menor cuando retornamos b-a
                const max = articleData.articulos.sort((a,b) => {
                    return b['cantidad']-a['cantidad'];
                });
                let contador = 0;
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

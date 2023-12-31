<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Sale') }}
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
                                    {{ __('Input details of the sale to create') }}
                                </p>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-800 rounded-xl shadow-lg p-4 px-4 md:p-8 mb-6">
                                <div class="text-sm">
                                    <form method="POST" action=" {{ route('venta.store') }} ">
                                        @csrf
                                        {{-- Aplicamos column-gap --}}
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 sm:grid-cols-3">

                                            <div class="sm:col-span-3 dark:text-gray-200 grid">
                                                <label for="cliente_id">{{ __('Client') }}</label>
                                                <select name="cliente_id" id="cliente_id"
                                                    class="rounded-lg dark:bg-gray-800 select2" required>
                                                    <option name="reiniciar" value="" disabled selected>
                                                        <p>
                                                            {{ __('Select') }}
                                                        </p>
                                                    </option>
                                                    @foreach ($personas as $persona)
                                                    <option value="{{ $persona->id }}">
                                                        {{ ($persona->nombre) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="dark:text-gray-200 grid">
                                                <label for="tipo_comprobante">{{ __('Receipt') }}</label>
                                                <select name="tipo_comprobante" id="tipo_comprobante"
                                                    class="rounded-lg dark:bg-gray-800" required>

                                                    @switch(old('tipo_comprobante'))
                                                    @case('Boleta')
                                                    <option value="Boleta" selected>
                                                        <p>
                                                            {{ __('Boleta') }}
                                                        </p>
                                                    </option>
                                                    <option value="Factura">
                                                        <p>
                                                            {{ __('Factura') }}
                                                        </p>
                                                    </option>
                                                    <option value="Ticket">
                                                        <p>
                                                            {{ __('Ticket') }}
                                                        </p>
                                                    </option>
                                                    @break
                                                    @case('Factura')
                                                    <option value="Boleta">
                                                        <p>
                                                            {{ __('Boleta') }}
                                                        </p>
                                                    </option>
                                                    <option value="Factura" selected>
                                                        <p>
                                                            {{ __('Factura') }}
                                                        </p>
                                                    </option>
                                                    <option value="Ticket">
                                                        <p>
                                                            {{ __('Ticket') }}
                                                        </p>
                                                    </option>
                                                    @break
                                                    @case('Ticket')
                                                    <option value="Factura">
                                                        <p>
                                                            {{ __('Factura') }}
                                                        </p>
                                                    </option>
                                                    <option value="Boleta">
                                                        <p>
                                                            {{ __('Boleta') }}
                                                        </p>
                                                    </option>
                                                    <option value="Ticket" selected>
                                                        <p>
                                                            {{ __('Ticket') }}
                                                        </p>
                                                    </option>
                                                    @break
                                                    @default
                                                    <option value="" disabled selected>
                                                        <p>
                                                            {{ __('Select') }}
                                                        </p>
                                                    </option>
                                                    <option value="Boleta">
                                                        <p>
                                                            {{ __('Boleta') }}
                                                        </p>
                                                    </option>
                                                    <option value="Factura">
                                                        <p>
                                                            {{ __('Factura') }}
                                                        </p>
                                                    </option>
                                                    <option value="Ticket">
                                                        <p>
                                                            {{ __('Ticket') }}
                                                        </p>
                                                    </option>
                                                    @break
                                                    @endswitch
                                                </select>
                                            </div>

                                            <div class=" dark:text-gray-200">
                                                <label for="serie_comprobante">{{ __('voucher series') }}</label>
                                                <input type="text" name="serie_comprobante" id="serie_comprobante"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('serie_comprobante') }}" required />
                                            </div>

                                            <div class="dark:text-gray-200">
                                                <label for="num_comprobante">{{ __('Voucher number') }}</label>
                                                <input type="text" name="num_comprobante" id="num_comprobante"
                                                    class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                    value="{{ old('num_comprobante') }}" placeholder="" required />
                                            </div>
                                            {{-- Venta --}}
                                            <div class="sm:col-span-3 ">
                                                <div class="">
                                                    <div class=" grid gap-4 grid-cols-2 md:grid-cols-3 dark:bg-gray-700 bg-gray-300 rounded-t-lg pt-12 px-2">
                                                        <div class="text-center col-span-2 md:col-span-3">
                                                            <h2
                                                                class="font-semibold dark:text-gray-200 text-xl text-gray-600">
                                                                {{ __('Sale Info') }}
                                                            </h2>
                                                        </div>
                                                        <div
                                                            class="col-span-2 md:col-span-3 dark:text-gray-200 flex flex-wrap sm:grid">
                                                            <label class="basis-full pb-2" for="p_id_articulo">{{
                                                                __('Article') }}</label>
                                                            <select name="p_id_articulo" id="p_id_articulo"
                                                                class="rounded-lg dark:bg-gray-800 basis-full select2">
                                                                <option value="" disabled selected>
                                                                    {{ __('Select') }}
                                                                </option>
                                                                @foreach ($articulos as $articulo)
                                                                    @if ($articulo->id == old('p_id_articulo'))
                                                                        <option selected value="{{ $articulo->id }}">
                                                                            {{ ($articulo->codigo.' '.$articulo->nombre) }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $articulo->id }}_{{ $articulo->stock }}_{{ $articulo->precio_promedio }}">
                                                                            {{ ($articulo->codigo.' '.$articulo->nombre) }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_cantidad">{{ __('Quantity') }}</label>
                                                            <input type="number" name="p_cantidad" id="p_cantidad" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" placeholder="" />
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_stock">{{ __('Stock') }}</label>
                                                            <input type="number" name="p_stock" id="p_stock"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50 cursor-no-drop"
                                                                disabled />
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_precio_venta">{{ __('Sale price')
                                                                }}</label>
                                                            <input type="number" name="p_precio_venta"
                                                                id="p_precio_venta"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50 cursor-no-drop" disabled />
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_descuento">{{ __('% Discount') }}</label>
                                                            <input type="number" name="p_descuento"
                                                                id="p_descuento"
                                                                class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50" placeholder="" />
                                                        </div>
                                                        <div class="col-span-2 text-center md:mt-6 dark:text-gray-200  md:text-right grid">
                                                            <div class="text-xs font-bold mb-3">
                                                                <button type="button" id="btn_add"
                                                                    class="px-4 py-2 bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                                    {{ __('Add Product') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-2 py-2 dark:bg-gray-700 bg-gray-300 overflow-x-auto md:overflow-x-visible rounded-b-lg">
                                                        <table id="detalles"
                                                            class="w-full table-auto border-spacing-1 border-separate">
                                                            <thead>
                                                                <tr>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('Options')}}
                                                                    </th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('Article')}}
                                                                    </th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('Quantity')}}
                                                                    </th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('Sale price')}}
                                                                    </th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('% Discount')}}
                                                                    </th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-300 rounded-lg">
                                                                        {{ __('SubTotal')}}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">
                                                                        {{ __('Total to pay:') }}
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">

                                                                    </td>
                                                                    <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">

                                                                    </td>
                                                                    <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">

                                                                    </td>
                                                                    <td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg">

                                                                    </td>
                                                                    <td class="text-center px-4 py-2 border dark:border-gray-500 dark:text-gray-300 rounded-lg lg:hover:bg-gray-800 hover:scale-105">
                                                                        <h4 id="total">$/. 0.00</h4>
                                                                        <input type="hidden" name="total_venta" id="total_venta">
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3 dark:text-gray-200 mx-6">
                                                <x-validation-errors />
                                            </div>

                                            <div class="sm:col-span-3 text-right">
                                                <div class="inline-flex items-end">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <a class="mr-4 text-xs font-bold"
                                                        href="{{ route('venta.index') }}">
                                                        <div
                                                            class="bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                            {{ __('Cancel') }}
                                                        </div>
                                                    </a>
                                                    <x-button class="mt-4" id="botones">
                                                        {{ __('Create Entry')}}
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
    <script>
        $('.select2').select2();
        $(document).ready(function(){
            $("#btn_add").click(function(){
                agregar();
            });
        });

        var contador = 0;
        total = 0;
        subtotal = [];
        $("#botones").hide();
        $('#p_id_articulo').change(mostrarValores);

        function mostrarValores(){
            datosArticulo = document.getElementById('p_id_articulo').value.split('_');
            $('#p_stock').val(datosArticulo[1]);
            $('#p_precio_venta').val(datosArticulo[2]);

            existePrecio = $("#p_precio_venta").val();
            if (!existePrecio!="") {
                Swal.fire({
                    title: "{{ __('No income yet?') }}",
                    text: "{{ __('To sell this item you must make an income') }}",
                    icon: "info",
                    color: textColor,
                    background: bodyColor,
                    confirmButtonColor: botonConfirmar
                });
                limpiar();
            }
        }

        function agregar(){
            datosArticulo = document.getElementById('p_id_articulo').value.split('_');

            articulo_id = datosArticulo[0];
            articulo = $("#p_id_articulo option:selected").text();
            cantidad = $("#p_cantidad").val();
            descuento = $("#p_descuento").val();
            precio_venta = $("#p_precio_venta").val();
            stock = $('#p_stock').val();
            
            if (articulo_id!="" && cantidad!="" && cantidad > 0 && precio_venta!="" && descuento!="" && stock>0){
                if (Number(stock) >= Number(cantidad)){
                    total_descuento = (descuento * (cantidad * precio_venta)/100);
                    subtotal[contador] = (cantidad * precio_venta) - total_descuento;

                    total = total + subtotal[contador];

                    var registro = '<tr class="dark:hover:bg-gray-800 lg:hover:scale-105" id="registro' + contador + '">' + 
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg text-center">' +
                            '<button type="button" class="bold hover:scale-105 px-8 py-1 bg-gray-800 dark:bg-red-600 text-gray-100 dark:text-gray-100 px-3 py-2 border-gray-200 rounded-lg uppercase" onclick="eliminar(' + contador + ')">' +
                                '{{ __('x') }}' +
                            '</button>' +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">' +
                            '<input type="hidden" name="articulo_id[]" value="' + articulo_id + '">' +
                            articulo +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">' +
                            '<input type="hidden" name="cantidad[]" value="' + cantidad + '">' +
                            cantidad +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">' +
                            '<input type="hidden" name="precio_venta[]" value="' + precio_venta + '">' +
                            precio_venta +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">' +
                            '<input type="hidden" name="descuento[]" value="' + total_descuento + '">' +
                            total_descuento +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-500 dark:text-gray-400 rounded-lg">' +
                            subtotal[contador] +
                        '</td>' +
                    '</tr>';
                    contador++;
                    limpiar();
                    $("#total").html("$/. " + total);
                    $("#total_venta").val(total);
                    evaluar();
                    $("#detalles").append(registro);
                } else {
                    Swal.fire({
                        title: "{{ __('out of stock') }}",
                        text: "{{ __('The number of items exceeds the limit of existing units') }}",
                        icon: "warning",
                        color: textColor,
                        background: bodyColor,
                        confirmButtonColor: botonConfirmar
                    });
                }
            } else {
                // alert("error al ingresar datos de registro, revise los datos del artículo");
                Swal.fire({
                    title: "{{ __('Check the entry fields') }}",
                    text: "{{ __('One or more input fields are missing') }}",
                    icon: "info",
                    color: textColor,
                    background: bodyColor,
                    confirmButtonColor: botonConfirmar
                });
            }
        }
            function limpiar(){
                $("#p_cantidad").val("");
                $("#p_precio_venta").val("");
                $("#p_descuento").val("");
                $("#p_stock").val("");
            }
            function evaluar(){
                if(total>0){
                    $("#botones").show();
                } else {
                    $("#botones").hide();
                }
            }
            function eliminar(index) {
                total = total - subtotal[index];
                $("#total").html("$/. " + total);
                $("#total_venta").val(total);
                $("#registro" + index).remove();
                evaluar();
            }
    </script>
    @endsection
</x-app-layout>
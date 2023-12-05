<x-app-layout>
    {{-- Slot con nombre --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Income') }}
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
                                    {{ __('Income') }}
                                </h2>
                                <p class="text-gray-500 dark:text-gray-200 mb-6">
                                    {{ __('Input details of the receipt to create') }}
                                </p>
                            </div>

                            <div class="bg-gray-200 dark:bg-gray-800 rounded-xl shadow-lg p-4 px-4 md:p-8 mb-6">
                                <div class="text-sm">
                                    <form method="POST" action=" {{ route('ingreso.store') }} ">
                                        @csrf
                                        
                                        {{-- Aplicamos column-gap --}}
                                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 sm:grid-cols-3">

                                            <div class="sm:col-span-3 dark:text-gray-200 grid">
                                                <label for="id_proveedor">{{ __('Provider') }}</label>
                                                <select name="id_proveedor" id="id_proveedor"
                                                    class="rounded-lg dark:bg-gray-800 select2">
                                                    <option value="" disabled selected>
                                                        <p>
                                                            {{ __('Select') }}
                                                        </p>
                                                    </option>
                                                    @foreach ($personas as $persona)
                                                    @if ($persona->id == old('id_proveedor'))
                                                    <option selected value="{{ $persona->id }}">
                                                        {{ ($persona->nombre) }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $persona->id }}">
                                                        {{ ($persona->nombre) }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="dark:text-gray-200 grid">
                                                <label for="tipo_comprobante">{{ __('Receipt') }}</label>
                                                <select name="tipo_comprobante" id="tipo_comprobante"
                                                    class="rounded-lg dark:bg-gray-800">

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
                                            {{-- Ingreso --}}
                                            <div class="sm:col-span-3 ">
                                                <div class="">
                                                    <div class=" grid gap-4 grid-cols-2 md:grid-cols-3 dark:bg-gray-700 bg-gray-300 rounded pt-12 px-2">
                                                        <div class="text-center col-span-2 md:col-span-3">
                                                            <h2 class="font-semibold dark:text-gray-200 text-xl text-gray-600">
                                                                {{ __('Income') }}
                                                            </h2>
                                                        </div>
                                                        <div class="col-span-2 md:col-span-3 dark:text-gray-200 flex flex-wrap sm:grid">
                                                            <label class="basis-full pb-2" for="p_id_articulo">{{ __('Article') }}</label>
                                                            <select name="p_id_articulo" id="p_id_articulo" class="rounded-lg dark:bg-gray-800 basis-full select2">
                                                                <option value="" disabled selected>
                                                                        {{ __('Select') }}
                                                                </option>
                                                                @foreach ($articulos as $articulos)
                                                                    @if ($articulos->id == old('p_id_articulo'))
                                                                    <option selected value="{{ $articulos->id }}">
                                                                        {{ ($articulos->codigo.' '.$articulos->nombre) }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $articulos->id }}">
                                                                        {{ ($articulos->codigo.' '.$articulos->nombre) }}
                                                                    </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_cantidad">{{ __('Quantity') }}</label> 
                                                            <input type="number" name="p_cantidad" id="p_cantidad"
                                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                            value="{{ old('p_p_cantidad') }}" placeholder="" />
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_precio_compra">{{ __('Purchase price') }}</label> 
                                                            <input type="number" name="p_precio_compra" id="p_precio_compra"
                                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                            value="{{ old('p_precio_compra') }}" placeholder="" />
                                                        </div>
                                                        <div class="dark:text-gray-200">
                                                            <label for="p_precio_venta">{{ __('Sale price') }}</label> 
                                                            <input type="number" name="p_precio_venta" id="p_precio_venta"
                                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                                            value="{{ old('p_precio_venta') }}" placeholder="" />
                                                        </div>
                                                        <div class="md:col-span-3 dark:text-gray-200 text-right grid">
                                                            <div class="text-xs font-bold mb-3">
                                                                <button type="button" id="btn_add" class="px-4 py-2 bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                                    {{ __('Add Product') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-2 py-2 dark:bg-gray-700 bg-gray-300 overflow-x-auto">
                                                        <table id="detalles" class="w-full overflow-hidden table-auto">
                                                            <thead>
                                                                <tr>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('Options')}}</th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('Article')}}</th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('Quantity')}}</th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('Purchase price')}}</th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('Sale price')}}</th>
                                                                    <th class="px-4 py-2 border dark:border-gray-400 dark:text-gray-200">{{ __('SubTotal')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        TOTAL
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        
                                                                    </td>
                                                                    <td class="px-4 py-2 border dark-border-gray-400 dark:text-gray-400">
                                                                        <h4 id="total">$/. 0.00</h4>
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
                                                <div class="inline-flex items-end" id="botones">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <a class="mr-4 text-xs font-bold"
                                                        href="{{ route('tienda.ingreso') }}">
                                                        <div class="bg-gray-800 dark:bg-gray-100 text-gray-100 dark:text-gray-800 px-3 py-2 border rounded-lg uppercase">
                                                            {{ __('Cancel') }}
                                                        </div>
                                                    </a>
                                                    <x-button class="mt-4">
                                                        {{ __('Create Income')}}
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
        <script>
            $('.select2').select2();
        </script>
        <script>
            $(document).ready(function(){
                $("#btn_add").click(function(){
                    agregar();
                });
            });

            var contador = 0;
            total = 0;
            subtotal = [];
            $("#botones").hide();

            function agregar(){
                id_articulo = $("#p_id_articulo").val();
                articulo = $("#p_id_articulo option:selected").text();
                cantidad = $("#p_cantidad").val();
                precio_compra = $("#p_precio_compra").val();
                precio_venta = $("#p_precio_venta").val();
                if (id_articulo!="" && articulo!="" && cantidad!="" && precio_compra!="" && precio_venta!=""){
                    subtotal[contador] = (cantidad*precio_compra);
                    total = total+subtotal[contador];

                    var registro = '<tr class="hover:bg-gray-800 hover:scale-105" id="registro' + contador + '">' + 
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            '<button type="button" class="bold hover:scale-105 px-5 py-2 bg-gray-800 dark:bg-red-600 text-gray-100 dark:text-gray-100 px-3 py-2 border-gray-200 rounded-lg uppercase" onclick="eliminar(' + contador + ')">' +
                                '{{ __('x') }}' +
                            '</button>' +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            '<input type="hidden" name="id_articulo[]" value="' + id_articulo + '">' +
                            articulo +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            '<input type="hidden" name="cantidad[]" value="' + cantidad + '">' +
                            cantidad +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            '<input type="hidden" name="precio_compra[]" value="' + precio_compra + '">' +
                            precio_compra +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            '<input type="hidden" name="precio_venta[]" value="' + precio_venta + '">' +
                            precio_venta +
                        '</td>' +
                        '<td class="px-4 py-2 border dark:border-gray-400 dark:text-gray-400">' +
                            subtotal[contador] +
                        '</td>' +
                    '</tr>';
                    contador++;
                    limpiar();
                    $("#total").html("$/. " + total);
                    evaluar();
                    $("#detalles").append(registro);
                } else {
                    alert("error al ingresar datos de registro");
                }
            }
            function limpiar(){
                $("#p_cantidad").val("");
                $("#p_precio_compra").val("");
                $("#p_precio_venta").val("");
                $("#p_id_articulo option:selected").text("");
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
                $("#registro" + index).remove();
                $("#total").html("$/. " + total);
                evaluar();
            }
        </script>
    @endsection
</x-app-layout>
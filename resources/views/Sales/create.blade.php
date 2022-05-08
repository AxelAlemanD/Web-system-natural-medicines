@extends('app')


@section('extra-css')
<style>
	.quantity, #estimadoTotal{
		text-align: right;
	}

	#estimadoTotal{
		border:none;
		font-weight: bold;
		font-size: 22px;
		color: #7871df;
	}

	.deshabilita{
	  pointer-events:none !important;
	}

	#mytable{
		border-collapse: collapse;
		border-radius: 15px;
		-webkit-box-shadow: 2px 2px 5px rgb(230, 228, 228);
 		-moz-box-shadow: 2px 2px 5px rgb(230, 228, 228);
	}

	#mytable thead th{
		color: #fff;
		background-color: #6c7ae0;
	}
	#mytable thead th:first-child{
		border-top-left-radius: 15px;
	}
	#mytable thead th:last-child{
		border-top-right-radius: 15px;
	}


	
	/* Estilos para contenido de Select de platillos */
	.opciones{
		display: flex;
		margin-top: 1.5%;
		width: 100%;
	}
	.opcionImg{
		width:100px;
		height:80px;
		border-radius: 5px;
		margin-right: 2%;
	}
	.opcionInfo{
		width: 500px;
	}
	.opcionTxt{
		font-weight:bold;
		font-size:12pt;
	}
	.descrpition{
		margin-top: -25px;
	}


	/* Modificar tamaño de los Select */
	.carclass .select2-selection__rendered {
            line-height: 100px !important;
    }

   	.carclass.select2-container .select2-selection--single {
            height: 100px !important;
    }

    .carclass .select2-selection__arrow {
            height: 100px !important;
    }
</style>

@endsection


@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
			<h4 class="page-title">Agregar venta</h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Ventas</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
			<li class="text-muted mb-1 fs-16">Agregar venta</li>
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		<form action="{{route('ventas.store')}}" method="POST">	
			@csrf
			<div class="row">
				{{-- Cliente --}}
				<div class="col">
					<div class="form-group">
						<label class="form-label">Cliente:</label>
						<select class="form-control custom-select select2 @error('user_id') is-invalid @enderror" data-placeholder="Selecciona un cliente" id="select_cliente" name="user_id" required>
							<option value="-1" selected disabled>Selecciona un cliente</option>
							@foreach($customers as $customer)
								<option value="{{$customer->id}}">{{$customer->getFullName()}}</option>
							@endforeach
						</select>
						@error('user_id')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
						@enderror
					</div>
				</div>
			</div>
			
			{{-- Tabla de productos --}}
			<div class="row text-center mt-7">
				<h4 class="font-weight-bold">Lista de productos</h4>
			</div>
			<div class="row mt-4 mb-5">
				<div class="table-responsive">
					<table class="table  text-wrap border-bottom table-borderless" id="mytable">
						<thead>
							<tr>
								<th width="70%">Producto</th>
								<th class="text-center" width="10%" align="right">Cantidad</th>
								<th class="text-center" width="10%" align="right">Precio</th>
								<th class="text-center" width="10%" align="right">Total</th>
								<th> </th>
							</tr>
						</thead>
						<tbody id="lista_productos">
							<tr onchange="getCostProduct(event);" class="rowProduct">
								<td width="70%" style="height: 150px;">
										<select name="products[]" class="form-control productos" onchange="getCostProduct(event);" required style="width: 100%">
											@foreach ($products as $product)
												@if ($product->quantity <= 0)
													<option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta" disabled>{{$product->name}} $ No disponible</option>
												@else
													{{-- <option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta">{{$product->name}} $ {{$product->description}}</option> --}}
													<option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta">{{$product->name}} $ Disponible: {{$product->quantity}}</option>
												@endif
									   		@endforeach
										<option value="-1" class="text-muted" selected disabled>Selecciona un producto</option>
									</select>
								</td>

								<td width="10%"><input type="number" class="form-control mb-md-1 mb-5 quantity" id="quantity" value=1 min="1" onchange="getCostProduct(event);" onkeyup="getCostProduct(event);" align="right" name="quantities[]" required></td>
								<td width="10%" class="price" align="right">$0.00</td>
								<td width="10%" class="amounts" align="right">$0.00</td>
								<td width="10%">
									<a class="action-btns1" title="Remover" onclick="removeProduct(event)">
										<i class="text-danger">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
												<line x1="18" y1="6" x2="6" y2="18"></line>
												<line x1="6" y1="6" x2="18" y2="18"></line>
											</svg>
										</i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-4">
					{{-- Agregar producto --}}
					<button type="button" class="btn btn-outline-info mr-2" onclick="addProduct(event)" id="btnAddProduct">Agregar producto</button>
				</div>
			</div>

			<div class="row text-center mb-5">
				{{-- Total a pagar --}}
				<h6 class="mb-1 fs-17 text-muted">Total:</h6>
				<input class="form-control mb-md-1 mb-5 fs-17 text-center" id="totalSale" name="total_amount" value="$0.00" readonly style="background: none; padding: 3%; border:none;">
			</div>
			{{-- <div class="row">
				Catidad pagada
				<div class="col">
					<x-field label="Cantidad pagada" name="amount_paid" value="{{old('amount_paid')}}" type="number" placeholder="$0.00" other="required step=0.01 onchange=getChangeOrPending(event); onkeyup=getChangeOrPending(event);"/>
				</div>
			</div> --}}
			<div class="row text-center mb-5">
				{{-- Total a pagar --}}
				<h6 class="mb-1 fs-17 text-muted">Cantidad pagada:</h6>
				<input class="form-control @error("amount_paid") is-invalid @enderror" placeholder="$0.00" name="amount_paid" type="number" value='{{old('amount_paid')}}' required step="0.01" onchange="getChangeOrPending(event);" onkeyup="getChangeOrPending(event);" style="background: none; padding: 3%; text-align: center;">
    			@error("amount_paid")
    			    <span class="invalid-feedback" role="alert">
    			        {{ $message }}
    			    </span>
    			@enderror
				{{-- <input class="form-control mb-md-1 mb-5 fs-17 text-center" id="totalSale" name="total_amount" value="$0.00" readonly style="background: none; padding: 3%"> --}}
			</div>

			{{-- Cambio o pendiente --}}
			<div class="row text-center mb-5">
				{{-- <label class="form-label" id="titleChangeOrPending">Cambio</label> --}}
				<h6 class="mb-1 fs-17 text-muted" id="titleChangeOrPending">Cambio</h6>
				{{-- <input class="form-control" id="amountChangeOrPending" value="$0.00" readonly> --}}
				<input class="form-control mb-md-1 mb-5 fs-17 text-center" id="amountChangeOrPending" value="$0.00" readonly style="background: none; padding: 3%; border:none;">
			</div>

			<div class="card-footer">
				<div class="row">
					<button type="submit" class="btn btn-primary btn-lg btn-block" id="enviar">
						Realizar venta
					</button>
				</div>
			</div>
		</form>
	</div>
</div> 

<!-- FIN CONTENIDO -->
@endsection

@section('extra-script')
<script src="{{ asset('js/select2Template.js') }}"></script>
<script src="{{ asset('js/number2Money.js') }}"></script>



<script>

	/*
		Get the total amount of a product
	*/
	function getCostProduct(event){
		const productos		= @json($products);
		let currentRow		= event.target.closest(".rowProduct");
		let selectedProduct	= currentRow.querySelector('.productos').querySelector('option:checked');
		let quantity		= currentRow.querySelector('.quantity');
		let priceProduct	= currentRow.querySelector('.price');
		let totalAmount		= currentRow.querySelector('.amounts');

		// Assign the values to the corresponding fields
		productos.forEach( function(producto, indice, array) {
			if(selectedProduct.value == producto.id){
				try {
					defineMaxQuantity(producto, quantity);
					priceProduct.innerText	= numberToMoney(producto.price);
					totalAmount.innerText	= numberToMoney(quantity.value * producto.price);
					totalCostSale();
				} catch (error) {
				}
			}
		});
		
	}


	/*
		Get the total amount of a product
	*/
	function defineMaxQuantity(product, quantityInput){
		quantityInput.setAttribute('max', product.quantity);
		if (parseInt(quantityInput.value, 10) > product.quantity) {
			quantityInput.value = product.quantity;
		}
	}


/*
	Add a product to the table
*/
function addProduct(event){
	// Add new row
	let tabla			= document.getElementById("lista_productos");
	let nuevaFila		= tabla.insertRow(-1);
	nuevaFila.setAttribute('onchange', 'getCostProduct(event);');
	nuevaFila.setAttribute('class', 'rowProduct');

	nuevaFila.innerHTML 	=	'<td width="70%" style="height: 150px;">'+
								'		<select name="products[]" class="form-control productos" onchange="getCostProduct(event);" required style="width: 100%">'+
								'			@foreach ($products as $product)'+
								'				@if ($product->quantity <= 0)'+
								'					<option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta" disabled>{{$product->name}} $ No disponible</option>'+
								'				@else'+
								'					{{-- <option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta">{{$product->name}} $ {{$product->description}}</option> --}}'+
								'					<option data-img_src="{{asset($product->url_image)}}" value="{{$product->id}}" class="productosVenta">{{$product->name}} $ Disponible: {{$product->quantity}}</option>'+
								'				@endif'+
								'			@endforeach'+
								'		<option value="-1" class="text-muted" selected disabled>Selecciona un producto</option>'+
								'	</select>'+
								'</td>'+
								'<td width="10%"><input type="number" class="form-control mb-md-1 mb-5 quantity" id="quantity" value=1 min="1" onchange="getCostProduct(event);" onkeyup="getCostProduct(event);" align="right" name="quantities[]" required></td>'+
								'<td width="10%" class="price" align="right">$0.00</td>'+
								'<td width="10%" class="amounts" align="right">$0.00</td>'+
								'<td width="10%">'+
								'	<a class="action-btns1" title="Remover" onclick="removeProduct(event)">'+
								'		<i class="text-danger">'+
								'			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">'+
								'				<line x1="18" y1="6" x2="6" y2="18"></line>'+
								'				<line x1="6" y1="6" x2="18" y2="18"></line>'+
								'			</svg>'+
								'		</i>'+
								'	</a>'+
								'</td>';
		
	
	// Apply styles to select aggregate
	var options = {
		'templateSelection': custom_template,
		'templateResult': custom_template,
	}
	$('.productos').select2(options);

	let selectsProductos = document.querySelectorAll('.productos');

	for (let index = 0; index < $('.productos').length; index++) {
		selectsProductos[index].nextSibling.classList.add("carclass");
	}
}




/*
	Remove the current product
*/
function removeProduct(event){
	currentRow = event.target.closest(".rowProduct");
	currentRow.remove();
	totalCostSale();
}

/*
	Get the total cost of the sale
*/
function totalCostSale() {
	total = document.getElementById('totalSale');
	amounts = document.getElementsByClassName('amounts');
	sum = 0;
	for (let i = 0; i < amounts.length; i++) {
		sum += moneyToNumber(amounts[i].innerText);
	}
	total.value = numberToMoney(sum);
}

/**
 * Gets the amount to return or the pending amount to complete the payment
*/
function getChangeOrPending(event){
	let title	= document.querySelector('#titleChangeOrPending');
	let amount	= document.querySelector('#amountChangeOrPending');
	let paid	= parseInt(document.querySelector('[name="amount_paid"]').value, 10);
	let total	= moneyToNumber(document.querySelector('[name="total_amount"]').value);

	if(paid < total){
		title.innerText = 'Debe';
		amount.value = numberToMoney(total - paid);
		amount.style.color = 'red';
	}
	else if(paid == total){
		title.innerText = 'Pagado';
		amount.value = numberToMoney(total - paid);
		amount.style.color = '#263871';
	}
	else{
		title.innerText = 'Cambio';
		amount.value = numberToMoney(Math.abs(total - paid));
		amount.style.color = 'green';
	}
}
</script>

@endsection
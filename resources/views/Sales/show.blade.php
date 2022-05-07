@extends('app')

@section('content')

<!-- CABECERA -->
<div class="page-header d-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Ver venta #{{$sale->id}}</h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Ventas</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
            <li class="text-muted mb-1 fs-16">Ver venta #{{$sale->id}}</li>
        </ul>
    </div>

	<div class="page-rightheader" style="margin-top: -7%">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list d-flex">
				{{-- Actualizar pago --}}
				<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updatePay">
                    <i class="text-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
							<line x1="12" y1="1" x2="12" y2="23"></line>
							<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
						</svg>
					</i>
                    Actualizar pago
                </button>
				{{-- Eliminar venta --}}
				{{-- <form action="{{route('ventas.destroy', $sale->id)}}" method="post">
					@csrf
					@method('DELETE')
					<button class="btn ml-4" data-toggle="tooltip" data-placement="top" title="Eliminar" type="submit" style="background: none">
						<i class="text-danger text-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
								<polyline points="3 6 5 6 21 6"></polyline>
								<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
								<line x1="10" y1="11" x2="10" y2="17"></line>
								<line x1="14" y1="11" x2="14" y2="17"></line>
							</svg>
						</i>
					</button>
				</form> --}}
            </div>
        </div>
    </div>
</div>
<!-- FIN CABECERA -->

@include('Sales.updatePay') <!-- Include modal payment -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		<div class="d-flex">
			{{-- INFORMACIÓN DEL CLIENTE --}}
			<h4 class="font-weight-bold">Información del cliente</h4>
			{{-- Cambiar cliente --}}
			<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#changeClient" title="Cambiar cliente" style="margin-top: -3%">
				<i class="text-primary">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
						<path d="M12 20h9"></path>
						<path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
					</svg>
				</i>
			</button>
		</div>
		{{-- Nombre --}}
		<div class="row mt-3">
			<div class="col">
				<label class="fs-14">Nombre del cliente</label>
				<h5 class="font-weight-bold">{{$sale->user->getFullName()}}</h5>
			</div>
		</div>
		{{-- Numero de telefono --}}
		<div class="row mt-3">
			<div class="col">
				<label class="fs-14">Número de telefono</label>
				<h5 class="font-weight-bold">{{$sale->user->phone_number}}</h5>
			</div>
		</div>
		{{-- Direccion --}}
		<div class="row mt-3">
			<div class="col">
				<label class="fs-14">Dirección</label>
				<h5 class="font-weight-bold">{{$sale->user->address}}</h5>
			</div>
		</div>

		{{-- INFORMACIÓN DE LA VENTA --}}
		<h4 class="font-weight-bold mt-7">Información de la venta</h4>

		<div class="row mt-3">
			<div class="col">
				<label class="fs-14">Fecha</label>
				<h5 class="font-weight-bold">{{$sale->getDate()}}</h5>
			</div>
			<div class="col">
				<label class="fs-14">Total</label>
				<h5 class="font-weight-bold">{{$sale->numberToCurrency($sale->total_amount)}}</h5>
			</div>
			<div class="col">
				<label class="fs-14">Pendiente</label>
				<h5 class="font-weight-bold">{{$sale->numberToCurrency($sale->total_amount - $sale->amount_paid)}}</h5>
			</div>
		</div>
		{{-- Lista de productos --}}
		<div class="row mt-5">
			<div class="row mb-7">
				<h4 class="font-weight-bold mt-7 text-center">Lista de productos</h4>
				<div class="table-responsive mb-7">
                    <table class="table table-vcenter text-wrap border-bottom mb-7" id="project-list">
						<thead>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Total</th>
						</thead>
                        <tbody>
							@foreach ($sale->products as $product)
								<tr>
                            	    <td>
										<div class="d-flex">
											<img src="{{asset($product->url_image)}}"  class="avatar avatar-xxl bradius mr-3">
											<div class="mr-3 mt-0 mt-sm-1 d-block">
												<h6 class="mb-1 font-weight-bold">{{$product->name}}</h6>
											</div>
										</div>
									</td>
                            	    <td>
                            	        {{$product->getPrice()}}
                            	    </td>
									<td>
										{{$product->pivot->quantity}}
									</td>
									<td>
										{{$product->getTotal($product->pivot->quantity)}}
									</td>
									<td>
										<div class="d-flex">
											{{-- Devolver producto --}}
											<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#returnProduct" title="Devolver producto">
												<i class="text-success">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw">
														<polyline points="1 4 1 10 7 10"></polyline>
														<path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
													</svg>
												</i>
											</button>
										</div>
										{{-- Ver producto --}}
										<a href="{{route('productos.show', $product->id)}}" class="btn" data-toggle="tooltip" data-placement="top" title="Ver producto" class="btn">
											<i class="text-primary">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg>
											</i>
										</a>
									</td>
                            	</tr>
							@endforeach
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
		{{-- Total --}}
		<div class="row mt-7 fixed-bottom" style="margin-bottom:-1rem;">
			<div class="card">
				<div class="card-body text-center">
					<h6 class="mb-1 fs-17 text-muted">Total:</h6>
					<h3 class="font-weight-bold" style="color:#6A54DF;">{{$sale->numberToCurrency($sale->total_amount)}}</h3>
					@if ($sale->status->name == 'Pagado')
                        <span class="badge bg-primary-transparent border border-primary rounded-pill">{{$sale->status->name}}</span>
                    @elseif ($sale->status->name == 'En proceso')
                        <span class="badge bg-warning-transparent border border-warning rounded-pill">{{$sale->status->name}}</span>
                    @else
                        <span class="badge bg-danger-transparent border border-danger rounded-pill">{{$sale->status->name}}</span>
                    @endif
				</div>
			</div>
		</div>
</div> 

<!-- FIN CONTENIDO -->
@endsection
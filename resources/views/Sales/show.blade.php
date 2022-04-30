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

	<div class="page-rightheader">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list d-flex">
				<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createPublication">
                    <i class="text-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
							<path d="M12 20h9"></path>
							<path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
						</svg>
					</i>
                    Actualizar pago
                </button>
				<form action="{{route('ventas.destroy', $sale->id)}}" method="post">
					@csrf
					@method('DELETE')
					<button class="action-btns1 ml-4" data-toggle="tooltip" data-placement="top" title="Eliminar" type="submit" style="background: none">
						<i class="text-danger text-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
								<polyline points="3 6 5 6 21 6"></polyline>
								<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
								<line x1="10" y1="11" x2="10" y2="17"></line>
								<line x1="14" y1="11" x2="14" y2="17"></line>
							</svg>
						</i>
					</button>
				</form>
            </div>
        </div>
    </div>
</div>
<!-- FIN CABECERA -->


<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		{{-- INFORMACIÓN DEL CLIENTE --}}
		<h4 class="font-weight-bold">Información del cliente</h4>
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
		{{-- Hisstorial de compras --}}
		<div class="row mt-5">
			<div class="row">
				<div class="table-responsive">
                    <table class="table table-vcenter text-wrap border-bottom" id="project-list">
						<thead>
							<td colspan="4">
								<h5 class="font-weight-bold text-center">Lista de productos</h5>
							</td>
						</thead>
                        <tbody>
							@foreach ($sale->products as $product)
								<tr>
                            	    <td>
										<div class="d-flex">
											<img src="{{asset($product->url_image)}}"  class="avatar avatar-xxl bradius mr-3">
											<div class="mr-3 mt-0 mt-sm-1 d-block">
												<h6 class="mb-1 font-weight-bold">{{$product->name}}</h6>
												<p class="mb-0 fs-12">{{$product->description}}</p>
											</div>
										</div>
									</td>
                            	    <td>
                            	        {{$sale->getDate()}}
                            	    </td>
									<td>
										{{$product->pivot->quantity}}
									</td>
									<td>
										{{$product->getTotal($product->pivot->quantity)}}
									</td>
									<td>
										<a href="{{route('productos.show', $product->id)}}" class="action-btns1" data-toggle="tooltip" data-placement="top" title="Ver">
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
</div> 

<!-- FIN CONTENIDO -->
@endsection
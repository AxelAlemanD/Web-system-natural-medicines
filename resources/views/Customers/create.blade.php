@extends('app')


@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
		@if (!isset($customer))
		<h4 class="page-title">Agregar cliente</h4>	
		@else
		<h4 class="page-title">Editar cliente #{{$customer->id}}</h4>
		@endif
		
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Clientes</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
			@if (!isset($customer))
			<li class="text-muted mb-1 fs-16">Agregar cliente</li>	
			@else
			<li class="text-muted mb-1 fs-16">Editar cliente #{{$customer->id}}</li>
			@endif
			
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		@if (!isset($customer))
		<form action="{{route('clientes.store')}}" method="POST">		
		@else
		<form action="{{route('clientes.update', $customer->id)}}" method="POST">	
			@method('PUT')
		@endif
			@csrf
			<div class="row">
				{{-- Nombre --}}
				<div class="col">
					@if (!isset($customer))
					<x-field label="Nombre" name="first_name" value="{{old('first_name')}}" type="text" placeholder="Ingresa nombre de cliente"/>	
					@else
					<x-field label="Nombre" name="first_name" value="{{$customer->first_name}}" type="text" placeholder="Ingresa nombre de cliente"/>
					@endif
				</div>
			</div>
			<div class="row">
				{{-- Apellidos --}}
				<div class="col">
					@if (!isset($customer))
					<x-field label="Apellidos" name="last_name" value="{{old('last_name')}}" type="text" placeholder="Ingresa apellidos del cliente"/>
					@else
					<x-field label="Apellidos" name="last_name" value="{{$customer->last_name}}" type="text" placeholder="Ingresa apellidos del cliente"/>
					@endif
				</div>
			</div>
			<div class="row">
				{{-- Apellidos --}}
				<div class="col">
					@if (!isset($customer))
					<x-field label="Número de telefono" name="phone_number" value="{{old('phone_number')}}" type="text" placeholder="Ej. 8341001234"/>
					@else
					<x-field label="Número de telefono" name="phone_number" value="{{$customer->phone_number}}" type="text" placeholder="Ej. 8341001234"/>
					@endif
				</div>
			</div>
			<div class="row">
				{{-- Dirección --}}
				<div class="col">
					@if (!isset($customer))
					<x-text-area label="Dirección" name="address" content="{{old('address')}}" rows=4 placeholder="Ej. Gutierrez de Lara"/>
					@else
					<x-text-area label="Dirección" name="address" content="{{$customer->address}}" rows=4 placeholder="Ej. Gutierrez de Lara"/>
					@endif
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<button type="submit" class="btn btn-primary btn-lg btn-block" id="enviar">
						<i class="feather feather-save sidemenu_icon"></i>
						Guardar
					</button>
				</div>
			</div>
		</form>
	</div>
</div> 

<!-- FIN CONTENIDO -->
@endsection

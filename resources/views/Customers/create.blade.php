@extends('app')


@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
		<h4 class="page-title">Agregar cliente</h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Clientes</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
			<li class="text-muted mb-1 fs-16">Agregar cliente</li>
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		<form action="{{route('clientes.store')}}" method="POST">	
			@csrf
			<div class="row">
				{{-- Nombre --}}
				<div class="col">
					<x-field label="Nombre" name="first_name" value="{{old('first_name')}}" type="text" placeholder="Ingresa nombre de cliente"/>
				</div>
			</div>
			<div class="row">
				{{-- Apellidos --}}
				<div class="col">
					<x-field label="Apellidos" name="last_name" value="{{old('last_name')}}" type="text" placeholder="Ingresa apellidos del cliente"/>
				</div>
			</div>
			<div class="row">
				{{-- Apellidos --}}
				<div class="col">
					<x-field label="Número de telefono" name="phone_number" value="{{old('phone_number')}}" type="text" placeholder="Ej. 8341001234"/>
				</div>
			</div>
			<div class="row">
				{{-- Dirección --}}
				<div class="col">
					<x-text-area label="Dirección" name="address" content="{{old('address')}}" rows=4 placeholder="Ej. Gutierrez de Lara"/>
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

@section('extra-script')
<script type="text/javascript">
	const previewImage = e => {
		const preview = document.getElementById('image');
		preview.src = URL.createObjectURL(e.target.files[0]);
		preview.onload = () => URL.revokeObjectURL(preview.src);
	};
</script>

<script>
	$(document).ready(function() {
		$('.select2-multiple').select2({
			tags: true
		});
	});
</script>

@endsection
@extends('app')

@section('extra-css')
	<style>
		.select2-container--default .select2-selection--multiple .select2-selection__choice{
			background-color: rgba(51,102,255,.1)!important;
    		border: 1px solid #36f!important;
			border-radius: 50rem !important;
			color: #36f!important;
		}
	</style>
@endsection


@section('content')

<!-- CABECERA -->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Agregar producto</h4>
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Productos</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
            <li class="text-muted mb-1 fs-16">Agregar producto</li>
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		<form action="{{route('productos.store')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="row">
				{{-- Imagen --}}
				<div class="col">
					<div class="box-widget widget-user">
						<div class="widget-user-image d-flex">
							<img src="{{asset('images/image.svg')}}" class="avatar avatar-xxl bradius mr-3" alt="Foto producto" name="image" id="image">
							<div class="ml-sm-3 mt-4">
								<x-field label="Foto del producto" name="url_image" type="file" placeholder="Seleccionar imagen" events='onchange=previewImage(event)' />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				{{-- Nombre --}}
				<div class="col">
					<x-field label="Nombre" name="name" type="text" placeholder="Ingresa nombre de producto"/>
				</div>
			</div>
			<div class="row">
				{{-- Descripción --}}
				<div class="col">
					<x-text-area label="Descripción" name="description" rows=4 placeholder="Ingresa una descripción"/>
				</div>
			</div>
			<div class="row">
				{{-- Precio --}}
				<div class="col-6">
					<x-field label="Precio" name="price" type="number" placeholder="$00.00" events='step=0.01'/>
				</div>
				{{-- Cantidad --}}
				<div class="col-6">
					<x-field label="Cantidad" name="quantity" type="number" placeholder="00"/>
				</div>
			</div>
			<div class="row">
				<div class="col">
				{{-- Categorias --}}
					<div class="form-group">
						<label class="form-label">Categorias:</label>
						<select name="categories[]"  class="form-control custom-select select2-multiple @error('categories') is-invalid @enderror" data-placeholder="Agregar categoria"  multiple="multiple">
							<option label="Agregar etiqueta"></option>
							@foreach ($categories as $category)
								<option value="{{$category->name}}">{{$category->name}}</option>
							@endforeach
						</select>
						@error('categories')
    					    <span class="invalid-feedback" role="alert">
    					        {{ $message }}
    					    </span>
    					@enderror
					</div>
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
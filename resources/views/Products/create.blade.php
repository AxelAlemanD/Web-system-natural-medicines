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
		@if (!isset($product))
			<h4 class="page-title">Agregar producto</h4>
		@else
			<h4 class="page-title">Editar producto #{{$product->id}}</h4>
		@endif
        <ul class="breadcrumb">
            <li class="mb-1 fs-16"><a href="{{ url()->previous() }}">Productos</a></li>
            <li class="text-muted mb-1 fs-16 ml-2 mr-2"> / </li>
			@if (!isset($product))
				<li class="text-muted mb-1 fs-16">Agregar producto</li>
			@else
				<li class="text-muted mb-1 fs-16">Editar producto #{{$product->id}}</li>
			@endif
        </ul>
    </div>
</div>
<!-- FIN CABECERA -->

<!-- CONTENIDO -->
<div class="row">
	<div class="col-xl-12 col-md-12 col-lg-12">
		@if (!isset($product))
		<form action="{{route('productos.store')}}" method="POST" enctype="multipart/form-data">	
		@else
		<form action="{{route('productos.update', $product->id)}}" method="POST" enctype="multipart/form-data">
			@method('PUT')
		@endif
			@csrf
			<div class="row">
				{{-- Imagen --}}
				<div class="col">
					<div class="box-widget widget-user">
						<div class="widget-user-image d-flex">
							@if (!isset($product))
							<img src="{{asset('images/image.svg')}}" class="avatar avatar-xxl bradius mr-3" alt="Foto producto" name="image" id="image">	
							@else
							<img src="{{asset($product->url_image)}}" class="avatar avatar-xxl bradius mr-3" alt="Foto producto" name="image" id="image">
							@endif
							
							<div class="ml-sm-3 mt-4">
								@if (!isset($product))
									<x-field label="Foto del producto" name="url_image" value="{{old('url_image')}}" type="file" placeholder="Seleccionar imagen" events='onchange=previewImage(event)' />
								@else
									<x-field label="Foto del producto" name="url_image" value="{{$product->url_image}}" type="file" placeholder="Seleccionar imagen" events='onchange=previewImage(event)' />
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				{{-- Nombre --}}
				<div class="col">
					@if (!isset($product))
						<x-field label="Nombre" name="name" value="{{old('name')}}" type="text" placeholder="Ingresa nombre de producto"/>
					@else
						<x-field label="Nombre" name="name" value="{{$product->name}}" type="text" placeholder="Ingresa nombre de producto"/>
					@endif
					
				</div>
			</div>
			<div class="row">
				{{-- Descripción --}}
				<div class="col">
					@if (!isset($product))
					<x-text-area label="Descripción" name="description" content="{{old('description')}}" rows=4 placeholder="Ingresa una descripción"/>
					@else
					<x-text-area label="Descripción" name="description" content="{{$product->description}}" rows=4 placeholder="Ingresa una descripción"/>
					@endif
					
				</div>
			</div>
			<div class="row">
				{{-- Precio --}}
				<div class="col-6">
					@if (!isset($product))
					<x-field label="Precio" name="price" value="{{old('price')}}" type="number" placeholder="$00.00" events='step=0.01'/>
					@else
					<x-field label="Precio" name="price" value="{{$product->price}}" type="number" placeholder="$00.00" events='step=0.01'/>
					@endif
					
				</div>
				{{-- Cantidad --}}
				<div class="col-6">
					@if (!isset($product))
					<x-field label="Cantidad" name="quantity" value="{{old('quantity')}}" type="number" placeholder="00"/>
					@else
					<x-field label="Cantidad" name="quantity" value="{{$product->quantity}}" type="number" placeholder="00"/>						
					@endif
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
								@if (!isset($product))
									<option value="{{$category->name}}">{{$category->name}}</option>
								@else
									@if ($product->categories->contains($category))
										<option value="{{$category->name}}" selected>{{$category->name}}</option>
									@else
										<option value="{{$category->name}}">{{$category->name}}</option>
									@endif
								@endif
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
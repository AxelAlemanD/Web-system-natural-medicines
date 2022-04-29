@extends('app')

@section('content')

<!-- CABECERA -->
<div class="page-header d-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Lista de productos</h4>
    </div>
    <div class="page-rightheader ml-md-auto">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list">
                <a href="{{route('productos.create')}}" class="btn btn-outline-primary mr-3">
                    Agregar producto</a>
            </div>
        </div>
    </div>
</div>
<!-- FIN CABECERA -->




<!-- CONTENIDO -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        
        @foreach ($products as $product)
        <a href="{{route('productos.show', $product->id)}}">
            <div class="row border-bottom mb-3">
                <div class="d-flex">
                    <img src="{{asset($product->url_image)}}"  class="avatar avatar-xxl bradius mr-3">
                    <div class="mr-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1 font-weight-bold">{{$product->name}}</h6>
                        <p class="mb-0 fs-12">{{$product->description}}</p>
                        <div class="row mt-3">
                            <div class="col float-left">
                                <h6 class="fs-14 text-primary">{{$product->getPrice()}}</h6>
                            </div>
                            <div class="col float-right text-right">
                                <p class="text-muted fs-13">Disponibles: {{$product->quantity}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach    
    </div>
</div>
<!-- FIN CONTENIDO -->
@endsection
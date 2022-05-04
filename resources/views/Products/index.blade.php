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
                <div class="row d-flex">
                    <div class="col-2" style="margin-right: -7%;">
                            <img src="{{asset($product->url_image)}}"  class="avatar avatar-xxl bradius mr-3">
                    </div>
                    <div class="col-10 d-block">
                        <h6 class="mb-1 font-weight-bold">{{$product->name}}</h6>
                        <p class="mb-0 fs-12">{{$product->description}}</p>
                        <div class="mt-3">
                            @isset($product->categories)
                                @foreach ($product->categories as $category)
                                    <span class="badge bg-primary-transparent border border-primary rounded-pill">{{$category->name}}</span>    
                                @endforeach
                            @endisset
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 text-left">
                                <h6 class="fs-14 text-primary">{{$product->getPrice()}}</h6>
                            </div>
                            <div class="col-6 text-right">
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
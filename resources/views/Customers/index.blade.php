@extends('app')

@section('content')

<!-- CABECERA -->
<div class="page-header d-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Lista de clientes</h4>
    </div>
    <div class="page-rightheader ml-md-auto">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list">
                <a href="{{route('clientes.create')}}" class="btn btn-outline-primary mr-3">
                    Agregar cliente</a>
            </div>
        </div>
    </div>
</div>
<!-- FIN CABECERA -->




<!-- CONTENIDO -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        @foreach ($customers as $customer)
        <a href="{{route('clientes.show', $customer->id)}}">
            <div class="row border-bottom">
                <div class="d-flex mb-3 mt-3">
                    <div class="mr-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1 font-weight-bold">{{$customer->getFullName()}}</h6>
                        <p class="mb-0 fs-12">{{$customer->phone_number}} / {{$customer->address}}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach    
    </div>
</div>
<!-- FIN CONTENIDO -->
@endsection
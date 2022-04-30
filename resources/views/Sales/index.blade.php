@extends('app')

@section('content')

<!-- CABECERA -->
<div class="page-header d-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Lista de ventas</h4>
    </div>
    <div class="page-rightheader ml-md-auto">
        <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
            <div class="btn-list">
                <a href="{{route('ventas.create')}}" class="btn btn-outline-primary mr-3">
                    Agregar venta</a>
            </div>
        </div>
    </div>
</div>
<!-- FIN CABECERA -->




<!-- CONTENIDO -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        @foreach ($sales as $sale)
        <a href="{{route('ventas.show', $sale->id)}}">
            <div class="row border-bottom mb-3">
                <div class="row d-flex">
                    <div class="mr-3 mt-0 mt-sm-1 d-block">
                        <div class="row justify-content-between">
                            <div class="col-8 text-left">
                                <h6 class="mb-1 font-weight-bold">{{$sale->user->getFullName()}}</h6>
                                <p class="mb-0 fs-12">{{$sale->getSomeProducts()}}</p>
                            </div>
                            <div class="col-4 text-right">
                                @if ($sale->status->name == 'Pagado')
                                    <span class="badge bg-primary-transparent border border-primary rounded-pill">{{$sale->status->name}}</span>
                                @elseif ($sale->status->name == 'En proceso')
                                    <span class="badge bg-warning-transparent border border-warning rounded-pill">{{$sale->status->name}}</span>
                                @else
                                    <span class="badge bg-danger-transparent border border-danger rounded-pill">{{$sale->status->name}}</span>
                                @endif
                            </div>
                        </div>
                        {{-- <p class="mb-0 fs-12">{{$product->description}}</p> --}}
                        
                        <div class="row mt-3 justify-content-between">
                            <div class="col-6 text-left">
                                <h6 class="fs-14 text-primary">{{$sale->numberToCurrency($sale->total_amount)}}</h6>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-muted fs-13">{{$sale->getDate()}}</p>
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
@extends('app')

@section('extra-css')
<style>
    .overflow-scroll-x > .row {
        display: flex;
        overflow-x: auto;
        flex-wrap: nowrap;
    }
    .overflow-scroll-x > .row::-webkit-scrollbar {
        display: none;
    }
    .overflow-scroll-x > .row > .col-9, .overflow-scroll-x > .row > .col-8{
        flex: 0 0 auto;
    }

    #card-ganancias{
        background: linear-gradient(100.72deg, rgba(0, 173, 97, 0.7) 15.65%, rgba(0, 173, 97, 0.469) 84.39%);
        box-shadow: 0px 4px 10px rgba(98, 197, 153, 0.5);
        border-radius: 10px;
        color: white;
    }
    #card-ventas{
        background: linear-gradient(100.72deg, rgba(106, 84, 223, 0.7) 15.65%, rgba(106, 84, 223, 0.469) 84.39%);
        box-shadow: 0px 4px 10px rgba(106, 84, 223, 0.5);
        border-radius: 10px;
        color: white;
    }
    #icono-tarjeta{
        background: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        
    }
    .icon1{
        height:75%;
        width:100%;
        margin: 0 auto;
        display:flex;
        justify-content: center;
        align-items: center;
    }
</style>

@endsection

@section('content')

<!-- CABECERA -->
<div class="page-header d-flex d-block">
    <div class="page-leftheader">
        <h5>Hola Yolanda, bienvenida</h5>
        <h4 class="page-title">Inicio</h4>
    </div>
</div>
<!-- FIN CABECERA -->




<!-- CONTENIDO -->

<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">

        {{-- ================ V E N T A S ================ --}}
        <div class="row">
            {{-- CABECERA --}}
            <div class="row">
                <div class="col-9">
                    <h5 class="font-weight-700">Ventas</h5>
                </div>
                <div class="col-3 text-right">
                    <a href="{{route('ventas.index')}}" class="text-muted">Ver todas</a>
                </div>
            </div>
            <div class="container overflow-scroll-x">
                <div class="row">
                    {{-- TARJETA INGRESOS --}}
                    <div class="col-xl-4 col-9">
                        <div class="card" id="card-ganancias">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-left"> <h5 class="font-weight-bold">Ganancias del mes</h5>
                                            <p>Monto ganado en el mes de {{$month->monthName}}</p>
                                            <h3 class="mb-0 mt-1 mb-2">{{$totalEarningsOfTheMonth}}</h3>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <div class="icon1" id="icono-tarjeta">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- TARJETA VENTAS --}}
                    <div class="col-xl-4 col-9">
                        <div class="card" id="card-ventas">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mt-0 text-left"> <h5 class="font-weight-bold">Ventas del mes</h5>
                                            <p>Ventas realizadas en el mes de {{$month->monthName}}</p>
                                            <h3 class="mb-0 mt-1 mb-2">{{$totalSalesOfTheMonth}}</h3>
                                            {{-- <a href="{{route('ventas.index')}}" >Ver todas</a> --}}
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <div class="icon1 my-auto float-right" id="icono-tarjeta">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================ P R O D U C T O S ================ --}}
        <div class="row mt-5">
            {{-- CABECERA --}}
            <div class="row">
                <div class="col-9">
                    <h5 class="font-weight-700">Productos</h5>
                </div>
                <div class="col-3 text-right float-right">
                    <a href="{{route('productos.index')}}" class="text-muted">Ver todos</a>
                </div>
            </div>

            <div class="container overflow-scroll-x mt-3">
                <div class="row pb-3 pt-3">
                    {{-- PRODUCTO MAS VENDIDO --}}
                    <div class="col-xl-4 col-8 bg-white shadow-sm mr-5" style="border-radius: 5%;">
                        <a href="{{route('productos.show', $mostPurchasedProduct->id)}}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 position-absolute" style="top:.5%;left:-.5%;">
                                        <span class="badge bg-danger border border-danger rounded-pill">🔥 Más vendido</span>
                                    </div>

                                    <img class="mw-100" src="{{asset($mostPurchasedProduct->url_image)}}" style="border-radius: 8%">
                                </div>
                                <div class="row mt-5">
                                    <h6 class="font-weight-bold">{{$mostPurchasedProduct->name}}</h6>
                                    <p class="text-muted">{{$mostPurchasedProduct->description}}</p>
                                </div>

                                <div class="row">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        {{$mostPurchasedProduct->likes_count}} Me gusta
                                    </p>
                                </div>
                                <div class="row mt-3">
                                    <h3 class="text-primary">{{$mostPurchasedProduct->getPrice()}}</h3>
                                </div>
                                <div class="row text-right">
                                    <p class="text-muted">Comprado {{$mostPurchasedProduct->sales_count}} veces</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- PRODUCTO MAS COMENTADO --}}
                    <div class="col-xl-4 col-8 bg-white shadow-sm mr-5" style="border-radius: 5%;">
                        <a href="{{route('productos.show', $mostCommentedProduct->id)}}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 position-absolute" style="top:.5%;left:-.5%;">
                                        <span class="badge bg-secondary border border-secondary rounded-pill">💬 Más comentado</span>
                                    </div>

                                    <img class="mw-100" src="{{asset($mostCommentedProduct->url_image)}}" style="border-radius: 8%">
                                </div>
                                <div class="row mt-5">
                                    <h6 class="font-weight-bold">{{$mostCommentedProduct->name}}</h6>
                                    <p class="text-muted">{{$mostCommentedProduct->description}}</p>
                                </div>

                                <div class="row">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        {{$mostCommentedProduct->likes_count}} Me gusta
                                    </p>
                                </div>
                                <div class="row mt-3">
                                    <h3 class="text-primary">{{$mostCommentedProduct->getPrice()}}</h3>
                                </div>
                                <div class="row text-right">
                                    <p class="text-muted">Comentado {{$mostCommentedProduct->comments_count}} veces</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- PRODUCTO MEJOR CALIFICADO --}}
                    <div class="col-xl-4 col-8 bg-white shadow-sm mr-5" style="border-radius: 5%;">
                        <a href="{{route('productos.show', $mostlikedProduct->id)}}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 position-absolute" style="top:.5%;left:-.5%;">
                                        <span class="badge bg-primary border border-primary rounded-pill">❤ Más calificado</span>
                                    </div>

                                    <img class="mw-100" src="{{asset($mostlikedProduct->url_image)}}" style="border-radius: 8%">
                                </div>
                                <div class="row mt-5">
                                    <h6 class="font-weight-bold">{{$mostlikedProduct->name}}</h6>
                                    <p class="text-muted">{{$mostlikedProduct->description}}</p>
                                </div>

                                <div class="row">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        {{$mostlikedProduct->likes_count}} Me gusta
                                    </p>
                                </div>
                                <div class="row mt-3">
                                    <h3 class="text-primary">{{$mostlikedProduct->getPrice()}}</h3>
                                </div>
                                <div class="row text-right">
                                    <p class="text-muted">A {{$mostlikedProduct->likes_count}} personas les gusta</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================ G A N A N C I A S ================ --}}
        <div class="row mt-5">
            {{-- CABECERA --}}
            <div class="row">
                <div class="col-9">
                    <h5 class="font-weight-700">Ganancias del año</h5>
                </div>
            </div>
            <div class="row">
                {{-- GRAFICA GANANCIAS --}}
                <div class="card">
                    <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="chartline1" style="display: block; width: 559px; height: 330px;" width="1118" height="660" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                
                   
            </div>
        </div>
    </div>
</div>
<!-- FIN CONTENIDO -->
@endsection


@section('extra-script')
		{{-- GRAFICA ADMIN --}}
		<script>
            (() => {
                function e(e, a, o) {
                    return a in e ? Object.defineProperty(e, a, {
                        value: o,
                        enumerable: !0,
                        configurable: !0,
                        writable: !0
                    }) : e[a] = o, e
                }
                $((function(a) {
                        var t;
                        const monthlyEarnings = @json($earningsOfTheYear);
                        r = document.getElementById("chartline1").getContext("2d"), new Chart(r, {
                            type: "bar",
                            data: {
                                labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                                datasets: [{
                                    label: "Ingresos",
                                    data: [monthlyEarnings[0],monthlyEarnings[1],monthlyEarnings[2],monthlyEarnings[3],monthlyEarnings[4],monthlyEarnings[5],
                                            monthlyEarnings[6],monthlyEarnings[7],monthlyEarnings[8],monthlyEarnings[9],monthlyEarnings[10],monthlyEarnings[11]],
                                    backgroundColor: "rgb(255, 99, 132, 0.8)",
                                    borderColor: "rgb(255, 99, 132)",
                                    borderRadius: Number.MAX_VALUE,
                                    pointRadius: 0,
                                    type: "bar"
                                }]
                            },
                            options: {
                                responsive: !0,
                                maintainAspectRatio: !1,
                                layout: {
                                    padding: {
                                        left: 0,
                                        right: 0,
                                        top: 0,
                                        bottom: 0
                                    }
                                },
                                tooltips: {
                                    enabled: !1
                                },
                                scales: {
                                    yAxes: [{
                                        gridLines: {
                                            display: !0,
                                            drawBorder: !1,
                                            zeroLineColor: "rgba(142, 156, 173,0.1)",
                                            color: "rgba(142, 156, 173,0.1)"
                                        },
                                        scaleLabel: {
                                            display: !1
                                        },
                                        ticks: {
                                            beginAtZero: !0,
                                            stepSize: 10,
                                            suggestedMin: 10,
                                            suggestedMax: 100,
                                            fontColor: "#8492a6"
                                        }
                                    }],
                                    xAxes: [{
                                        barValueSpacing: -2,
                                        barDatasetSpacing: 0,
                                        barRadius: 15,
                                        stacked: !1,
                                        categoryPercentage: .4,
                                        barPercentage: .8,
                                        ticks: {
                                            beginAtZero: !0,
                                            fontColor: "#8492a6"
                                        },
                                        gridLines: {
                                            color: "rgba(142, 156, 173,0.1)",
                                            display: !1
                                        }
                                    }]
                                },
                                legend: {
                                    display: !1
                                },
                                elements: {
                                    point: {
                                        radius: 0
                                    }
                                }
                            }
                        });

                }))
            })();
            </script>
@endsection
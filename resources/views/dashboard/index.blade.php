 @extends('layouts.simple.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row size-column">
    <div class="col-xl-7 box-col-12 xl-100">
        <div class="row dash-chart">
            @if ($user->nome == 'Administradores' || $user->nome == 'HST' || $user->nome == 'Piquete')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ route('viatura.list') }}">
                        <div class="card o-hidden">
                            <div class="bg-primary b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="truck"></i></div>
                                    <div class="media-body">
                                    <span class="m-0">Viaturas</span>
                                    <h4 class="mb-0 counter">{{ $nr_viaturas }}</h4>
                                    <i class="icon-bg" data-feather="truck"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ route('projectos.list') }}">
                        <div class="card o-hidden">
                            <div class="bg-primary b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="globe"></i></div>
                                    <div class="media-body">
                                    <span class="m-0">Projectos</span>
                                    <h4 class="mb-0 counter">{{ $nr_projectos }}</h4>
                                    <i class="icon-bg" data-feather="globe"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if ($user->nome == 'Administradores')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ route('utilizador.list') }}">
                        <div class="card o-hidden">
                            <div class="bg-primary b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="users"></i></div>
                                    <div class="media-body">
                                    <span class="m-0">Utilizadores</span>
                                    <h4 class="mb-0 counter">{{ $nr_users }}</h4>
                                    <i class="icon-bg" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if ($user->nome == 'Administradores' || $user->nome == 'Clientes')
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{ route('requisicao.list') }}">
                        <div class="card o-hidden">
                            <div class="bg-primary b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="mail"></i></div>
                                    <div class="media-body">
                                    <span class="m-0">Requisições</span>
                                    <h4 class="mb-0 counter">{{ $nr_requisicoes }}</h4>
                                    <i class="icon-bg" data-feather="mail"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            {{-- <div class="col-xl-6 box-col-6 col-md-6">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                    <div class="media">
                        <div class="media-body">
                        <p><span class="f-w-500 font-roboto">Today Total sale</span><span class="f-w-700 font-primary ms-2">89.21%</span></p>
                        <h4 class="f-w-500 mb-0 f-26">$<span class="counter">3000.56</span></h4>
                        </div>
                    </div>
                    </div>
                    <div class="card-body p-0">
                    <div class="media">
                        <div class="media-body">
                        <div class="profit-card">
                            <div id="spaline-chart"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-6 col-md-6">
                <div class="card o-hidden">
                    <div class="card-header card-no-border">
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                    <div class="media">
                        <div class="media-body">
                        <p><span class="f-w-500 font-roboto">Today Total visits</span><span class="f-w-700 font-primary ms-2">35.00%</span></p>
                        <h4 class="f-w-500 mb-0 f-26 counter">9,050</h4>
                        </div>
                    </div>
                    </div>
                    <div class="card-body pt-0">
                    <div class="monthly-visit">
                        <div id="column-chart"></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 box-col-6 col-lg-12 col-md-6">
                <div class="card o-hidden">
                    <div class="card-body">
                    <div class="ecommerce-widgets media">
                        <div class="media-body">
                        <p class="f-w-500 font-roboto">Our Sale Value<span class="badge pill-badge-primary ms-3">New</span></p>
                        <h4 class="f-w-500 mb-0 f-26">$<span class="counter">7454.25</span></h4>
                        </div>
                        <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i></div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                <div class="card o-hidden">
                    <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                        <p class="f-w-500 font-roboto">Today Stock value<span class="badge pill-badge-primary ms-3">Hot</span></p>
                        <div class="progress-box">
                            <h4 class="f-w-500 mb-0 f-26">$<span class="counter">9000.04</span></h4>
                            <div class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                            <div class="progress-gradient-primary" role="progressbar" style="width: 35%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="font-primary">88%</span><span class="animate-circle"></span></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div> --}}
            @if ($user->nome == 'Administradores')
                <div class="col-xl-12 box-col-12">
                    <div class="donut-chart-widget">
                        <div class="card">
                            <div class="card-header card-no-border">
                            <h5>Uso de combustível do mês corrente</h5>
                            </div>
                            <div class="card-body">
                            <div id="chart-widget6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($user->nome == 'Administradores' || $user->nome == 'HST')
                <div class="col-xl-4 xl-50 box-col-12">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <h5>Ordens do dia</h5>
                            <div class="card-header-right">
                                @if (count($ordens) > 0) <a href="{{ route('abastecimento.list') }}" class="h5"> <i class="fa fa-list-ul txt-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Mais detalhes"></i></a> @endif
                            </div>
                        </div>
                        <div class="card-body new-update pt-0">
                            <div class="activity-timeline">
                                @if (count($ordens))
                                    @foreach ($ordens as $ordem)
                                        <div class="media">
                                            <div class="@if($ordem->estado == 'Autorizada') activity-dot-success circle-dot-success @elseif($ordem->estado == 'Cancelada') activity-dot-danger circle-dot-danger @else activity-dot-warning circle-dot-warning @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $ordem->estado }}"></div>
                                            <div class="media-body">
                                                <a href="{{ route('abastecimento.show', Crypt::encrypt($ordem->id)) }}">
                                                    <span>Ordem #{{ $ordem->codigo }}</span>
                                                    <p class="font-roboto"> <b>Bombas</b>: {{ $ordem->nome }} ({{ $ordem->combustivel_total }} litros)</p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="media">
                                <div class="activity-dot-primary"></div>
                                <div class="media-body">
                                    <span>Nenhuma ordem foi feita no dia de hoje!</span>
                                    {{-- <p class="font-roboto">Aenean sit amet magna vel magna fringilla ferme.</p> --}}
                                </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-4 xl-50 box-col-12">
                <div class="card">
                    <div class="card-header card-no-border">
                        <h5>New Product</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="our-product">
                            <div class="table-responsive">
                                <table class="table table-bordernone">
                                    <tbody class="f-w-500">
                                        <tr>
                                            <td>
                                            <div class="media">
                                                <img class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/dashboard-2/product-1.png')}}" alt="">
                                                <div class="media-body">
                                                <span>Hike Shoes</span>
                                                <p class="font-roboto">100 item</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <p>coupon code</p>
                                            <span>PIX001</span>
                                            </td>
                                            <td>
                                            <p>-51%</p>
                                            <span>$99.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="media">
                                                <img class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/dashboard-2/product-3.png')}}" alt="">
                                                <div class="media-body">
                                                <span>Tree Pot</span>
                                                <p class="font-roboto">105 item</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <p>coupon code</p>
                                            <span>PIX002</span>
                                            </td>
                                            <td>
                                            <p>-78%</p>
                                            <span>$66.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="media">
                                                <img class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/dashboard-2/product-4.png')}}" alt="">
                                                <div class="media-body">
                                                <span>Bag</span>
                                                <p class="font-roboto">604 item</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <p>coupon code</p>
                                            <span>PIX003</span>
                                            </td>
                                            <td>
                                            <p>-04%</p>
                                            <span>$116.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="media">
                                                <img class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/dashboard-2/product-5.png')}}" alt="">
                                                <div class="media-body">
                                                <span>Wtach</span>
                                                <p class="font-roboto">541 item</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <p>coupon code</p>
                                            <span>PIX004</span>
                                            </td>
                                            <td>
                                            <p>-60%</p>
                                            <span>$99.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="media">
                                                <img class="img-fluid m-r-15 rounded-circle" src="{{asset('assets/images/dashboard-2/product-6.png')}}" alt="">
                                                <div class="media-body">
                                                <span>T-shirt</span>
                                                <p class="font-roboto">999 item</p>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                            <p>coupon code</p>
                                            <span>PIX005</span>
                                            </td>
                                            <td>
                                            <p>-50%</p>
                                            <span>$58.00</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/apex-chart/moment.min.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/dashboard/dashboard_2.js')}}"></script>
<script>
    var date = new Date();
    var month = date.getMonth();
    date.setDate(1);
    var all_days = [];
    while (date.getMonth() == month) {
        var d = date.getDate().toString().padStart(2, '0');
        all_days.push(d);
        date.setDate(date.getDate() + 1);
    }

        $.ajax({
            url:"{{ route('viatura.getFuelData') }}",
            type:"GET",
            success: function(fuelData) {
                if (fuelData) {
                    fD = fuelData
                } else {
                    fD = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
                }

                var optionsproductchart = {
                    chart: {
                        height: 300,
                        type: 'line'
                    },
                    stroke: {
                        curve: 'smooth'
                    },

                    series: [{
                        name: 'Combustível',
                        type: 'area',
                        data: fD
                    }],
                    fill: {
                        colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            shadeIntensity: 0.4,
                            inverseColors: false,
                            opacityFrom: 0.9,
                            opacityTo: 0.8,
                            stops: [0, 100]
                        }
                    },

                    colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
                    labels: all_days,
                    markers: {
                        size: 1
                    },
                    yaxis: [
                        {
                            title: {
                                text: 'Quantidade (litros)'
                            }
                        }
                    ],
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function (y) {
                                if(typeof y !== "undefined") {
                                    return  y.toFixed(0) + " litros";
                                }
                                return y;

                            }
                        }
                    }

                }

                var chartproductchart = new ApexCharts(
                    document.querySelector("#chart-widget6"),
                    optionsproductchart
                );
                chartproductchart.render();
            }
        });


</script>
@endsection


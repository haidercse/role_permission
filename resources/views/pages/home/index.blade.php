@extends('layouts.master')

@section('title')
   Home | MicroMac
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header ">
                <div class="page-header-title">
                    <h4>Home | Dashboard</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a>
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <!-- Documents card start -->
                <div class="col-md-2 col-xl-3">
                    <div class="card client-blocks dark-primary-border">
                        <div class="card-block">
                            <h5>Total Tickets</h5>
                            <ul>
                                <li>
                                    <i class="icofont icofont-document-folder"></i>
                                </li>
                                <li class="text-right">

                                    @if (Auth::user()->hasRole('Client'))
                                        {{ $total->count() }}
                                    @else
                                        {{ $total->count() }}
                                    @endif

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Documents card end -->
                <!-- New clients card start -->
                <div class="col-md-2 col-xl-3">
                    <div class="card client-blocks warning-border">
                        <div class="card-block">
                            <h5>New</h5>
                            <ul>
                                <li>
                                    <i class="icofont icofont-ui-user-group text-warning"></i>
                                </li>
                                <li class="text-right text-warning">
                                    @if (Auth::user()->hasRole('Client'))
                                        {{ $new }}
                                    @else
                                        {{ $new }}
                                    @endif

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- New clients card end -->
                <!-- New files card start -->
                <div class="col-md-2 col-xl-3">
                    <div class="card client-blocks success-border">
                        <div class="card-block">
                            <h5>Inprogress</h5>
                            <ul>
                                <li>
                                    <i class="icofont icofont-files text-success"></i>
                                </li>
                                <li class="text-right text-success">
                                    @if (Auth::user()->hasRole('Client'))
                                        {{ $inprogress }}
                                    @else
                                        {{ $inprogress }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- New files card end -->
                <!-- Open Project card start -->
                <div class="col-md-2 col-xl-3">
                    <div class="card client-blocks">
                        <div class="card-block">
                            <h5>Resolved</h5>
                            <ul>
                                <li>
                                    <i class="icofont icofont-ui-folder text-primary"></i>
                                </li>
                                <li class="text-right text-primary">

                                    @if (Auth::user()->hasRole('Client'))
                                        {{ $resolved }}
                                    @else
                                        {{ $resolved }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>



                <!-- Morris chart end -->
                <!-- Todo card start -->

                @if (Auth::user()->hasRole('Client'))
                    <div class="col-md-12 col-xl-8">
                        <div class="card">
                            <div class="card-block">
                                <div id="chartContainerClient" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Morris chart end -->
                    <!-- Todo card start -->
                    <div class="col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-block">
                                <div id="chartContainerPieClient" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 col-xl-8">
                        <div class="card">
                            <div class="card-block">
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Morris chart end -->
                    <!-- Todo card start -->
                    <div class="col-md-12 col-xl-4">
                        <div class="card">
                            <div class="card-block">
                                <div id="chartContainerPie" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Todo card end -->
                <!-- User chat box end -->
            </div>

        </div>
        <!-- Default card end -->
    </div>

    @push('custom-scripts')
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
        <script>
            $(document).ready(function() {
                initNotification();
            });
            var firebaseConfig = {
                apiKey: "AIzaSyCXuMqt5s1Suhm5mhFiVEkMTzoGTn6ZD1M",
                authDomain: "larafcm-e45c0.firebaseapp.com",
                projectId: "larafcm-e45c0",
                storageBucket: "larafcm-e45c0.appspot.com",
                messagingSenderId: "136745250719",
                appId: "1:136745250719:web:b01653e0d0ae712b3357aa",
                measurementId: "G-R9HPT7KKB0"
            };

            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            function initNotification() {
                messaging.requestPermission().then(function() {
                    return messaging.getToken()
                }).then(function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('fcmToken') }}',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            console.log('Device token saved.');
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                }).catch(function(error) {
                    console.log(error);
                });
            }

            messaging.onMessage(function(payload) {
                const title = payload.notification.title;
                const options = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(title, options);
            });
        </script>
        <script>
            window.onload = function() {
                @if (Auth::user()->hasRole('Client'))
                    //for client
                    var chart = new CanvasJS.Chart("chartContainerClient", {
                    animationEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title: {
                    fontSize: 16,
                    text: "Product Wise Issue Number"
                    },
                    axisY: {
                    title: "Total Issue Number"
                    },
                    data: [{
                    type: "column",
                    showInLegend: true,
                    legendMarkerColor: "grey",
                    legendText: "Products",
                    dataPoints: <?php echo $bar_chart; ?>

                    }]
                    });
                    chart.render();

                    var chartpie = new CanvasJS.Chart("chartContainerPieClient", {
                    animationEnabled: true,
                    title: {
                    fontSize: 16,
                    text: "Type Wise Issue Statistics "
                    },
                    data: [{
                    type: "pie",
                    startAngle: 240,
                    //yValueFormatString: "##0.00\"%\"",
                    indexLabel: "{label} {y}",
                    dataPoints: <?php echo $pie_chart; ?>
                    }]
                    });
                    chartpie.render();
                @else
                    var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title: {
                    fontSize: 16,
                    text: "Product Wise Issue Number"
                    },
                    axisY: {
                    title: "Total Issue Number"
                    },
                    data: [{
                    type: "column",
                    showInLegend: true,
                    legendMarkerColor: "grey",
                    legendText: "Products",
                    dataPoints: <?php echo $bar_chart; ?>

                    }]
                    });
                    chart.render();

                    var chartpie = new CanvasJS.Chart("chartContainerPie", {
                    animationEnabled: true,
                    title: {
                    fontSize: 16,
                    text: "Type Wise Issue Statistics"
                    },
                    data: [{
                    type: "pie",
                    startAngle: 240,
                    //yValueFormatString: "##0.00\"%\"",
                    indexLabel: "{label} {y}",
                    dataPoints: <?php echo $pie_chart; ?>
                    }]
                    });
                    chartpie.render();
                @endif

            }
        </script>
    @endpush
@endsection

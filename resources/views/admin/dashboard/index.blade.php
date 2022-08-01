@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>
    <div class="row mb-2">
        <div class="col-6" style="width: fit-content !important;">
            <h3>Show stats for</h3>
        </div>
        <div class="col-6">
            <select class="form-control mb-2" id="stats-select" style="width: 50%;margin-left: -15px;">
                <option value="day">Today</option>
                <option value="week">This week</option>
                <option value="month">This month</option>
                <option value="year">This year</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-flex">
            <div class="w-100">
                <div class="row">                    
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Donations</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="activity"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3" id="donations">{{ $donations }}</h1>
                                <div class="mb-0">
                                    <span class="text-success" id="donations_difference"> {{ $donations_difference }}<br> </span>
                                    <span class="text-muted" id="donations_difference_text">Since the last day</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">New Donors</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3" id="users">{{ $users }}</h1>
                                <div class="mb-0">
                                    <span class="text-success" id="users_difference"> {{ $users_difference }}<br> </span>
                                    <span class="text-muted" id="users_difference_text">Since the last day</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Amount Received</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            ₹
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3" id="amount_received">₹{{ $amount_received }}</h1>
                                <div class="mb-0">
                                    <span class="text-success" id="amount_received_difference"> ₹{{ $amount_received_difference }}<br> </span>
                                    <span class="text-muted" id="amount_received_difference_text">Since the last day</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Orders</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3" id="procurement_orders">{{ $procurement_orders }}</h1>
                                <div class="mb-0">
                                    <span class="text-success" id="procurement_orders_difference"> {{ $procurement_orders_difference }}<br> </span>
                                    <span class="text-muted" id="procurement_orders_difference_text">Since the last day</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-100">
                        Actions
                    </h5>
                </div>

                <div class="card-body py-3" style="height: 275px;">
                    <form action="#">
                        @if ($procurement_orders_unacknowledged > 0)                                                    
                            <div class="flex flex-col mb-4">
                                <h5>
                                    <b>{{ $procurement_orders_unacknowledged }}</b> items are <font color="red">UNACKNOWLEDGED</font> in procurement list
                                </h5>
                                <a href="{{ route('admin.operations.procurement.index') }}" class="btn btn-primary">
                                    View
                                </a>
                            </div>
                        @endif
                        @if ($donations_pending > 0)
                            <div class="flex flex-col">
                                <h5>
                                    <b>{{ $donations_pending }}</b> donations are <font color="red">PENDING</font>
                                </h5>
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-primary">
                                    View
                                </a>
                            </div>
                        @endif
                        @if ($donations_fulfilled_and_without_media > 0)
                            <div class="flex flex-col">
                                <h5>
                                    <b>{{ $donations_fulfilled_and_without_media }}</b> donations are <font color="green">FULFILLED</font> but <font color="red">WITHOUT MEDIA</font>
                                </h5>
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-primary">
                                    View
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 d-flex order-xxl-2">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Donations received per month</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Procurement Orders per location</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                @foreach($orders_per_location as $location => $count)
                                    <tr>
                                        <td>{{ $location }}</td>
                                        <td class="text-end">{{ $count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">
        <div class="col-md-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">

                    <h5 class="card-title mb-0">Latest Projects</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Start Date</th>
                            <th class="d-none d-xl-table-cell">End Date</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Assignee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Project Apollo</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        </tr>
                        <tr>
                            <td>Project Fireball</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        <tr>
                            <td>Project Hades</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                        </tr>
                        <tr>
                            <td>Project Nitro</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-warning">In progress</span></td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        </tr>
                        <tr>
                            <td>Project Phoenix</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                        <tr>
                            <td>Project X</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Sharon Lessman</td>
                        </tr>
                        <tr>
                            <td>Project Romeo</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-success">Done</span></td>
                            <td class="d-none d-md-table-cell">Christina Mason</td>
                        </tr>
                        <tr>
                            <td>Project Wombat</td>
                            <td class="d-none d-xl-table-cell">01/01/2021</td>
                            <td class="d-none d-xl-table-cell">31/06/2021</td>
                            <td><span class="badge bg-warning">In progress</span></td>
                            <td class="d-none d-md-table-cell">William Harris</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>--}}

</div>
@endsection

@section('js')
<script>    
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: [
                    @foreach ($orders_per_location as $location => $count)
                        "{{ $location }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach ($orders_per_location as $location => $count)
                        {{ $count }},
                    @endforeach
                    ],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });

document.addEventListener("DOMContentLoaded", function() { 
        let canvas = document.getElementById("chartjs-dashboard-line");
        var ctx = canvas.getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);        
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(canvas, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    data: [
                        @foreach ($donations_received_every_month as $location => $count)
                        {{ $count }},
                    @endforeach
                    ],
                    label: "Donations (₹)",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,                    
                }],
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 10000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
</script>

<script>        

    let changeStats = function (stats, text){            
        $.each(stats, (key, value) => {
            $('#' + key).html(value+"<br>");
            if (key.includes('difference')){
                $('#' + key + '_text').html('Since the last ' + text);
                if (value > 0){
                    toggleClassOn($('#' + key + '_text'), 'text-success');
                    toggleClassOff($('#' + key + '_text'), 'text-danger');
                } else {
                    toggleClassOn($('#' + key + '_text'), 'text-danger');
                    toggleClassOff($('#' + key + '_text'), 'text-success');
                }
            }
        });
    };

    let toggleClassOn = function (element, className){
        if (!element.hasClass(className)) {
            element.addClass(className);
        }
    };  
    
    let toggleClassOff = function (element, className){
        if (element.hasClass(className)) {
            element.removeClass(className);
        }
    };

    $('document').ready(() => {

        let statsSelect = $('#stats-select');            

        statsSelect.on('change', () => {
            axios.post('{{ route("admin.dashboard.stats") }}', {
                duration: statsSelect.val()
            }).then(response => {
                let stats = response.data;
                changeStats(stats, statsSelect.val());
            });
        });

    });
</script>
@endsection

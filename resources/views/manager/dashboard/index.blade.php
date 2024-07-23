@extends('layouts.main')
@section('content')
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <i class="bi bi-star me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
        <div class="row">
             <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" id="filter-menu">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#" onclick="filterData('today')">Today</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterData('this_month')">This Month</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterData('this_year')">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Penjualan <span id="filter-label">| Today</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="total-sales">0</h6>
                                    <span class="text-success small pt-1 fw-bold">Penjualan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
                    <script>
                        const orders = @json($orders);

                        function filterData(filter) {
                            let filteredOrders = [];
                            const today = new Date();
                            let totalSales = 0;

                            if (filter === 'today') {
                                filteredOrders = orders.filter(order => {
                                    const orderDate = new Date(order.created_at);
                                    return orderDate.toDateString() === today.toDateString();
                                });
                                document.getElementById('filter-label').innerText = '| Today';
                            } else if (filter === 'this_month') {
                                filteredOrders = orders.filter(order => {
                                    const orderDate = new Date(order.created_at);
                                    return orderDate.getMonth() === today.getMonth() && orderDate.getFullYear() === today.getFullYear();
                                });
                                document.getElementById('filter-label').innerText = '| This Month';
                            } else if (filter === 'this_year') {
                                filteredOrders = orders.filter(order => {
                                    const orderDate = new Date(order.created_at);
                                    return orderDate.getFullYear() === today.getFullYear();
                                });
                                document.getElementById('filter-label').innerText = '| This Year';
                            }

                            totalSales = filteredOrders.reduce((sum, order) => sum + parseFloat(order.amount), 0);
                            document.getElementById('total-sales').innerText = totalSales.toFixed(0);
                        }

                        // Initial load with today's data
                        filterData('today');
                    </script>

                    <!-- Revenue Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#" onclick="filterDataRev('today')">Today</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterDataRev('this_month')">This Month</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterDataRev('this_year')">This Year</a></li>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Revenue <span id="revenue-filter-label">| Today</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                    <h6 id="total-revenue">0</h6>
                    <span class="text-success small pt-1 fw-bold">Pendapatan</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Revenue Card -->

<script>
    function filterDataRev(filter_rev) {
        const orders = @json($orders);
        if (!orders) {
            console.error('Orders data not found.');
            return;
        }

        const today = new Date();
        let filteredOrders = [];

        let totalRevenue = 0;

        if (filter_rev === 'today') {
            filteredOrders = orders.filter(order => {
                const orderDate = new Date(order.created_at);
                return orderDate.toDateString() === today.toDateString();
            });
            document.getElementById('revenue-filter-label').innerText = '| Today';
        } else if (filter_rev === 'this_month') {
            filteredOrders = orders.filter(order => {
                const orderDate = new Date(order.created_at);
                return orderDate.getMonth() === today.getMonth() && orderDate.getFullYear() === today.getFullYear();
            });
            document.getElementById('revenue-filter-label').innerText = '| This Month';
        } else if (filter_rev === 'this_year') {
            filteredOrders = orders.filter(order => {
                const orderDate = new Date(order.created_at);
                return orderDate.getFullYear() === today.getFullYear();
            });
            document.getElementById('revenue-filter-label').innerText = '| This Year';
        }

        const uniqueReceipts = new Set();
        filteredOrders.forEach(order => uniqueReceipts.add(order.receipt_number));

        totalRevenue = Array.from(uniqueReceipts).reduce((sum, receipt_number) => {
            const receiptTotal = filteredOrders
                .filter(order => order.receipt_number === receipt_number)
                .reduce((acc, order) => acc + parseFloat(order.total_payment), 0);
            return sum + receiptTotal;
        }, 0);

        const rupiah =(numbers)=>{
            return new Intl.NumberFormat("id-ID",{
                style : "currency",
                currency : "IDR"
            }).format(numbers)
        }


        console.log('Total Revenue:', totalRevenue);
        document.getElementById('total-revenue').innerText = rupiah(totalRevenue.toFixed(0));
    }

    filterDataRev('today');

</script>


<!-- Customers Card -->
<div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#" onclick="filterDataCust('today')">Today</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterDataCust('this_month')">This Month</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterDataCust('this_year')">This Year</a></li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Customers <span id="customer-filter-label">| Today</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6 id="total-customers">0</h6>
                    <span class="text-success small pt-1 fw-bold">Pelanggan</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Customers Card -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function filterDataCust(filter_cust) {
            // Pastikan data orders tersedia
            const orders = @json($orders);
            if (!orders) {
                console.error('Orders data not found.');
                return;
            }

            const today = new Date();
            let filteredOrders = [];
            let totalCustomers = 0;

            if (filter_cust === 'today') {
                filteredOrders = orders.filter(order => {
                    const orderDate = new Date(order.created_at);
                    return orderDate.toDateString() === today.toDateString();
                });
                document.getElementById('customer-filter-label').innerText = '| Today';
            } else if (filter_cust === 'this_month') {
                filteredOrders = orders.filter(order => {
                    const orderDate = new Date(order.created_at);
                    return orderDate.getMonth() === today.getMonth() && orderDate.getFullYear() === today.getFullYear();
                });
                document.getElementById('customer-filter-label').innerText = '| This Month';
            } else if (filter_cust === 'this_year') {
                filteredOrders = orders.filter(order => {
                    const orderDate = new Date(order.created_at);
                    return orderDate.getFullYear() === today.getFullYear();
                });
                document.getElementById('customer-filter-label').innerText = '| This Year';
            }

            totalCustomers = filteredOrders.length;

            // console.log('Total Seats:', totalSeats);
            // document.getElementById('total-customers').innerText = totalSeats;

            console.log('Total Customers:', totalCustomers);
            document.getElementById('total-customers').innerText = totalCustomers;
        }

        // Panggil fungsi untuk filter awal
        filterDataCust('today');
        window.filterDataCust = filterDataCust;
    });
</script>



                    <!-- Reports -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reports <span id="report-filter-label">/ Month</span></h5>
                <!-- Line Chart -->
                <div id="reportsChart"></div>
                <!-- End Line Chart -->
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Data dari controller
                const salesData = @json($sales);
                const customersData = @json($customers);
                const categories = @json($months).map(month => new Date(month + '-01').toLocaleDateString('en-GB', { month: 'short', year: 'numeric' }));

                function updateChart(salesData, customersData, categories) {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Sales',
                            data: salesData
                        }, {
                            name: 'Customers',
                            data: customersData
                        }],
                        chart: {
                            height: 350,
                            type: 'line',
                            toolbar: {
                                show: false
                            },
                        },
                        markers: {
                            size: 4
                        },
                        colors: ['#4154f1', '#ff771d'],
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 1,
                                opacityTo: 0.7,
                                stops: [0, 90, 100]
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        xaxis: {
                            type: 'category',
                            categories: categories
                        },
                        tooltip: {
                            x: {
                                format: 'MMM yyyy'
                            },
                        }
                    }).render();
                }

                updateChart(salesData, customersData, categories);
            });
        </script>
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Penjualan Terbaru</h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Receipt Number</th>
                                            <th scope="col">Movies</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Metode Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($unique_receipt_numbers as $key => $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->receipt_number }}</td>
                                                <td>{{ $order->schedule->movie->judul }}</td>
                                                <td>{{ $order->total_payment }}</td>
                                                <td>{{ $order->status_pembayaran }}</td>
                                                <td>{{ $order->metode_pembayaran }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Selling</h5>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Film</th>
                                            <th scope="col">Tiket Terjual</th>
                                            <th scope="col">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topMovies as $movie)
                                            <tr>
                                                <td>{{ $movie->judul }}</td>
                                                <td>{{ $movie->jumlah_penjualan_tiket }}</td>
                                                <td>Rp.{{ number_format($movie->total_pemasukan, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            {{-- <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                        <div class="activity">

                            <div class="activity-item d-flex">
                                <div class="activite-label">32 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                                    beatae
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">56 min</div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    Voluptatem blanditiis blanditiis eveniet
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                    Voluptates corrupti molestias voluptatem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">1 day</div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                        voluptatem</a> tempore
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 days</div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                    Est sit eum reiciendis exercitationem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">4 weeks</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                </div>
                            </div><!-- End activity item-->

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                                name: 'Sales',
                                                max: 6500
                                            },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                name: 'Allocated Budget'
                                            },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: 1048,
                                                name: 'Search Engine'
                                            },
                                            {
                                                value: 735,
                                                name: 'Direct'
                                            },
                                            {
                                                value: 580,
                                                name: 'Email'
                                            },
                                            {
                                                value: 484,
                                                name: 'Union Ads'
                                            },
                                            {
                                                value: 300,
                                                name: 'Video Ads'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->

                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/news-1.jpg" alt="">
                                <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                                <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-2.jpg" alt="">
                                <h4><a href="#">Quidem autem et impedit</a></h4>
                                <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-3.jpg" alt="">
                                <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-4.jpg" alt="">
                                <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                                <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/news-5.jpg" alt="">
                                <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                                <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                            </div>

                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->

            </div><!-- End Right side columns --> --}}

        </div>
    </section>
@endsection

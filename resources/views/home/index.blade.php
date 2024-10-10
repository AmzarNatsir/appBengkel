@extends('partial.app')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
            <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
            <a href="#" class="btn btn-primary btn-round">Add Customer</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                        <p class="card-category">Visitors</p>
                        <h4 class="card-title">1,294</h4>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Subscribers</p>
                                <h4 class="card-title">1303</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col-icon">
                    <div
                    class="icon-big text-center icon-success bubble-shadow-small"
                    >
                    <i class="fas fa-luggage-cart"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                    <p class="card-category">Sales</p>
                    <h4 class="card-title">$ 1,345</h4>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col-icon">
                    <div
                    class="icon-big text-center icon-secondary bubble-shadow-small"
                    >
                    <i class="far fa-check-circle"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                    <p class="card-category">Order</p>
                    <h4 class="card-title">576</h4>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Bar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Pie Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                        id="pieChart"
                        style="width: 50%; height: 50%"
                        ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Doughnut Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                        id="doughnutChart"
                        style="width: 50%; height: 50%"
                        ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Radar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="radarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Bubble Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="bubbleChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Multiple Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Multiple Bar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Chart with HTML Legends</div>
                </div>
                <div class="card-body">
                    <div class="card-sub">
                        Sometimes you need a very complex legend. In these cases,
                        it makes sense to generate an HTML legend. Charts provide
                        a generateLegend() method on their prototype that returns
                        an HTML string for the legend.
                    </div>
                    <div class="chart-container">
                        <canvas id="htmlLegendsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-round">
            <div class="card-body">
                <div class="card-head-row card-tools-still-right">
                <div class="card-title">New Customers</div>
                <div class="card-tools">
                    <div class="dropdown">
                    <button
                        class="btn btn-icon btn-clean me-0"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                        >Something else here</a
                        >
                    </div>
                    </div>
                </div>
                </div>
                <div class="card-list py-4">
                <div class="item-list">
                    <div class="avatar">
                    <img
                        src="assets/img/jm_denis.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                    />
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Jimmy Denis</div>
                    <div class="status">Graphic Designer</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                <div class="item-list">
                    <div class="avatar">
                    <span
                        class="avatar-title rounded-circle border border-white"
                        >CF</span
                    >
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Chandra Felix</div>
                    <div class="status">Sales Promotion</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                <div class="item-list">
                    <div class="avatar">
                    <img
                        src="assets/img/talha.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                    />
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Talha</div>
                    <div class="status">Front End Designer</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                <div class="item-list">
                    <div class="avatar">
                    <img
                        src="assets/img/chadengle.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                    />
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Chad</div>
                    <div class="status">CEO Zeleaf</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                <div class="item-list">
                    <div class="avatar">
                    <span
                        class="avatar-title rounded-circle border border-white bg-primary"
                        >H</span
                    >
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Hizrian</div>
                    <div class="status">Web Designer</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                <div class="item-list">
                    <div class="avatar">
                    <span
                        class="avatar-title rounded-circle border border-white bg-secondary"
                        >F</span
                    >
                    </div>
                    <div class="info-user ms-3">
                    <div class="username">Farrah</div>
                    <div class="status">Marketing</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                <div class="card-title">Transaction History</div>
                <div class="card-tools">
                    <div class="dropdown">
                    <button
                        class="btn btn-icon btn-clean me-0"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                        >Something else here</a
                        >
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Payment Number</th>
                        <th scope="col" class="text-end">Date & Time</th>
                        <th scope="col" class="text-end">Amount</th>
                        <th scope="col" class="text-end">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                        <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                        >
                            <i class="fa fa-check"></i>
                        </button>
                        Payment from #10231
                        </th>
                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                        <td class="text-end">$250.00</td>
                        <td class="text-end">
                        <span class="badge badge-success">Completed</span>
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
<script>
    $(".select2").select2();
    var lineChart = document.getElementById("lineChart").getContext("2d"),
      barChart = document.getElementById("barChart").getContext("2d"),
      pieChart = document.getElementById("pieChart").getContext("2d"),
      doughnutChart = document
        .getElementById("doughnutChart")
        .getContext("2d"),
      radarChart = document.getElementById("radarChart").getContext("2d"),
      bubbleChart = document.getElementById("bubbleChart").getContext("2d"),
      multipleLineChart = document
        .getElementById("multipleLineChart")
        .getContext("2d"),
      multipleBarChart = document
        .getElementById("multipleBarChart")
        .getContext("2d"),
      htmlLegendsChart = document
        .getElementById("htmlLegendsChart")
        .getContext("2d");

    var myLineChart = new Chart(lineChart, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Active Users",
            borderColor: "#1d7af3",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#1d7af3",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 2,
            data: [
              542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
            ],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          labels: {
            padding: 10,
            fontColor: "#1d7af3",
          },
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 10,
          yPadding: 10,
          caretPadding: 10,
        },
        layout: {
          padding: { left: 15, right: 15, top: 15, bottom: 15 },
        },
      },
    });

    var myBarChart = new Chart(barChart, {
      type: "bar",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Sales",
            backgroundColor: "rgb(23, 125, 255)",
            borderColor: "rgb(23, 125, 255)",
            data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    });

    var myPieChart = new Chart(pieChart, {
      type: "pie",
      data: {
        datasets: [
          {
            data: [50, 35, 15],
            backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
            borderWidth: 0,
          },
        ],
        labels: ["New Visitors", "Subscribers", "Active Users"],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          labels: {
            fontColor: "rgb(154, 154, 154)",
            fontSize: 11,
            usePointStyle: true,
            padding: 20,
          },
        },
        pieceLabel: {
          render: "percentage",
          fontColor: "white",
          fontSize: 14,
        },
        tooltips: false,
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
          },
        },
      },
    });

    var myDoughnutChart = new Chart(doughnutChart, {
      type: "doughnut",
      data: {
        datasets: [
          {
            data: [10, 20, 30],
            backgroundColor: ["#f3545d", "#fdaf4b", "#1d7af3"],
          },
        ],

        labels: ["Red", "Yellow", "Blue"],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
        },
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
          },
        },
      },
    });

    var myRadarChart = new Chart(radarChart, {
      type: "radar",
      data: {
        labels: ["Running", "Swimming", "Eating", "Cycling", "Jumping"],
        datasets: [
          {
            data: [20, 10, 30, 2, 30],
            borderColor: "#1d7af3",
            backgroundColor: "rgba(29, 122, 243, 0.25)",
            pointBackgroundColor: "#1d7af3",
            pointHoverRadius: 4,
            pointRadius: 3,
            label: "Team 1",
          },
          {
            data: [10, 20, 15, 30, 22],
            borderColor: "#716aca",
            backgroundColor: "rgba(113, 106, 202, 0.25)",
            pointBackgroundColor: "#716aca",
            pointHoverRadius: 4,
            pointRadius: 3,
            label: "Team 2",
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
        },
      },
    });

    var myBubbleChart = new Chart(bubbleChart, {
      type: "bubble",
      data: {
        datasets: [
          {
            label: "Car",
            data: [
              { x: 25, y: 17, r: 25 },
              { x: 30, y: 25, r: 28 },
              { x: 35, y: 30, r: 8 },
            ],
            backgroundColor: "#716aca",
          },
          {
            label: "Motorcycles",
            data: [
              { x: 10, y: 17, r: 20 },
              { x: 30, y: 10, r: 7 },
              { x: 35, y: 20, r: 10 },
            ],
            backgroundColor: "#1d7af3",
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
        },
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
          xAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    });

    var myMultipleLineChart = new Chart(multipleLineChart, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Python",
            borderColor: "#1d7af3",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#1d7af3",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 2,
            data: [30, 45, 45, 68, 69, 90, 100, 158, 177, 200, 245, 256],
          },
          {
            label: "PHP",
            borderColor: "#59d05d",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#59d05d",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 2,
            data: [10, 20, 55, 75, 80, 48, 59, 55, 23, 107, 60, 87],
          },
          {
            label: "Ruby",
            borderColor: "#f3545d",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#f3545d",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 2,
            data: [10, 30, 58, 79, 90, 105, 117, 160, 185, 210, 185, 194],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "top",
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 10,
          yPadding: 10,
          caretPadding: 10,
        },
        layout: {
          padding: { left: 15, right: 15, top: 15, bottom: 15 },
        },
      },
    });

    var myMultipleBarChart = new Chart(multipleBarChart, {
      type: "bar",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "First time visitors",
            backgroundColor: "#59d05d",
            borderColor: "#59d05d",
            data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
          },
          {
            label: "Visitors",
            backgroundColor: "#fdaf4b",
            borderColor: "#fdaf4b",
            data: [
              145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312, 356,
            ],
          },
          {
            label: "Pageview",
            backgroundColor: "#177dff",
            borderColor: "#177dff",
            data: [
              185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399,
            ],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
        },
        title: {
          display: true,
          text: "Traffic Stats",
        },
        tooltips: {
          mode: "index",
          intersect: false,
        },
        responsive: true,
        scales: {
          xAxes: [
            {
              stacked: true,
            },
          ],
          yAxes: [
            {
              stacked: true,
            },
          ],
        },
      },
    });

    // Chart with HTML Legends

    var gradientStroke = htmlLegendsChart.createLinearGradient(
      500,
      0,
      100,
      0
    );
    gradientStroke.addColorStop(0, "#177dff");
    gradientStroke.addColorStop(1, "#80b6f4");

    var gradientFill = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
    gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
    gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

    var gradientStroke2 = htmlLegendsChart.createLinearGradient(
      500,
      0,
      100,
      0
    );
    gradientStroke2.addColorStop(0, "#f3545d");
    gradientStroke2.addColorStop(1, "#ff8990");

    var gradientFill2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
    gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
    gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

    var gradientStroke3 = htmlLegendsChart.createLinearGradient(
      500,
      0,
      100,
      0
    );
    gradientStroke3.addColorStop(0, "#fdaf4b");
    gradientStroke3.addColorStop(1, "#ffc478");

    var gradientFill3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
    gradientFill3.addColorStop(0, "rgba(253, 175, 75, 0.7)");
    gradientFill3.addColorStop(1, "rgba(255, 196, 120, 0.3)");

    var myHtmlLegendsChart = new Chart(htmlLegendsChart, {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: [
          {
            label: "Subscribers",
            borderColor: gradientStroke2,
            pointBackgroundColor: gradientStroke2,
            pointRadius: 0,
            backgroundColor: gradientFill2,
            legendColor: "#f3545d",
            fill: true,
            borderWidth: 1,
            data: [
              154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374,
            ],
          },
          {
            label: "New Visitors",
            borderColor: gradientStroke3,
            pointBackgroundColor: gradientStroke3,
            pointRadius: 0,
            backgroundColor: gradientFill3,
            legendColor: "#fdaf4b",
            fill: true,
            borderWidth: 1,
            data: [
              256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521,
            ],
          },
          {
            label: "Active Users",
            borderColor: gradientStroke,
            pointBackgroundColor: gradientStroke,
            pointRadius: 0,
            backgroundColor: gradientFill,
            legendColor: "#177dff",
            fill: true,
            borderWidth: 1,
            data: [
              542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
            ],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 10,
          yPadding: 10,
          caretPadding: 10,
        },
        layout: {
          padding: { left: 15, right: 15, top: 15, bottom: 15 },
        },
        scales: {
          yAxes: [
            {
              ticks: {
                fontColor: "rgba(0,0,0,0.5)",
                fontStyle: "500",
                beginAtZero: false,
                maxTicksLimit: 5,
                padding: 20,
              },
              gridLines: {
                drawTicks: false,
                display: false,
              },
            },
          ],
          xAxes: [
            {
              gridLines: {
                zeroLineColor: "transparent",
              },
              ticks: {
                padding: 20,
                fontColor: "rgba(0,0,0,0.5)",
                fontStyle: "500",
              },
            },
          ],
        },
        legendCallback: function (chart) {
          var text = [];
          text.push('<ul class="' + chart.id + '-legend html-legend">');
          for (var i = 0; i < chart.data.datasets.length; i++) {
            text.push(
              '<li><span style="background-color:' +
                chart.data.datasets[i].legendColor +
                '"></span>'
            );
            if (chart.data.datasets[i].label) {
              text.push(chart.data.datasets[i].label);
            }
            text.push("</li>");
          }
          text.push("</ul>");
          return text.join("");
        },
      },
    });

    var myLegendContainer = document.getElementById("myChartLegend");

    // generate HTML legend
    myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

    // bind onClick event to all LI-tags of the legend
    var legendItems = myLegendContainer.getElementsByTagName("li");
    for (var i = 0; i < legendItems.length; i += 1) {
      legendItems[i].addEventListener("click", legendClickCallback, false);
    }
  </script>
@endsection

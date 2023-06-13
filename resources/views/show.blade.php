<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/admin/img/apple-icon.png');}}">
  <link rel="icon" type="image/png" href="{{ URL::asset('assets/admin/img/favicon.png');}}">
  <title>
    My Task
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ URL::asset('assets/admin/css/nucleo-icons.css');}}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/admin/css/nucleo-svg.css');}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">

  <link id="pagestyle" href="{{ URL::asset('assets/admin/css/material-dashboard.css?v=3.0.4');}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    * {
      font-family: museo sans;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: auto;
      padding: 12px 16px;
      z-index: 1;
    }

    .dropdown-content {
      display: block;
    }

    .nav-link {
      padding-top: 0.5rem !important;
      padding-bottom: 0.5rem !important;
    }
  </style>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100">

  @php $csvData= App\Models\CsvData::get(); @endphp
  <main class="main-content border-radius-lg ">
    <!-- Navbar -->

    <div class="container-fluid py-4">

      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                <h4 class="mb-0">{{number_format($csvData->sum('sales'), 2, '.', ',');}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Total sales </span>amount for each product</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Highest Selling product</p>
                <h4 class="mb-0">{{number_format($highest->HighestSales , 2, '.', ',');}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$highest->product}}</span> is highest selling product</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Average sales</p>
                <h4 class="mb-0">{{number_format($csvData->avg('sales'), 2, '.', ',');}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Average sales </span>amount across all products</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Highest Selling Month</p>
                <h4 class="mb-0">{{$highest->month_name}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{$highest->month_name}} </span>Highest Selling Month</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4 p-5">
      <div class="container p-5 text-center">
        <h5> Sales data in the graph Line Chart</h5>
 
        <div id="google-line-chart" style="width: 900px; height: 450px"></div>
 
      </div>
      <div class="row ">
        <div class="col-lg-12 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-body">
              <h6 class="mb-0 ">CSV Data</h6>
              <hr class="dark horizontal">
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped align-items-center mb-0" id="dataTable">
                  <thead class="table-dark">
                    <tr>
                      <th>#</th>
                      <th>Segment</th>
                      <th>Country</th>
                      <th>Product</th>
                      <th>Total Sales</th>
                      <th>Quantity Sold</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @if(!empty($final_out))
                    @foreach($final_out as $data)

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{$data['segment']}} </td>
                      <td>{{$data['country']}} </td>
                      <td>{{$data['product']}} </td>
                      <td>{{number_format($data['total_sales'], 2, '.', ',');}} </td>
                      <td>{{number_format($data['units_sold'], 2, '.', ',');}} </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    @else
                    <p> Record Not Found!</p>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>

      </div>
     
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script>
        $(document).ready(function() {
          $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
              'csv', 'print'
            ]
          });
        });
      </script>
      <!-- End Navbar -->

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-4">
              <div class="d-flex justify-content-center">
                <a href="#">&copy;Copyright 2023</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ URL::asset('assets/admin/js/core/popper.min.js');}}"></script>
  <script src="{{ URL::asset('assets/admin/js/core/bootstrap.min.js');}}"></script>
  <script src="{{ URL::asset('assets/admin/js/plugins/perfect-scrollbar.min.js');}}"></script>
  <script src="{{ URL::asset('assets/admin/js/plugins/smooth-scrollbar.min.js');}}"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js" defer></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ URL::asset('assets/admin/js/material-dashboard.min.js?v=3.0.4');}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.1/echarts.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {
 
        var data = google.visualization.arrayToDataTable([
            ['Sales', 'Months'],
 
                @php
                foreach($graphData as $d) {
                    echo "['".$d->month_name."', ".$d->total_sales."],";
                }
                @endphp
        ]);
 
        var options = {
          title: 'Sales data Month Wise',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
 
          var chart = new google.visualization.LineChart(document.getElementById('google-line-chart'));
 
          chart.draw(data, options);
        }
    </script>
</body>

</html>
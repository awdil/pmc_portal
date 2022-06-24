@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-success float-right">Capacity</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">4,088</h1>
                    <div class="stat-percent font-bold text-success"><i class="fa fa-address-card-o"></i></div>
                    <small>Total Seating Capacity per shift</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info float-right">Registration</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <div class="stat-percent font-bold text-info"><i class="fa fa-users"></i></div>
                    <small>Total Registration in this term</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary float-right">On waiting</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <div class="stat-percent font-bold text-navy"><i class="fa fa-clock-o"></i></div>
                    <small>Student Waiting to take the exam</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger float-right">Exam Centers</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">23</h1>
                    <div class="stat-percent font-bold text-danger"> <i class="fa fa-building"></i></div>
                    <small>Exam Centers</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 mt-3">
            <div class="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Issued Count</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">1,000</h1>
                                <small>Total number of chalan issued</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Viewed Count</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">950</h1>
                                <div class="stat-percent font-bold text-info">69% </div>
                                <small>%Age of total chalan</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Paid Count</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">600</h1>
                                <div class="stat-percent font-bold text-navy">81% </div>
                                <small>%Age of total chalan paid</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>MCB IPG Count</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">300</h1>
                                <div class="stat-percent font-bold text-danger">19% </div>
                                <small>%Age of total chalan paid</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Paid Count By Province</h5>
                </div>
                <div class="ibox-content">
                    <div id="morris-donut-chart" ></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Paid count by State / Paid Date </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered table-hover dataTables-example-2" >
                            <thead>
                            <tr>
                                <th>Province</th>
                                <th>20211229</th>
                                <th>20211221</th>
                                <th>20211220</th>
                                <th>20211219</th>
                                <th>20211218</th>
                                <th>20211217</th>
                                <th>20211216</th>
                                <th>20211215</th>
                                <th>Grand Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>Punjab</td>
                                    <td class="center">-</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">800</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">3000</td>
                                    <td class="center">1</td>
                                    <td class="center">30,800</td>
                                </tr>
                                <tr class="gradeC">
                                    <td>Sindh</td>
                                    <td class="center">-</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">800</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">3000</td>
                                    <td class="center">1</td>
                                    <td class="center">30,800</td>
                                </tr>
                                <tr class="gradeA">
                                    <td>Balochistan</td>
                                    <td class="center">-</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">800</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">3000</td>
                                    <td class="center">1</td>
                                    <td class="center">30,800</td>
                                </tr>
                                <tr class="gradeC">
                                    <td>KPK</td>
                                    <td class="center">-</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">800</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">3,000</td>
                                    <td class="center">1</td>
                                    <td class="center">30,800</td>
                                </tr>
                                <tr class="gradeC">
                                    <td>ICT</td>
                                    <td class="center">-</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">800</td>
                                    <td class="center">1</td>
                                    <td class="center">30</td>
                                    <td class="center">3,000</td>
                                    <td class="center">1</td>
                                    <td class="center">30,800</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="gradeA">
                                    <td>GRAND TOTAL</td>
                                    <td class="center">-</td>
                                    <td class="center">4</td>
                                    <td class="center">300</td>
                                    <td class="center">3,200</td>
                                    <td class="center">5</td>
                                    <td class="center">150</td>
                                    <td class="center">15,000</td>
                                    <td class="center">5</td>
                                    <td class="center">15,0800</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="wrapper wrapper-content">
            <div class="ibox-content">
                <div>
                    <span class="float-right text-right">
                    <small>PMC EC</strong></small>
                    </span>
                </div>

            <div>
                <canvas id="lineChart" height="200"></canvas>
            </div>

            <div class="m-t-md">
                <small class="float-right">
                    <i class="fa fa-clock-o"> </i>
                    Update on 16.11.2021
                </small>
               <small>
                   <strong>Analysis of PMC EC:</strong> The value has been changed over time, and last month.
               </small>
            </div>

        </div>
        </div>
    </div>
</div>
@endsection
@push('footer_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="{{ asset('assets/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
<script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Jvectormap -->
 <script src="{{ asset('assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

 <!-- EayPIE -->
 <script src="{{ asset('assets/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

 <!-- Sparkline -->
 <script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

 <!-- Sparkline demo data  -->
 <script src="{{ asset('assets/js/demo/sparkline-demo.js') }}"></script>

 <!-- Morris -->
 <script src="{{ asset('assets/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/morris/morris.js') }}"></script>

 <!-- iCheck -->
 <script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>

<script>
    $(document).ready(function() {

        var lineData = {
            labels: ["Rawalpindi", "Sukhar", "R.Y.K", "Islamabad", "Multan", "Karachi", "Lahore"],
            datasets: [
                {
                    label: "Exam Center",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: "Candidates",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [1265, 2159, 18980, 5281, 11256, 125005, 412130]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    });
</script>    
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });


    // Upgrade button class name
$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

$(document).ready(function(){
Morris.Donut({
element: 'morris-donut-chart',
data: [{ label: "Punjab", value: 2800 },
    { label: "Sindh", value: 3000 },
    { label: "KPK", value: 2000 } ,
    { label: "Balochistan", value: 2200 } ],
resize: true,
colors: ['#87d6c6', '#54cdb4','#1ab394','#2ab394'],
});

// Stocked horizontal bar

new Chartist.Bar('#ct-chart4', {
labels: ['Punjab', 'Sindh', 'ICT', 'KPK', 'Blochistan', 'AJK'],
series: [
    [5, 4, 3, 7, 5, 10],
    [3, 2, 9, 5, 4, 6]
]
}, {
seriesBarDistance: 10,
reverseData: true,
horizontalBars: true,
axisY: {
    offset: 70
}
});

$('.dataTables-example').DataTable({
pageLength: 5,
responsive: true,
});

$('.dataTables-example-2').DataTable({
pageLength: 5,
responsive: true,
});

});
</script>
@endpush

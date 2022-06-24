@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>NADRA Verification Report</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>NADRA Verification Report</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="" class="btn btn-primary">Admin This is action area</a> -->
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <!-- Tabs Begins-->
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>CNIC Number</th>
                                        <th>Name</th>
                                        <!-- <th>Urdu Name (registration form)</th> -->
                                        <th>Translated Urdu Name</th>
                                        <th>Eng Name (NADRA)</th>
                                        <th>Urdu Name (NADRA)</th>
                                        <th>Correction applied based on history</th>
                                        <th>Re-submission of information by user</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr class="">
                                        <td style="width: 144px;">31101-9856985-9</td>
                                        <td style="width: 134px;">Khadim Hussain</td>
                                        <td style="width: 134px;"></td>
                                        <td style="width: 134px;">Khadim Hussain</td>
                                        <td style="width: 134px;">خادم حسین</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px; color:green">Verified</td>
                                    </tr> -->
                                    <tr class="">
                                        <td style="width: 144px;">31101-9856854-1</td>
                                        <td style="width: 134px;">Gul Khan</td>
                                        <!-- <td style="width: 134px;"></td> -->
                                        <td style="width: 134px;">گلے خان</td>
                                        <td style="width: 134px;"></td>
                                        <td style="width: 134px;">گل خان</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">گل خان</td>
                                        <td style="width: 134px; color:green">Verified</td>
                                    </tr>
                                    <tr class="">
                                        <td style="width: 144px;">31101-9458854-3</td>
                                        <td style="width: 134px;">Durr-e-Adan</td>
                                        <!-- <td style="width: 134px;">-</td> -->
                                        <td style="width: 134px;">درر-ا-عدن</td>
                                        <td style="width: 134px;">Durr-e-Adan</td>
                                        <td style="width: 134px;">در عدن</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px; color:green">Verified</td>
                                    </tr>
                                    <tr class="">
                                        <td style="width: 144px;">31202-8754895-5</td>
                                        <td style="width: 134px;">Dil Awaiz</td>
                                        <!-- <td style="width: 134px;"></td> -->
                                        <td style="width: 134px;">دل آواز</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">دل آویز</td>
                                        <td style="width: 134px;">دل آویز || دل آواز</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px; color:green">Verified</td>
                                    </tr>
                                    <tr class="">
                                        <td style="width: 144px;">31101-9458854-3</td>
                                        <td style="width: 134px;">Robina Riaz</td>
                                        <!-- <td style="width: 134px;">-</td> -->
                                        <td style="width: 134px;">روبینہ ریاض</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">روبینہ ریاض</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px; color:green">Verified</td>
                                    </tr>
                                    <tr class="">
                                        <td style="width: 144px;">31101-9458443-3</td>
                                        <td  style="width: 134px;">Hasanaat Qazmi</td>
                                        <!-- <td style="width: 134px;"></td> -->
                                        <td style="width: 134px;">حسنات کاظمی</td>

                                        <td style="width: 134px;">Hasannat Ali Qazmi</td>
                                        <td style="width: 134px;">حسنات کاظمی</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px;">-</td>
                                        <td style="width: 134px; color:red">Not Verified</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Tabs Ends -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer_scripts')
<script>
    $(".select2_dropdown_city").select2({
        theme: 'bootstrap4',
        placeholder: "City",
        allowClear: true
    });

    $(".select2_dropdown_center_code").select2({
        theme: 'bootstrap4',
        placeholder: "Exam Center Code",
        allowClear: true
    });

    // Upgrade button class name
    $.fn.dataTable.Buttons.defaults.dom.button.className =
        "btn btn-white btn-sm";

    $(document).ready(function () {
        $(".exam-center-report").DataTable({
            searching: false,
            paging: false,
            info: false,
            pageLength: 25,
            responsive: true,
            // dom: '<"html5buttons"B>lTfgitp',
            // buttons: [
            // 	{ extend: "copy" },
            // 	{ extend: "csv" },
            // 	{ extend: "excel", title: "ExampleFile" },
            // 	{ extend: "pdf", title: "ExampleFile" },

            // 	{
            // 		extend: "print",
            // 		customize: function (win) {
            // 			$(win.document.body).addClass("white-bg");
            // 			$(win.document.body).css("font-size", "10px");

            // 			$(win.document.body)
            // 				.find("table")
            // 				.addClass("compact")
            // 				.css("font-size", "inherit");
            // 		},
            // 	},
            // ],
        });
    });


    let tableData = [
        {
            exam_center_name: "PMC Exam Center FBD",
            center_code: "PMC-EC-FBD-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Faisalabad, Senior Campus",
            contact_person: "Mr. Najeeb Choudhry 0409-9876565",
        },
        {
            exam_center_name: "PMC Exam Center, Gulberg Lahore",
            center_code: "PMC-EC-LHR-IV",
            address:
                "PMC Exam Center adjacent to Beaconhouse Liberty Campus, Lahore",
            contact_person: "Mr. Khawar Usman 0409-9856989",
        },
        {
            exam_center_name: "PMC Exam Center Malir, Karachi",
            center_code: "PMC-EC-KHI-II",
            address:
                "PMC Exam Center adjacent to Beaconhouse PECHS Campus, Karachi",
            contact_person: "Mr. Taimur Waleed 0409-9855896",
        },
        {
            exam_center_name: "PMC Exam Center Gujranwala",
            center_code: "PMC-EC-GJW-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Palm Tree campus, Gujranwala",
            contact_person: "Mr. Khan Muhammad 0409-9875875",
        },
        {
            exam_center_name: "PMC Exam Center Nowshera",
            center_code: "PMC-EC-NRA-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Narowal campus, Narowal",
            contact_person: "Mr. Usman Bin Khalid 0409-7458962",
        },
        {
            exam_center_name: "PMC Exam Center Gilgit",
            center_code: "PMC-EC-GB-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Gilgit Campus, Gilgit",
            contact_person: "Mr. Khalid Bin Waleed 0409-8596587",
        },
        {
            exam_center_name: "PMC Exam Center Bahawalpur",
            center_code: "PMC-EC-BWP-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Bahawalpur Campus, Bahawalpur",
            contact_person: "Mr. Khwaja Farid 0419-8577989",
        },
        {
            exam_center_name: "PMC Exam Center Rahim Yar Khan",
            center_code: "PMC-EC-RYK-I",
            address:
                "PMC Exam Center adjacent to Beaconhouse Rahim Yar Khan Campus, Rahim Yar Khan",
            contact_person: "Mr. Ali Usman 0419-8985878",
        },
    ];

    let tableBody = tableData.map(
        (item) => `<tr class="gradeX">
                        <td>${item.exam_center_name}</td>
                        <td>${item.center_code}</td>
                        <td>${item.address}</td>
                        <td class="center">${item.contact_person}</td>
                    </tr>`,
    );

    $("#exam-center-report-body").html(tableBody);
    console.log(tableBody);
</script>
@endpush
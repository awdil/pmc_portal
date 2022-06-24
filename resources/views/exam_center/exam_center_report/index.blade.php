@extends('exam_center.layouts.exam_center_main')

@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Exam Center Report</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exam Center Report</strong>
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
            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <a
                                        class="nav-link active"
                                        data-toggle="tab"
                                        href="#tab-1"
                                    >
                                        Search</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="nav-link"
                                        data-toggle="tab"
                                        href="#tab-2"
                                        >Advanced</a
                                    >
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div
                                    role="tabpanel"
                                    id="tab-1"
                                    class="tab-pane active"
                                >
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="col-md-8">
                                                {{-- <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                        </div>
                                                        <input type="text" placeholder="Search" class="form-control">
                                                    </div>
                                                </div> --}}
                                                <div class="input-group">
                                                    <input type="text" placeholder="Search " class="form-control"> 
                                                    <span class="input-group-append"> 
                                                        <button type="button" class="btn btn-primary">Search!</button> 
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="d-flex justify-content-end">
                                                    <button
                                                        class="btn btn-sm btn-primary"
                                                        type="submit"
                                                    >
                                                        <strong>Preview</strong>
                                                    </button>
                                                </div>
                                            </div> --}}
                                        </form>
                                    </div>
                                </div>
                                <div
                                    role="tabpanel"
                                    id="tab-2"
                                    class="tab-pane"
                                >
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-2 gray-bg">
                                                        <select class="select2 form-control" style="width: 100%;">
                                                            <option>Please Select City</option>
                                                            <option value="Bahamas">Lahore</option>
                                                            <option value="Bahrain">Karachi</option>
                                                            <option value="Bangladesh">Gujranwala</option>
                                                            <option value="Barbados">Nowshera</option>
                                                            <option value="Belarus">Gilgit</option>
                                                            <option value="Belgium">Bahawalpur</option>
                                                            <option value="Belize">Rahim Yar Khan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3 gray-bg">
                                                        <select class="select2 form-control" style="width: 100%;">
                                                            <option>Please Select Exam Center</option>
                                                            <option value="Bahamas">PMC-EC_FBD-I</option>
                                                            <option value="Bahrain">PMC-EC-LHR-IV</option>
                                                            <option value="Bangladesh">PMC-EC-KHI-II</option>
                                                            <option value="Barbados">PMC-EC-GJW-I</option>
                                                            <option value="Belarus">PMC-EC-NRA-I</option>
                                                            <option value="Belgium">PMC-EC-GB-I</option>
                                                            <option value="Belize">PMC-EC-BWP-I</option>
                                                            <option value="Benin">PMC-EC-RYK-I</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button
                                                    class="btn btn-sm btn-primary"
                                                    type="submit"
                                                >
                                                    <strong>Preview</strong>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered dataTable no-footer"
                                    >
                                        <thead>
                                            <tr class="gradeX">
                                                <th>Exam Center Name</th>
                                                <th>Center Code</th>
                                                <th>Address</th>
                                                <th>Contact Person</th>
                                            </tr>
                                        </thead>
                                        <tbody id="exam-center-report-body">
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
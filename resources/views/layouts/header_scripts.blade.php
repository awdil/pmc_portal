<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<!-- sweet alert -->
<link href="{{ asset('assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet"> -->


<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/loading.css') }}" rel="stylesheet">

<link href="{{ asset('assets/css/plugins/jsTree/style.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<link href="{{ asset('assets/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">

<!-- <link href="{{ asset('assets/css/plugins/select2/select2-bootstrap4.min.css') }}" rel="stylesheet"> -->

{{--<link href="{{ asset('assets/css/pmc_custome_style.css') }}" rel="stylesheet">--}}

<style type="text/css">
  
	.profile-details {
        margin-left: 110px;
        padding-top: 11px;
    }
    .info-box span {
        float: left;
    }
    .info-box img{
      width: 105px;
      margin-left: -7px;
    }
    .p-name {
        font-size: 19px;
        margin: 0px;
        font-weight: bold;
    }
    .profile-details .designation {
        font-size: 15px;
        margin-bottom: 5px;
    }
    .profile_head .main_heading {
         font-size: 26px;
        margin-top: 10px;
        font-weight: bold;
        margin-bottom: 23px;
    }
    .exam_center{
        font-size: 15px;
    }
    .info-box .campus-details {
        float: left;
        margin-right: 20px;
        padding-top: 15px;
    }

    .campus-details p {
        font-size: 15px;
        margin-bottom: 7px;
    }
    .campus-details a {
        font-size: 15px;
    }
    .date_time .time {
        font-size: 40px;
        margin-bottom: 0px;
    }
    .date_time .date {
        font-size: 14px;
    }

    #custom-search-input {
          margin:0;
          margin-top: 40px;
          padding: 0;
      }
   
      #custom-search-input .search-query {
          padding-right: 10px;
          padding-right: 10px \9;
          padding-left: 10px;
          padding-left: 10px \9;
          /* IE7-8 doesn't have border-radius, so don't indent the padding */
          margin-bottom: 0;
          /*-webkit-border-radius: 3px;*/
          /*-moz-border-radius: 3px;*/
          border-radius: 24px;
          border-color: #1c84c6;
      }
    .profile_head {
        background-color: #f7f7f7;
    }
      #custom-search-input button {
          border: 0;
        background: none;
        padding: 8px 8px;
        margin-top: 0;
        position: relative;
        left: -36px;
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color: #19aa8d;
      }
   
      .search-query:focus + button {
          z-index: 3;   
      }
      .search_roll_no{
          margin-bottom: 20px;
      }
      .search_roll_no {
        margin-bottom: 30px !important;
        margin-top: 10px !important;
    }

    .profile-details .location{
        font-size: 15px;
    }
    .table .fa.fa-check-square {
        font-size: 20px;
        color: blue;
        margin-left: 20px;
    }
    .check_verified {
        font-size: 20px;
        color: blue;
        margin-left: 11px;
    }
    .student-profile-image img{
        width: 150px;
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      opacity: 0.45; /* Firefox */
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
      opacity: 0.45; /* Firefox */
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
      opacity: 0.45; /* Firefox */
    }
	.profile-element img{
		width:100px;
	}


  .select2-results__option {
      float: left;
      width: 100%;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 26px;
      position: absolute;
      top: 4px;
      right: 1px;
      width: 20px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 35px;
  }

  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none;
  }

  .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #e5e6e7;
    border-radius: 0px; 
  }

  div.dataTables_wrapper div.dataTables_paginate {
    float: right;
    padding-top: 15px;
  }

  #my_camera{
    width: 320px;
    height: 240px;
    border: 1px solid black;
  }


  .user-image-col{
    display: flex;
    align-content: end;
    justify-items: end;
    justify-content: end;
  }
.student-profile-image-2 {
  width: 320px;
    height: 240px;
    background: #f1f1f1;
    padding-top: 17px;
}
.student-profile-image-2 img{
  height: 90%;
}
.inputgcogroup{
  padding: 6px 12px;
}

/* Summer Note */
.note-editor {
  height: auto !important;
}
.note-toolbar {
  background-color: rgba(0, 0, 0, 0.03);
}
.note-editor.fullscreen {
  z-index: 2050;
}
.note-editor.note-frame.fullscreen {
  z-index: 2020;
}
.note-editor.note-frame .note-editing-area .note-editable {
  color: #676a6c;
  padding: 15px;
}
.note-editor.note-frame {
  border: none;
}
.note-editor.panel {
  margin-bottom: 0;
}
.note-btn-group .note-btn {
  border: none;
}
</style>

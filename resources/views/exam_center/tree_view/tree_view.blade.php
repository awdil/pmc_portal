@push('header_scripts')
<link href="{{ asset('assets/css/plugins/jsTree/style.min.css" rel="stylesheet') }}">
@endpush
@extends('exam_center.layouts.exam_center_main')
@push('table-style')
 <!-- <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet"> -->
@endpush
@section('header')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Exams</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('exam-list') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Exams</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- <a href="/add-exam-center" class="btn btn-primary">Add New Exam Center</a> -->
        </div>
    </div>
</div>
@endsection

@section('content')


<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Subject List</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            {{-- <div id="jstree1">
                                <ul>
                                    <li class="jstree">Physics 
                                        <ul>
                                            <li>Velocity & Acceleration
                                                <ul>
                                                    <li>Diffeculty Easy
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Hard 
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Moderate
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                    
                                        </ul>
                                    </li>
                                    <li class="jstree">Chemistry  
                                        <ul>
                                            <li>Periodic Table
                                                <ul>
                                                    <li>Diffeculty Easy
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Hard 
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Moderate
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                    
                                        </ul>
                                    </li>
                                    <li class="jstree">Biology  
                                        <ul>
                                            <li>Nitrogen Cycle
                                                <ul>
                                                    <li>Diffeculty Easy
                                                        <ul>
                                                            <li>Level 1
                                                                <button style="margin-bottom: 2px;padding-bottom: 0px!important;padding-top: 0px!important;" type="button" class="btn btn-primary btn-xs " data-toggle="modal" data-target="#myModal6">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                    Add %
                                                                </button>
                                                            </li>
                                                            <li>Level 2
                                                                
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Hard 
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>Diffeculty Moderate
                                                        <ul>
                                                            <li>Level 1
                                                            </li>
                                                            <li>Level 2
                                                            </li>
                                                            <li>Level 3
                                                            </li>
                                                        </ul>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                    
                                        </ul>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                            {{-- <div class="col-lg-12">
                                <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                                    <p>Sign in today for more expirience.</p>
                                    <form role="form">
                                        <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                                        <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                                        <div>
                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                            <label> <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember me </label>
                                        </div>
                                    </form>
                            </div> --}}
                        </div>

                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">Physics</a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse in collapse" style="">
                                        <div class="panel-body">
                                            <div id="jstree1">
                                                <ul>
                                                    <li class="jstree"><b>Topic: </b>Velocity & Acceleration 
                                                        <ul>
                                                            <li>Diffeculty: Easy 
                                                                <ul>
                                                                    <li>Cognitive: Level 1 ( 02% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 2 ( 08% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 3 ( 12% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 4 ( 07% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 5 ( 11% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 6 ( 10% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                    <li>Cognitive: Level 7 ( 11% ) <span style="font-size:10px; color:blue; text-decoration:underline"> Edit</span>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>Diffeculty: Hard 
                                                                <ul>
                                                                    <li>Level 1
                                                                    </li>
                                                                    <li>Level 2
                                                                    </li>
                                                                    <li>Level 3
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>Diffeculty: Moderate
                                                                <ul>
                                                                    <li>Level 1
                                                                    </li>
                                                                    <li>Level 2
                                                                    </li>
                                                                    <li>Level 3
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        
                                                        </ul>
                                                    </li>
                                                    <li class="jstree"><b>Topic:  </b>Gravity  
                                                        <ul>
                                                            <li>Periodic Table
                                                                <ul>
                                                                    <li>Diffeculty Easy
                                                                        <ul>
                                                                            <li>Level 1
                                                                            </li>
                                                                            <li>Level 2
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>Diffeculty Hard 
                                                                        <ul>
                                                                            <li>Level 1
                                                                            </li>
                                                                            <li>Level 2
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>Diffeculty Moderate
                                                                        <ul>
                                                                            <li>Level 1
                                                                            </li>
                                                                            <li>Level 2
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                
                                                                </ul>
                                                            </li>
                                                    
                                                        </ul>
                                                    </li>
                                                    <li class="jstree"><b>Topic:  </b>Collision  
                                                        <ul>
                                                            <li>Nitrogen Cycle
                                                                <ul>
                                                                    <li>Diffeculty Easy
                                                                        <ul>
                                                                            <li>Level 1
                                                                                <button style="margin-bottom: 2px;padding-bottom: 0px!important;padding-top: 0px!important;" type="button" class="btn btn-primary btn-xs " data-toggle="modal" data-target="#myModal6">
                                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                                    Add %
                                                                                </button>
                                                                            </li>
                                                                            <li>Level 2
                                                                                
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>Diffeculty Hard 
                                                                        <ul>
                                                                            <li>Level 1
                                                                            </li>
                                                                            <li>Level 2
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>Diffeculty Moderate
                                                                        <ul>
                                                                            <li>Level 1
                                                                            </li>
                                                                            <li>Level 2
                                                                            </li>
                                                                            <li>Level 3
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                
                                                                </ul>
                                                            </li>
                                                    
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">Chemistry</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">Biology</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
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
    
        <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset('assets/js/inspinia.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>

        <script src="{{ asset('assets/js/plugins/jsTree/jstree.min.js') }}"></script>
       

        <style>
            .jstree-open > .jstree-anchor > .fa-folder:before {
                content: "\f07c";
            }
        
            .jstree-default .jstree-icon.none {
                width: 0;
            }
        </style>
        
        <script>
            $(document).ready(function(){
        
                $('#jstree1').jstree({
                    'core' : {
                        'check_callback' : true
                    },
                    'plugins' : [ 'types', 'dnd' ],
                    'types' : {
                        'default' : {
                            'icon' : 'fa fa-folder'
                        },
                        'html' : {
                            'icon' : 'fa fa-file-code-o'
                        },
                        'svg' : {
                            'icon' : 'fa fa-file-picture-o'
                        },
                        'css' : {
                            'icon' : 'fa fa-file-code-o'
                        },
                        'img' : {
                            'icon' : 'fa fa-file-image-o'
                        },
                        'js' : {
                            'icon' : 'fa fa-file-text-o'
                        }
        
                    }
                });
        
                $('#using_json').jstree({
                    'core' : {
                    'data' : [
                        'Empty Folder',
                        {
                            'text': 'Resources',
                            'state': {
                                'opened': true
                            },
                            'children': [
                                {
                                    'text': 'css',
                                    'children': [
                                        {
                                            'text': 'animate.css', 'icon': 'none'
                                        },
                                        {
                                            'text': 'bootstrap.css', 'icon': 'none'
                                        },
                                        {
                                            'text': 'main.css', 'icon': 'none'
                                        },
                                        {
                                            'text': 'style.css', 'icon': 'none'
                                        }
                                    ],
                                    'state': {
                                        'opened': true
                                    }
                                },
                                {
                                    'text': 'js',
                                    'children': [
                                        {
                                            'text': 'bootstrap.js', 'icon': 'none'
                                        },
                                        {
                                            'text': 'inspinia.min.js', 'icon': 'none'
                                        },
                                        {
                                            'text': 'jquery.min.js', 'icon': 'none'
                                        },
                                        {
                                            'text': 'jsTree.min.js', 'icon': 'none'
                                        },
                                        {
                                            'text': 'custom.min.js', 'icon': 'none'
                                        }
                                    ],
                                    'state': {
                                        'opened': true
                                    }
                                },
                                {
                                    'text': 'html',
                                    'children': [
                                        {
                                            'text': 'layout.html', 'icon': 'none'
                                        },
                                        {
                                            'text': 'navigation.html', 'icon': 'none'
                                        },
                                        {
                                            'text': 'navbar.html', 'icon': 'none'
                                        },
                                        {
                                            'text': 'footer.html', 'icon': 'none'
                                        },
                                        {
                                            'text': 'sidebar.html', 'icon': 'none'
                                        }
                                    ],
                                    'state': {
                                        'opened': true
                                    }
                                }
                            ]
                        },
                        'Fonts',
                        'Images',
                        'Scripts',
                        'Templates',
                    ]
                } });
        
            });
        </script>
    
@endpush
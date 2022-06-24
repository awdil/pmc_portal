<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <img alt="image" class="rounded-circle" src="{{ \Auth::user()->profile_picture_url }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ \Auth::user()->name }}</span>
                        <span class="text-muted text-xs block">Account Info <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('update-profile') }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Log out
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    PMC-ES
                </div>
            </li>

            @role('user')
            <li>
                <a href="{{ route('candidate-dashboard') }}">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('update-profile') }}">
                    <i class="fa fa-user"></i> 
                    <span class="nav-label">Update Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('documents-upload') }}">
                    <i class="fa fa-files-o"></i> 
                    <span class="nav-label">Documents Upload</span>
                </a>
            </li>
            <li>
                <a href="{{ route('exam-registration') }}">
                    <i class="fa fa-edit"></i> 
                    <span class="nav-label">Exam Registration</span>
                </a>
            </li>
            <li>
                <a href="{{ route('application-history') }}">
                    <i class="fa fa-id-badge"></i> 
                    <span class="nav-label">Application History</span>
                </a>
            </li>
            <li>
                <a href="{{ route('service-desk') }}">
                    <i class="fa fa-envelope-open-o"></i> 
                    <span class="nav-label">Support Service Desk</span>
                </a>
            </li>
            @endrole


            @role('administrator|examiner')
            <li>
                <a href="{{ route('admin-dashboard') }}">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
           
            <li>
                <a href="{{ route('candidates') }}">
                    <i class="fa fa-users"></i> 
                    <span class="nav-label">Candidates List</span>
                </a>
            </li>

            

            <li>
                <a href="{{ route('nadra-verification-reports') }}">
                    <i class="fa fa-check"></i> 
                    <span class="nav-label">Nadra Verifications</span>
                </a>
            </li>
            @endrole
            

            @role('administrator')
            <!-- <li>
                <a href="{{ route('admin-reports') }}">
                    <i class="fa fa-file-text-o"></i> 
                    <span class="nav-label">Reports</span>
                </a>
            </li> -->
            <li>
                <a href="{{ route('examiners-list') }}">
                    <i class="fa fa-eye"></i> 
                    <span class="nav-label">Examiners List</span>
                </a>
            </li>

            <li>
                <a href="">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label">Reports</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="{{ route('report.exam-centers') }}">
                            <span class="nav-label">Exam Centers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.candidate-states') }}">
                            <span class="nav-label">Candidate Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.registrations') }}">
                            <span class="nav-label">Registrations</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.attendance-status') }}">
                            <span class="nav-label">Attendance Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.payment-status') }}">
                            <span class="nav-label">Payment Status</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-key"></i> 
                    <span class="nav-label">Roles & Permissions</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                   
                    <li>
                        <a href="{{ route('roles-permission-assignment-list') }}"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Roles Assignment</span></a>
                    </li>
        
                    <li>
                        <a href="{{ route('roles.index') }}"><i class="fa fa-bars"></i> <span class="nav-label">Roles</span></a>
                    </li>

                    <li>
                        <a href="{{ route('permissions.index') }}"><i class="fa fa-unlock"></i> <span class="nav-label">Permissions</span></a>
                    </li>
        
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label">Settings</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                   
                    <li>
                        <a href="{{ route('exam-list') }}"><i class="fa fa-pencil-square-o"></i> <span class="nav-label">Exams List</span></a>
                    </li>
        
                    <li>
                        <a href="{{ route('exam-centers') }}"><i class="fa fa-building"></i> <span class="nav-label">Exam Centers List</span></a>
                    </li>

                    <li>
                        <a href="{{ route('exams-calender') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Exam Calender</span></a>
                    </li>
        
                    <li>
                        <a href="{{ route('exams-calender-time-slots') }}"><i class="fa fa-clock-o"></i> <span class="nav-label">Exam Time Slots</span></a>
                    </li>
                </ul>
            </li>
            @endrole
        </ul>
    </div>
</nav>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('user.index')}}" aria-expanded="false"><i class="fas fa-user"></i></i> Users</a></li>
                        <li><a href="{{ route('role.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Roles</a></li>
                        <li><a href="{{ route('permission.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-settings-outline"></i>
                        <span>Config</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('countries.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Countries</a></li>
                        <li><a href="{{ route('states.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>States</a></li>
                        <li><a href="{{ route('districts.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Districts</a></li>
                        <li><a href="{{ route('colleges.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Colleges</a></li>
                        <li><a href="{{ route('agent.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Agent</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-warehouse"></i>
                        <span>Agency</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('student.index')}}" aria-expanded="false"><i class="fas fa-users"></i> Students List</a></li>
                        <li><a href="{{ route('admission.index')}}" aria-expanded="false"><i class="fas fa-university "></i> Admission</a></li>
                        <li><a href="{{ route('admission.getcommencedadmission')}}" aria-expanded="false"><i class="fas fa-user-graduate"></i> Commenced Admission</a></li>
                        <li><a href="{{ route('commission-claim.index')}}" aria-expanded="false"><i class="fas fa-calendar-times"></i> Commission Scheduled Lists</a></li>
                        <li><a href="{{ route('commission-claim.claimed')}}" aria-expanded="false"><i class="fas fa-dollar-sign"></i> Commission Claimed</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

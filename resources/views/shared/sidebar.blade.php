<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{!! route('admin.dashboard') !!}">
            <img src="{!! asset('images/PICA.jpeg') !!}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{!! route('admin.dashboard') !!}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-home"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.program.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-th-large"></span><span class="mtext">Program</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.subject.index') }}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-book"></span><span class="mtext">Subject</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-chalkboard-teacher"></span><span class="mtext">Faculty</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-user-graduate"></span><span class="mtext">Student</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>

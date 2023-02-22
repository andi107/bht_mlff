<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <ul class="site-menu" data-plugin="menu">
                <li class="site-menu-category">General</li>
                {{-- <li class="site-menu-item active"> --}}
                <li class="site-menu-item {{ \Hlp::chkActive(route('dashboard')) }}">
                    <a class="animsition-link" href="{{ route('dashboard') }}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="site-menu-item {{ \Hlp::chkActive(route('customer_list')) }}">
                    <a class="animsition-link" href="{{ route('customer_list') }}">
                        <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                        <span class="site-menu-title">Customer</span>
                    </a>
                </li>
                <li class="site-menu-category">Menu</li>
                <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Tracking Asset</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Outdoor Tracking</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Indoor Tracking</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Vehicle Tracking</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (\Hlp::chkActive(route('device_list')) || \Hlp::chkActive(route('device_create_index')))
                    <li class="site-menu-item has-sub active open">
                @else
                    <li class="site-menu-item has-sub">
                @endif
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Device Management</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ \Hlp::chkActive(route('device_list')) }}">
                            <a class="animsition-link" href="{{ route('device_list') }}">
                                <span class="site-menu-title">Device List</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ \Hlp::chkActive(route('device_create_index')) }}">
                            <a class="animsition-link" href="{{ route('device_create_index') }}">
                                <span class="site-menu-title">Add New Device</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Alert Notification</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Notification List</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Add New Notification</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (\Hlp::chkActive(route('geo_create_index')))
                    <li class="site-menu-item has-sub active open">
                @else
                    <li class="site-menu-item has-sub">
                @endif
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                        <span class="site-menu-title">Configuration</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Geo List</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ \Hlp::chkActive(route('geo_create_index')) }}">
                            <a class="animsition-link" href="{{ route('geo_create_index') }}">
                                <span class="site-menu-title">Add Geo-Location</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="site-menu-category">Reporting</li>
                <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                        <span class="site-menu-title">Report 1</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <span class="site-menu-title">Report 1</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="#">
                                        <span class="site-menu-title">Panel Structure</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="#">
                                        <span class="site-menu-title">Panel Actions</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="#">
                                        <span class="site-menu-title">Panel Portlets</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Buttons</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Cards</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Dropdowns</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Icons</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-format-color-fill" aria-hidden="true"></i>
                        <span class="site-menu-title">Report 2</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item hidden-sm-down site-tour-trigger">
                            <a href="javascript:void(0)">
                                <span class="site-menu-title">Tour</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Animation</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Highlight</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="site-menu-item has-sub">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon md-puzzle-piece" aria-hidden="true"></i>
                        <span class="site-menu-title">Report 3</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Alerts</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Ribbon</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="#">
                                <span class="site-menu-title">Pricing Tables</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
            <div class="site-menubar-section">
                <h5>
                    Server CPU
                    <span class="float-right">30%</span>
                </h5>
                <div class="progress progress-xs">
                    <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>
                </div>
                <h5>
                    Server Memory
                    <span class="float-right">60%</span>
                </h5>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Settings">
            <span class="icon md-settings" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon md-eye-off" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
        </a>
    </div>
</div>

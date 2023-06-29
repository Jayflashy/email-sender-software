<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('admin.index')}}" class="waves-effect">
                        <i class="dripicons-device-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-mail"></i>
                        <span> Campaigns </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.campaigns.create')}}">New Campaign</a></li>
                        <li><a href="{{route('admin.campaigns')}}">All Campaigns</a></li>
                        <li><a href="{{route('admin.campaigns.report')}}">Campaign Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-browser"></i>
                        <span> Domains</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.domains.create')}}">Add Domain</a></li>
                        <li><a href="{{route('admin.domains')}}">All Domains</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-code"></i>
                        <span> Templates</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.templates.create')}}">Add Template</a></li>
                        <li><a href="{{route('admin.templates.index')}}">All Templates</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-user"></i>
                        <span>Subscribers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.subscriber.groups')}}">Groups</a></li>
                        <li><a href="{{route('admin.subscriber.index')}}">Subscribers</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-cog"></i>
                        <span> Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.setting.email')}}">SMTP Settings</a></li>
                        <li><a href="{{route('admin.setting.index')}}">General Settings</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="dripicons-blog"></i><span class="badge rounded-pill bg-success float-end">7</span>
                        <span> Forms </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Form Elements</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-advanced.html">Form Advanced</a></li>
                        <li><a href="form-editors.html">Form Editor</a></li>
                        <li><a href="form-uploads.html">Form File Upload</a></li>
                        <li><a href="form-mask.html">Form Mask</a></li>
                        <li><a href="form-xeditable.html">Form Xeditable</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

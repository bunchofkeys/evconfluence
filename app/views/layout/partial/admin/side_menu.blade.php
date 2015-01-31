<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">

        <p class="centered"><a href="profile.html"><img src="/assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
        <h5 class="centered">{{ Auth::user()->person->first_name }} {{ Auth::user()->person->last_name }}</h5>

        <li class="mt">
            {{ NavLink('Home', 'admin.index', 'fa-home')}}
        </li>

        <li class="sub-menu">
            {{ NavLink('User Management', 'admin.user.index', 'fa-users')}}
        </li>

        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-desktop"></i>
                <span>UI Elements</span>
            </a>
            <ul class="sub">
                <li><a  href="general.html">General</a></li>
                <li><a  href="buttons.html">Buttons</a></li>
                <li><a  href="panels.html">Panels</a></li>
            </ul>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>
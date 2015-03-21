<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">

        <h5 class="centered">{{ Auth::user()->person->first_name }} {{ Auth::user()->person->last_name }}</h5>

        <li class="mt">
            {{ NavLink('Home', 'admin.index', 'fa-home')}}
        </li>

        <li class="sub-menu">
            {{ NavLink('User Management', 'admin.user.index', 'fa-users')}}
        </li>
        <li class="sub-menu">
            {{ NavLink('Configuration', 'admin.configuration.index', 'fa-gear')}}
        </li>
    </ul>
    <!-- sidebar menu end-->
</div>
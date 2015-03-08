<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">

        <h5 class="centered">{{ Auth::user()->person->first_name }} {{ Auth::user()->person->last_name }}</h5>

        <li class="mt">
            {{ NavLink('Home', 'teacher.index', 'fa-home')}}
        </li>
        <li>
            {{ NavLink('Spe Management', 'teacher.period.index', 'fa-list-alt')}}
        </li>
    </ul>
    <!-- sidebar menu end-->
</div>
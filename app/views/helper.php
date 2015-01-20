<?php

function NavLink($name, $route, $icon)
{
    $output = "<a class='";
    if(Request::url()==URL::route($route))
    {
        $output = $output . "active'";
    }
    else
    {
        $output = $output . "'";
    }

    $output  = $output . "href='". URL::route($route) ."'>";
    $output  = $output . " <i class='fa " . $icon . "'></i>";
    $output  = $output . "<span>" . $name . "</span></a>";

    return $output;
}


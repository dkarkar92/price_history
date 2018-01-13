<?php

/**
 *
 */
function getCalendarDates() {
    $ranges = array();

    //last_week
    $previous_week = strtotime("-1 week +1 day");

    $start_week = strtotime("last sunday midnight", $previous_week);
    $end_week = strtotime("next saturday", $start_week);

    $ranges["Last Week"]["start"] = date("Y-m-d", $start_week);
    $ranges["Last Week"]["end"] = date("Y-m-d", $end_week);

    //this_week
    if (date("l") == "Sunday") {
        $ranges["This Week"]["start"] = date('Y-m-d');
    } else {
        $ranges["This Week"]["start"] = date('Y-m-d', strtotime("Last Sunday"));
    }
    $ranges["This Week"]["end"] = date('Y-m-d', strtotime("This Saturday"));

    //month
    $ranges["Month"]["start"] = date('Y-m-01');
    $ranges["Month"]["end"] = date('Y-m-t');

    //quarter
    /*$ranges["quarter"]["start"] = date('Y-m-d', strtotime("First Day of Quarter"));
    $ranges["quarter"]["end"] = date('Y-m-d', strtotime("Last Day of Quarter"));*/

    //year
    $ranges["Year"]["start"] = date('Y-01-01');
    $ranges["Year"]["end"] = date('Y-12-31');

    return $ranges;
}

?>
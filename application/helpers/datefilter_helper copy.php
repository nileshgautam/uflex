<?php
//  change date format yymmddtt to DDMMYY
function ddmmyytt($date)
{
    // echo '<pre>';
    // print_r($date);die;
    $date = explode("-", $date);
    $d = explode(" ", $date[2]);
    $yy = $date[0];
    $mm = $date[1];
    $dd = $d[0];
    $fdate = $dd . '-' . $mm . '-' . $yy;
    return $fdate;
}
//  change date format yymmdd to DDMMYY
function ddmmyy($date)
{
    $date = explode("-", $date);
    // $d=explode(" ",$date[2]);
    $yy = $date[0];
    $mm = $date[1];
    $dd = $date[2];
    $fdate = $dd . '-' . $mm . '-' . $yy;
    return $fdate;
}

//  change date format MMDDYY to YYMMDD
function yymmdd($date)
{
    $date = explode("/", $date);
    // print_r($date);die;
    $dd = $date[0];
    $mm = $date[1];
    $yy = $date[2];
    $date = $yy . '-' . $mm . '-' . $dd;
    return $date;
}

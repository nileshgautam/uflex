<?php
// //  change date format yymmddtt to DDMMYY
// function ddmmyytt($date)
// {
//     // echo '<pre>';
//     // print_r($date);die;
//     $date = explode("-", $date);
//     $d = explode(" ", $date[2]);
//     $yy = $date[0];
//     $mm = $date[1];
//     $dd = $d[0];
//     $fdate = $dd . '-' . $mm . '-' . $yy;
//     return $fdate;
// }


//  change date format yymmdd to DDMMYY

function mdy($date)
{
    $date = explode("-", $date);
    // $d=explode(" ",$date[2]);
    $yy = $date[0];
    $mm = $date[1];
    $dd = $date[2];
    $fdate = $mm .'/'. $dd .'/'.$yy;
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
    $fdate = $dd .'/'. $mm .'/'.$yy;
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


// functiont to RemoveSpecialChar
function RemoveSpecialChar($value){
    $result  = preg_replace('/[^a-zA-Z0-9_ -]/s','',$value);
 return $result;   
}

// Function to validate inputs 

function validateInput($inp)
{
    $val = htmlspecialchars($inp, ENT_QUOTES);
    $val = stripslashes($val);
    $val = trim($val);
    return $val;
}
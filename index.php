<?php


include 'interface.php';
include 'class.php';

function match($c1, $c2){
    
    $data = new GiveMeData();

    $forecast = new MyForecast($data->getData());


    $result = new GiveMeForecast($forecast);

    return $result->match($c1,$c2);
    
}


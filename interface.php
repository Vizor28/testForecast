<?php 

interface Forecast{
    
    public function match($c1, $c2);
    
}

interface ForecastData{
    
    public function getData();
    
}
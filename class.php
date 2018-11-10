<?php 

class GiveMeForecast{
    
    protected $forecast;
    
    function __construct(Forecast $forecast){
         
        $this->forecast = $forecast; 
        
    }
    
    public function match($c1, $c2){
        
        return $this->forecast->match($c1, $c2);
        
    }
    
    
}


class MyForecast implements Forecast{
    
    protected $data;
    
    function __construct($data){
        
        $this->data = $data;    
        
    }
    
    public function match($c1, $c2){
        
        $comand1 = $this->getDataWithComand($c1);
        $comand2 = $this->getDataWithComand($c2);
        
        if($comand1 && $comand2){
            
            
            $number_comand1 = $this->getNumbers($comand1);   
            $number_comand2 = $this->getNumbers($comand2); 
            

            $k = $this->getKoefForWin($number_comand1[0], $number_comand2[0]);
            $balls_comand1 = $k * $number_comand1[2];
            $k = $this->getKoefForDefeat($number_comand1[1], $number_comand2[1]);
            $balls_comand1 = round($k * $balls_comand1);
            
            $k = $this->getKoefForWin($number_comand2[0], $number_comand1[0]);
            $balls_comand2 = $k * $number_comand2[2];
            $k = $this->getKoefForDefeat($number_comand2[1], $number_comand2[1]);
            $balls_comand2 = round($k * $balls_comand2);
            
            
            return array($balls_comand1, $balls_comand2);
            
        }else{
            
            return new Exception('The command does not exist');
            
        }
        
    }
    
    protected function getKoefForWin($k1, $k2){
        
        $k = 1; 
        
        if($k1 > $k2){
                    
            $k = 1.2;
                    
        }else{
                    
            $k = 0.8;
                    
        }
        
        return $k;
        
    }
    
    protected function getKoefForDefeat($k1, $k2){
        
        $k = 1; 
        
        if($k1 < $k2){
                    
            $k = 1.2;
                    
        }else{
                    
            $k = 0.8;
                    
        }
        
        return $k;
        
    }
    
    protected function getNumbers($comand){
        
        $k_win = $comand['win'] / $comand['games'] * 100;
        $k_defeat = $comand['defeat'] / $comand['games'] * 100;
        $balls_scored = $comand['goals']['scored'] / $comand['games'];
        $balls_skiped = $comand['goals']['skiped'] / $comand['games'];
        
        return array($k_win, $k_defeat, $balls_scored, $balls_skiped);
    }
    
    private function getDataWithComand($c){
        
        if(isset($this->data[$c])){
            
            return $this->data[$c];
            
        }else{
            
            return false;
            
        }
        
    }
    
}



class GiveMeData implements ForecastData{
    
    
    public function getData(){
        
        return include 'data.php';
        
    }
    
    
} 



<?php

namespace App\Services;

class SawCalculator {
    public $data_kriteria;
    public $atribut;
    public $bobot;
    public $normal;
    public $bobot_normal;
    public $terbobot;
    public $total;
    public $rank;
    

    public function get_calculate($data_kriteria,$atribut,$bobot)
    {
        // Transpose array/matriks
         $arr = array();
         foreach ($data_kriteria as $key => $val){
             foreach($val as $k => $v){
                 $arr[$k][$key] = $v;
             }
         }
 
         // mencari minmax per kriteria
         $min = array();
         $max = array();
         foreach($arr as $key => $val){
             $min[$key] = min($val);
             $max[$key] = max($val);
         }
 
         // Proses Normalisasi
         $this->normal= [];
         foreach ($data_kriteria as $key => $val) {
            foreach ($val as $k => $v) {
                if ($atribut[$k] == 'benefit') {
                    $this->normal[$key][$k] = $v / $max[$k];
                } else {
                    $this->normal[$key][$k] = $min[$k] / $v;
                }
            }
        }
        
        // normalisasi bobot
        $total_bobot = array_sum($bobot);
        foreach($bobot as $key => $val){
            $this->bobot_normal[$key] = $val / $total_bobot;
        }

        // mengkalikan kriteria normalisasi dengan bobot ternomalisasi
        // if ($this->normal !== null) {
        
            $this->terbobot = array(array());
            foreach($this->normal as $key =>$val){
                foreach($val as $k=>$v){
                    $this->terbobot[$key][$k] = $v * $this->bobot_normal[$k];
                }
            }
        // }

        // mendapatkan total bobot satu pegawai
        foreach($this->terbobot as $key=>$val){
            $this->total[$key] = array_sum($val);
        }

        return $this->total;
       
    }

    function get_rank($data_kriteria,$atribut,$bobot){
        $total = $this->get_calculate($data_kriteria,$atribut,$bobot);
        arsort($total);
        $rank =1;
        foreach($total as $key=>$val){
            $this->rank[$key] = $rank++;
        }

        return $this->rank;
    }

    
}

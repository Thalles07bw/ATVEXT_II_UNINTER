<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseTempo;

class TimeController extends Controller
{     
    /** 
    * Display homepage.
    *
    * @return Response
    */

    public function showTimestamp()
    {   
        
        $tempo_atual = new ClasseTempo();
        $data_hora = $tempo_atual->mostraTimestamp();
            
        return view('testebanco', [
            'data_hora' => $data_hora
        ]);
    }

}

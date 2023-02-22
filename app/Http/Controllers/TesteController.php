<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function testeget()
    {
        //$var = "retorno teste";
        $var['chave1'] = 1;
        $var['chave2'] = "teste";
        //dd($var);
        return response()->json($var);
        return $var;
        return json_encode($var);
    }

    public function testePost(Request $request)
    {
        //dd($request->all());
        return response()->json($request->all());
    }

    public function testelogin(Request $request)
    {
        //dd($request->all());
        return response()->json($request->all());
    }

    public function testelista()
    {
        $array['pessoas'][] = 'fulano';
        $array['pessoas'][] = 'ciclano';


        return response()->json($array);
    }

}

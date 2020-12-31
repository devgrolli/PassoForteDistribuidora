<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller{
    public function getIndex(Request $request) {
        dd($request);
        $results = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $request->get('cep'));

        dd($results);
        return response()->json($results);
    }
}

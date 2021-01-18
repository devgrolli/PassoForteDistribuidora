<?php

namespace App\Http\Controllers;
use App\Produto;
use Illuminate\Http\Request;

class CsvFileController extends Controller{
    function index(){
        $data = Produto::latest()->paginate(10);
        return view('csv_file_pagination', compact('data'))
            ->with('i', (request()->input('page', 1) -1) * 10);
    }
}

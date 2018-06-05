<?php

namespace App\Http\Controllers;

use App\Train;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    public function index($id)
    {

        $train = Train::find($id);
        return view('train', ['train' => $train]);
    }
}

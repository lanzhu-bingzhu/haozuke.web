<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\lib\MyEs;
use Illuminate\Http\Request;

class EsController extends Controller
{
    public function index(){
        $es = new MyEs();
        $data = [
            'name' => '温切斯特',
            'country' => '美国'
        ];

        $res = $es->update_doc('xpx3F4QBQTOc46ELPA9r', 'test', $data);

        dd($res);
    }
}

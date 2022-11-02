<?php

namespace App\Http\Controllers;

use App\Models\ApiUser;
use Illuminate\Http\Request;

class ApiuserController extends Controller
{
    public function index() {
        $data = ApiUser::all();

        return view('apiuser.apiuser-list', ['user' => $data]);
    }
}

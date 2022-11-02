<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index() {
        $data = Notice::with(['owner'])->paginate(10);

        return view('notice.notice-list', ['notice' => $data]);
    }

    public function create() {
        return view('notice.notice-add');
    }
}

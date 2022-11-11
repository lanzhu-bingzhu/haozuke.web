<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Renting;
use Exception;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * 获取看房通知
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        $openid = $request->get('openid');

        try {
            $id = Renting::where('openid', $openid)->value('id');
            
            $data = Notice::where('renting_id', $id)->with(['owner'])->orderBy('id', 'desc')->get();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Fangattr;
use App\Models\Power;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 调用成功回调接口
     *
     * @param array $data
     * @param string $msg
     * @param integer $code
     * @return void
     */
    public function success($data = [], $msg = '', $code = 200) {
        return json_encode([
            'msg' => $msg,
            'code' => $code,
            'data' => $data
        ]);
    }

    /**
     * 调用失败回调接口
     *
     * @param string $msg
     * @param integer $code
     * @param array $data
     * @return void
     */
    public function fail($msg = '', $code, $data = []) {
        return json_encode([
            'msg' => $msg,
            'code' => $code,
            'data' => $data
        ]);
    }

    /**
     * 发送邮件
     *
     * @param string $type 视图
     * @param array $data 数据
     * @param string $account 收件人
     * @return void
     */
    public function email($type, $data, $account) {
        Mail::send('email.'.$type, $data, function (Message $message) use ($account) {
            $message->to($account);
            $message->subject('后台-管理员管理');
        });
    }

    /**
     * 排序递归
     *
     * @param array $arr
     * @param integer $pid
     * @param string $html
     * @param integer $level
     * @return void
     */
    public function treen($arr, $pid = 0, $html = '--', $level = 0) {
        static $data = [];
        foreach ($arr as $key => $val) {
            if ($val['pid'] == $pid) {
                $data[$key] = $val;
                $data[$key]['level'] = $level + 1;
                $data[$key]['html'] = str_repeat($html, $level * 2);
                $this->treen($arr, $val['id'], $html, $data[$key]['level']);
            }
        }
        return $data;
    }

    /**
     * 无限极递归
     *
     * @param array $arr
     * @param integer $pid
     * @return void
     */
    public function treenChildren($arr, $pid = 0) {
        $data = [];
        foreach ($arr as $key => $val) {
            if ($val['pid'] == $pid) {
                $data[$key] = $val;
                $data[$key]['treenChildren'] = $this->treenChildren($arr, $val['id']);
            }
        }
        return $data;
    }

    /**
     * 文章内容过滤
     *
     * @param array $data
     * @return void
     */
    public function articleStrip($data) {
        $data['title'] = strip_tags($data['title']);
        $data['desc'] = strip_tags($data['desc']);
        $data['author'] = strip_tags($data['author']);
        $data['body'] = htmlspecialchars($data['body']);

        return $data;
    }
}

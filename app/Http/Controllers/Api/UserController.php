<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Renting;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 添加用户信息
     *
     * @param Request $request
     * @return void
     */
    public function setUserInfo(Request $request) {
        $userinfo = $request->post('userinfo');
        $openid = $request->post('openid');

        try {
            // 根据openid修改数据，将用户信息添加入库
            Renting::where('openid', $openid)->update([
                'nickname' => $userinfo['nickName'],
                'avatar' => $userinfo['avatarUrl']
            ]);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success('', '添加成功');
    }

    /**
     * 获取用户信息
     *
     * @param Request $request
     * @return void
     */
    public function getUserInfo(Request $request) {
        $openid = $request->get('openid');

        // 查询用户信息
        try {
            $userinfo = Renting::where('openid', $openid)->first();
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success(['userinfo' => $userinfo], '查询成功');
    }

    /**
     * 文件上传
     *
     * @param Request $request
     * @return void
     */
    public function fileUpload(Request $request) {
        try {
            $file = $request->file('card_img')->store('', 'card');
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success(['img_path' => $file], '上传成功');
    }

    /**
     * 用户认证信息添加
     *
     * @param Request $request
     * @return void
     */
    public function cardUpload(Request $request) {
        $data = $request->validate([
            'openid' => ['required'],
            'card_img' => ['required'],
            'card' => ['required'],
            'truename' => ['required']
        ]);

        try {
            Renting::where('openid', $data['openid'])->update([
                'truename' => $data['truename'],
                'card' => $data['card'],
                'card_img' => $data['card_img'],
                'is_auth' => '1'
            ]);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success('', '添加成功');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use App\Models\Renting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 账号登陆
     *
     * @param Request $request
     * @param ApiUser $apiUser
     * @return void
     */
    public function login(Request $request, ApiUser $apiUser) {
        // $validated = $request->all();

        $validated = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $bool = Auth::guard('apiweb')->attempt($validated);

        if ($bool) {
            // 生成token
            // 获取登陆模型
            $user = Auth::guard('apiweb')->user();

            if ($user->click > config('apilogin.click')) {
                return $this->fail('当天请求次数已达上限', 0);
            }

            $token = $user->createToken('api')->accessToken;
            // 请求次数+1
            $apiUser->where('id', $user->id)->update(['click' => $user->click + 1]);

            return $this->success([
                'ext' => 7200,
                'token' => $token
            ], '登陆成功');
        }

        return $this->fail('登陆失败', 1200);
    }

    /**
     * 微信小程序静默登陆请求接口
     *
     * @param Request $request
     * @return void
     */
    public function wxlogin(Request $request) {
        $code = $request->get('code');
        // 请求链接
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".config('apilogin.wx_appid')."&secret=".config('apilogin.wx_secret')."&js_code=".$code."&grant_type=authorization_code";
        // 获取openid
        $data = file_get_contents($url);

        $arr = json_decode($data, true);

        if (Renting::where('openid', $arr['openid'])->first()) {
            return $this->success(['openid' => $arr['openid']]);
        }
        
        try {
            Renting::create(['openid' => $arr['openid']]);
        } catch (Exception $e) {
            // return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success(['openid' => $arr['openid']]);
    }
}

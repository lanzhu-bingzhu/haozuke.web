<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCount;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * 咨询列表
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
        try {
            $data = Article::orderBy('id', 'desc')->select(['id', 'title', 'pic', 'desc', 'created_at'])->simplePaginate(5);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success($data);
    }

    /**
     * 资讯详情
     *
     * @param Request $request
     * @return void
     */
    public function details(Request $request) {
        $id = $request->get('id');
        if (empty($id) or !is_numeric($id)) {
            return $this->fail('参数错误', 0);
        }

        try {
            $data = Article::find($id);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        if (empty($data)) {
            return $this->fail('页面不存在', 404);
        }

        return $this->success($data);
    }

    /**
     * 资讯用户访问记录
     *
     * @param Request $request
     * @return void
     */
    public function count(Request $request) {
        $openid = $request->post('openid');
        $article_id = $request->post('id');

        if (empty($article_id) and !is_numeric($article_id)) {
            return $this->fail('没有选择文章', 0);
        }

        try {
            $model = ArticleCount::create([
                'openid' => $openid,
                'art_id' => $article_id,
                'vdt' => date('Y-m-d'),
                'vtime' => time()
            ]);
        } catch (Exception $e) {
            return $this->fail('数据已存在', 0);
        }

        return $this->success($model);
    }
}

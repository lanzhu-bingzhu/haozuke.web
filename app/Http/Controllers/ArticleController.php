<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * 文章列表
     *
     * @return void
     */
    public function index(Request $request) {
        $h = $request->get('h');

        $data = Article::when($h, function ($query) use ($h) {
            return $query->where('title', 'like', "%$h%");
        })->orderBy('id', 'asc')->paginate(10);

        return view('article.article-list', ['articles' => $data, 'h' => $h, 'articleModel' => new Article()]);
    }

    /**
     * 文章添加页面
     *
     * @return void
     */
    public function create(Request $request) {
        $id = $request->get('id') ?? '';

        if (!empty($id)) {
            $data = Article::find($id);
        }

        return view('article.article-add', ['article' => $data ?? null]);
    }

    /**
     * 文章添加功能
     *
     * @return void
     */
    public function save(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'author' => 'required',
            'pic' => 'required',
            'body' => 'required'
        ]);
        // 预防XSS攻击
        // $validated['body'] = strip_tags($validated['body']);
        // $validated['body'] = htmlspecialchars($validated['body']);
        $validated = $this->articleStrip($validated);
        
        try {
            // 文件上传
            $validated['pic'] = $request->file('pic')->store('', 'article');
            
            // 插入
            Article::articleCreate($validated);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], '添加成功');
    }

    /**
     * 删除文章
     *
     * @return void
     */
    public function delete(Request $request) {
        $id = $request->all('id')['id'];
        $id = is_array($id) ? $id : [$id];
        // 验证参数
        if (empty($id)) {
            return $this->fail('参数错误', 1001);
        }
        try {
            Article::destroy($id);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 修改文章
     *
     * @return void
     */
    public function update(Request $request) {
        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'author' => 'required',
            'pic' => '',
            'body' => 'required'
        ]);
        // 验证参数
        if (empty($validated['id']) or !is_numeric($validated['id'])) {
            return $this->fail('参数错误', 1001);
        }
        // 预防XSS攻击
        // $validated['body'] = strip_tags($validated['body']);
        // $validated['body'] = htmlspecialchars($validated['body']);
        $validated = $this->articleStrip($validated);

        // 文件上传
        if (!empty($validated['pic'])) {
            $validated['pic'] = $request->file('pic')->store('', 'article');
        }

        try {
            // 用于文章内容的修改
            Article::articleUpdate($validated, $validated['id']);
        } catch (Exception $e) {
            return $this->fail($e->getMessage(), $e->getCode());
        }

        return $this->success([], 'ok');
    }

    /**
     * 富文本文件上传接口
     *
     * @return void
     */
    public function imageUpload(Request $request) {
        // 验证上传文件信息
        $file = $request->file();

        if (empty($file)) {
            return $this->fail('没有上传文件', 0);
        }

        // 文件上传
        $path = [];
        foreach ($file as $val) {
            $path[]['url'] = "/upload/article/" . Storage::disk('article')->put('', $val);
        }

        return ['errno' => 0, 'data' => $path];
    }
}

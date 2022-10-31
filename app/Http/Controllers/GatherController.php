<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use QL\QueryList;

class GatherController extends Controller
{
    public function index(QueryList $ql) {
        // 抓取数据
        $url = 'https://sh.news.anjuke.com/news/?from=HomePage_TopBar';
        $rules = [
            'title' => ['.item-col-right h3', 'text'],
            'href' => ['.item-col-right h3>a', 'href'],
            'pic' => ['.item-col-left>img', 'src']
        ];
        $range = '.main-list .m-list-item';

        $arr = $ql->get($url)->rules($rules)->range($range)->queryData();

        // 保存数据
        foreach ($arr as $key => &$val) {
            // 判断是否有标题
            if (isset($val['title']) && !empty($val['title'])) {
                // 判断是否有图片
                if (isset($val['pic']) && !empty($val['pic'])) {
                    $img = file_get_contents($val['pic']);
                    $path = './upload/article/' . rand(1, 9999999) . basename($val['pic']);
                    
                    if (file_put_contents($path, $img)) {
                        $val['pic'] = $path;
                        $val['created_at'] = time();
                        $val['updated_ar'] = time();
                    }
                }
            }
            unset($val['href']);
        }

        try {
            Article::insert($arr);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return 'ok';
    }
}

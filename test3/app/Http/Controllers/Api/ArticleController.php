<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $amount_of_page = 10;
        $article = Article::orderBy('created_at','desc')->paginate($amount_of_page);
        $total = Article::count();
        $data = [
            'article' => $article,
            'total' => $total,
            'amount_of_page' => $amount_of_page,

        ];
        return response()->json(
            [
                $data
            ],
            200
        );
    }

    public function findId($id)
    {

        $article = Article::find($id);

        return response()->json(
            [
                $article
            ],
            200
        );
    }


    public function search(Request $request)
    {
        $amount_of_page = 10;
        $articles = Article::orderBy('created_at','desc')->where('title', 'LIKE', "%{$request->value}%")->paginate($amount_of_page);
        $total = $articles->count();

        $data = [
            'total' => $total,
            'articles' => $articles,
            'amount_of_page' => $amount_of_page,

        ];
        return response()->json(
            [
                $data
            ],
            200
        );
    }
}

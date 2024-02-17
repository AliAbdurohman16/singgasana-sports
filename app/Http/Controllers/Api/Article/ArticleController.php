<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Helpers\ResponseFormatter;

class ArticleController extends Controller
{
    public function index($slug)
    {
        $article = Article::where(['slug' => $slug, 'status' => 'Publish'])
                            ->with('category')
                            ->first();

        $article->update(['viewers' => $article->viewers + 1]);

        return ResponseFormatter::success(['article' => $article], 'Services has been successfully displayed!');
    }
}

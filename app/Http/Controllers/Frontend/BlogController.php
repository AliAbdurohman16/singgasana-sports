<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Conner\Tagging\Model\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'articles' => Article::where('status', 'Publish')->orderBy('created_at', 'desc')->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        return view('frontend.blog.index', $data);
    }

    public function single($slug)
    {
        $article = Article::where(['slug' => $slug, 'status' => 'Publish'])->first();

        $data = [
            'article' => $article,
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        $article->update([
            'viewers' => $article->viewers + 1,
        ]);

        return view('frontend.blog.single', $data);
    }

    public function author($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $data = [
            'articles' => Article::where(['user_id' => $id, 'status' => 'Publish'])->orderBy('created_at', 'desc')->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
            'author' => User::find($id),
        ];

        return view('frontend.blog.author', $data);
    }

    public function date($date)
    {
        $data = [
            'date' => $date,
            'articles' => Article::whereDate('created_at', $date)->where('status', 'Publish')->orderBy('created_at', 'desc')->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        return view('frontend.blog.date', $data);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $data = [
            'category' => $category,
            'articles' => $category->article()->where('status', 'Publish')->orderBy('created_at', 'desc')->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        return view('frontend.blog.category', $data);
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        $data = [
            'tag' => $tag,
            'articles' => Article::withAnyTag([$slug])->where('status', 'Publish')->orderBy('created_at', 'desc')->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        return view('frontend.blog.tag', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('keyword');

        $data = [
            'search' => $search,
            'articles' => Article::where('status', 'Publish')
                                ->where(function($query) use ($search) {
                                    $query->where('title', 'LIKE', "%$search%")
                                        ->orWhere('content', 'LIKE', "%$search%")
                                        ->orWhere('created_at', 'LIKE', "%$search%");
                                })
                                ->where(function ($query) use ($search) {
                                    $query->whereHas('category', function ($query) use ($search) {
                                        $query->where('title', 'LIKE', "%$search%")
                                            ->orWhere('slug', 'LIKE', "%$search%");
                                    })
                                    ->orWhereHas('tagged', function ($query) use ($search) {
                                        $query->where('tag_name', 'LIKE', "%$search%")
                                            ->orWhere('slug', 'LIKE', "%$search%");
                                    });
                                })
                                ->paginate(5),
            'categories' => Category::all(),
            'recentPosts' => Article::where('status', 'Publish')->latest()->take(3)->get(),
            'popularPosts' => Article::where('status', 'Publish')->orderBy('viewers', 'desc')->take(3)->get(),
            'tags' => Tag::select('name', 'slug')->distinct()->get(),
        ];

        return view('frontend.blog.search', $data);
    }

}

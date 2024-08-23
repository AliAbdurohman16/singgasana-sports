<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

        return view('backend.article.index', compact('articles'));
    }

    public function show($id)
    {
        $articles = Article::find($id);

        return view('backend.article.detail', compact('articles'));
    }

    public function edit($id)
    {
        $articles = Article::find($id);
        $categories = Category::all();

        return view('backend.article.edit', compact('articles', 'categories'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $articles = Article::find($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/article/' . $articles->image);
            $imagePath = $request->file('image')->store('public/article');
            $imageName = basename($imagePath);
        } else {
            $imageName = $articles->image;
        }

        $articles->update([
            'image' => $imageName,
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);

        $tags = explode(',', $request->tags);
        $articles->retag($tags);

        return redirect('article')->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $articles = Article::find($id);
        if ($articles->image) {
            Storage::delete('public/article/' . $articles->image);
        }

        $articles->untag();
        $articles->delete();
        return response()->json(['status' => 'Data berhasil dihapus!']);
    }
}

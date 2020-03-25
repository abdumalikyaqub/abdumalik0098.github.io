<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function destroy(Article $article)
    {
        if (!Auth::user() || !$article->isAuthor(Auth::user())) {
            return abort('404');
        }

        if ($article->delete()) {
            return redirect()->route('home')->with('status', __('articles.delete_success'));
        }

        return back()->withInput()->with([
            'status' => __('articles.warning')
        ]);
    }

    public function erase(Request $request, $article_id)
    {
        if (!Auth::user()) {
            return abort('404');
        }

        $article_for_delete = Article::withTrashed()->find($article_id);
        $article_for_delete->users()->detach();

        if ($article_for_delete->forceDelete()) {
            return redirect()->route('home')->with('status', __('articles.delete_end_success'));
        }

        return back()->withInput()->with('status', __('articles.warning'));
    }

    public function restore(Request $request, $article_id)
    {
        if (!Auth::user()) {
            return abort('404');
        }

        $article_for_restore = Article::withTrashed()->find($article_id);

        if ($article_for_restore->restore()) {
            return redirect()->route('home')->with('status', __('articles.restore_success'));
        }

        return back()->withInput()->with('status', __('articles.warning'));
    }
}

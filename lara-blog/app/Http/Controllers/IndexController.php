<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function trash()
    {
        $this->title = __('articles.title_trash');

        $title = $this->title;
        $articles =  Auth::user()->getArticlesTrash();
        $auth_user = Auth::user();

        $this->content = view('trash', compact('title', 'articles', 'auth_user'))->render();

        return $this->renderOutput();
    }
}

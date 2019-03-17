<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;


class ArticleComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $page_title = 'Articles';
        $view->with('page_title', $page_title);
    }
}
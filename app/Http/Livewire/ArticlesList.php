<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticlesList extends Component
{
    public $limitPerPage = 24, $searchExpression = "";

    protected $listeners = [
        'load-more' => 'loadMore',
        'search' => 'search'
    ];

    public function loadMore()
    {
        if ($this->limitPerPage < Article::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function search($searchExpression)
    {
        $this->searchExpression = $searchExpression;
    }

    public function render()
    {
        $articles = Article::select("id", "preview_photo_path", "category", "title", "short_description", "publisher_id", "time_to_read", "updated_at");
        if ($this->searchExpression === "") {
            $articles = $articles->latest()->paginate($this->limitPerPage);
        }
        else {
            $articles = $articles
                ->where('category', 'like', '%' . $this->searchExpression . '%')
                ->orWhere('title', 'like', '%' . $this->searchExpression . '%')
                ->orWhere('short_description', 'like', '%' . $this->searchExpression . '%')
                ->orWhere('time_to_read', 'like', '%' . $this->searchExpression . '%')
                ->orWhere('html', 'like', '%' . $this->searchExpression . '%')
                ->orWhere(function ($query) {
                    $query->select('name')->from('users')->whereColumn('users.id', 'articles.publisher_id');
                }, 'like', '%' . $this->searchExpression . '%')->latest()->paginate($this->limitPerPage);
        }
        $this->emit('userStore');
        return view('livewire.articles-list', ['searchExpression' => $this->searchExpression, 'articles' => $articles]);
    }
}

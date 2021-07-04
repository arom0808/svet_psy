<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class QuotesCategoriesList extends Component
{
    public $limitPerPage;

    function mount()
    {
        $this->limitPerPage = 24;
    }

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        if($this->limitPerPage<Category::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function render()
    {
        $categories = Category::orderBy('name')->paginate($this->limitPerPage);
        $this->emit('userStore');
        return view('livewire.quotes-categories-list', ['categories' => $categories]);
    }
}

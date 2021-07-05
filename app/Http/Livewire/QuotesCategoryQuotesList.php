<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesCategoryQuotesList extends Component
{
    public $categoryId;
    public $limitPerPage = 24;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        if($this->limitPerPage<Quote::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function render()
    {
        $quotes = Quote::where('category_id', $this->categoryId)->latest()->paginate($this->limitPerPage);
        $this->emit('userStore');
        return view('livewire.quotes-category-quotes-list', ['quotes' => $quotes]);
    }
}

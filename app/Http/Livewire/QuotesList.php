<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesList extends Component
{
    public $limitPerPage;
    public $searchExpression;

    function mount()
    {
        $this->limitPerPage = 24;
        $this->searchExpression = "";
    }

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        if($this->limitPerPage<Quote::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function search($searchExpression){
        $this->searchExpression = $searchExpression;
    }

    public function render()
    {
        if($this->searchExpression == ""){
            $quotes = Quote::latest()->paginate($this->limitPerPage);
        }
        else{
            $quotes = Quote::where('text', 'like', '%'.$this->searchExpression.'%')
                ->orWhere('category', 'like', '%'.$this->searchExpression.'%')
                ->orWhere('author', 'like', '%'.$this->searchExpression.'%')
                ->orWhere(function ($query) {
                    $query->select('name')
                        ->from('users')
                        ->whereColumn('users.id', 'quotes.publisher_id');
                }, 'like', '%'.$this->searchExpression.'%')
                ->latest()->paginate($this->limitPerPage);
        }
        $this->emit('userStore');
        return view('livewire.quotes-list', ['quotes' => $quotes]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesList extends Component
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
        if($this->limitPerPage<Quote::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function render()
    {
        $quotes = Quote::latest()->paginate($this->limitPerPage);
        $this->emit('userStore');
        return view('livewire.quotes-list', ['quotes' => $quotes]);
    }
}

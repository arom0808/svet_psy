<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesList extends Component
{
    public $amound = 10;

    public function load() {
        $this->amound += 10;
    }

    public function render()
    {
        $quotes = Quote::take($this->amound)->get();
        return view('livewire.quotes-list', compact('quotes'));
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class QuotesList extends Component
{
    public $limitPerPage = 9;
    public $selected = [];

    protected $listeners = [
        'load-more' => 'loadMore',
        'selectCategory'
    ];

    public function loadMore()
    {
        $this->limitPerPage += 6;
    }

    public function selectCategory($id){
        if(array_key_exists($id,$this->selected)) {
            unset($this->selected[$id]);
        }
        else{
            $this->selected[$id] = $id;
        }
    }

    public function render()
    {
        Log::debug($this->selected);
        if(empty($this->selected)) {
            $quotes = Quote::latest()->paginate($this->limitPerPage);
        }
        else{
            $selected_keys = array_keys($this->selected);
            $quotes = Quote::where('category_id','=',$selected_keys[0]);
            for($i = 1; $i < count($selected_keys); ++$i) {
                $quotes = $quotes->orWhere('category_id','=',$selected_keys[$i]);
            }
            $quotes = $quotes->latest()->paginate($this->limitPerPage);
        }
        $this->emit('userStore');

        return view('livewire.quotes-list', ['quotes' => $quotes]);
    }
}

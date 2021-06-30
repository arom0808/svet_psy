<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesList extends Component
{
    public $limitPerPage = 9;
    public $selected = [];

    protected $listeners = [
        'load-more' => 'loadMore',
        'select-category' => 'selectCategory'
    ];

    public function loadMore()
    {
        if($this->limitPerPage<Quote::count()) {
            $this->limitPerPage += 6;
        }
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
        if(empty($this->selected)) {
            $quotes = Quote::latest()->paginate($this->limitPerPage);
        }
        else{
            $selected_keys = array_keys($this->selected);
            if($selected_keys[0]==-1){
                $quotes = Quote::where('category_id','=',null);
            }
            else{
                $quotes = Quote::where('category_id','=',$selected_keys[0]);
            }
            for($i = 1; $i < count($selected_keys); ++$i) {
                if($selected_keys[$i]==-1){
                    $quotes = $quotes->orWhere('category_id','=',null);
                }
                else{
                    $quotes = $quotes->orWhere('category_id','=',$selected_keys[$i]);
                }
            }
            $quotes = $quotes->latest()->paginate($this->limitPerPage);
        }
        $this->emit('userStore');

        return view('livewire.quotes-list', ['quotes' => $quotes]);
    }
}

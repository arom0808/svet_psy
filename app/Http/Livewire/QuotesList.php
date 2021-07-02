<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quote;

class QuotesList extends Component
{
    public $limitPerPage;
    public $selectedCategories;

    function mount()
    {
        $this->limitPerPage = 12;
        $this->selectedCategories = [];
    }

    protected $listeners = [
        'load-more' => 'loadMore',
        'select-category' => 'selectCategory'
    ];

    public function loadMore()
    {
        if($this->limitPerPage<Quote::count()) {
            $this->limitPerPage += 12;
        }
    }

    public function selectCategory($id){
        if(array_key_exists($id,$this->selectedCategories)) {
            unset($this->selectedCategories[$id]);
        }
        else{
            $this->selectedCategories[$id] = $id;
        }
    }

    public function render()
    {
        if(empty($this->selectedCategories)) {
            $quotes = Quote::latest()->paginate($this->limitPerPage);
        }
        else{
            $selectedCategories_keys = array_keys($this->selectedCategories);
            if($selectedCategories_keys[0]==-1){
                $quotes = Quote::where('category_id','=',null);
            }
            else{
                $quotes = Quote::where('category_id','=',$selectedCategories_keys[0]);
            }
            for($i = 1; $i < count($selectedCategories_keys); ++$i) {
                if($selectedCategories_keys[$i]==-1){
                    $quotes = $quotes->orWhere('category_id','=',null);
                }
                else{
                    $quotes = $quotes->orWhere('category_id','=',$selectedCategories_keys[$i]);
                }
            }
            $quotes = $quotes->latest()->paginate($this->limitPerPage);
        }
        $this->emit('userStore');

        return view('livewire.quotes-list', ['quotes' => $quotes]);
    }
}

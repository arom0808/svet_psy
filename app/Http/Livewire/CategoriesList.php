<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoriesList extends Component
{
    public $selected = [];

    protected $listeners = ['selectCategory' => 'select'];

    public function select($id){
        if(array_key_exists($id,$this->selected)) {
            unset($this->selected[$id]);
        }
        else{
            $this->selected[$id] = $id;
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.categories-list', ['categories' => $categories, 'selected' => $this->selected]);
    }
}

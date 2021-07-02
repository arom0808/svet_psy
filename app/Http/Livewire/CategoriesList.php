<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoriesList extends Component
{
    public function render()
    {
        $allCategories = Category::orderBy('name')->select('name', 'id')->get()->toArray();
        array_unshift($allCategories, ["name"=>"Без категории", "id"=>-1]);
        return view('livewire.categories-list', ['allCategories' => $allCategories]);
    }
}

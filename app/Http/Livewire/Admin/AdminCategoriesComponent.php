<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

use function Pest\Laravel\delete;

class AdminCategoriesComponent extends Component
{
    public $category_id;
    use WithPagination;
    public function deleteCategory(){
        $category = Category::find($this->category_id);
        $category->delete();
        session()->flash('message','category has been delete successfully');
    }
    public function render()
    {
        $categories=Category::class::orderBy('name','ASC')->paginate(5);
        return view('livewire.admin.admin-categories-component',['categories'=>$categories]);
    }
}

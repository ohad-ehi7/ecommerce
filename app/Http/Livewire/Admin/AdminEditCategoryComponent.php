<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $slug;
    public $name;
    public $category_id;
    public function mount($category_id){
        $category = Category::find($category_id);
        $this->category_id = $category_id;
        $this->name = $category->name;
        $this->slug = $category->slug;

    }
    public Function generateSlug(){
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
        'name'=> 'required',
        'slug' => 'required'
        ]);
    }
    public function updateCategory(){
        $this->validate([
            'name'=> 'required',
            'slug' => 'required'  
        ]);
        $category = Category::find($this->category_id);
        $category->name =$this->name;
        $category->slug =$this->slug;
        $category->save();
        session()->flash('message','Category has been UPDATED succcessfully');


    }
    public function render()
    {
        return view('livewire.admin.admin-edit-category-component');
    }
}

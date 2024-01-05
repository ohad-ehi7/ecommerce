<?php

namespace App\Http\Livewire\Admin;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    public $product;
    public $product_id;
    use WithPagination;

    public function deleteProduct(){
        $product = Product::find($this->product_id);
        unlink('assets/imgs/products/'.$product->image);
        $product->delete();
        session()->flash('message','product has been delete successfully');
    }
    public function loadProductDetails($product_id)
{
    $this->product = Product::find($product_id);
    $this->emit('showProductDetailsModal');
}

    public function render()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products]);
    }
}

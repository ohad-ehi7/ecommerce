<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{ 
    public $slide_id;
    public $slide;

    public function deleteSlide(){
        $slide = HomeSlider::find($this->slide_id);
        unlink('assets/imgs/slider/'.$slide->image);
        $slide->delete();
        session()->flash('message','slide has been delete successfully');
    }
    public function render()
    {
        $slides = HomeSlider::orderBy('created_at','DESC')->get();
        return view('livewire.admin.admin-home-slider-component',['slides'=>$slides]);
    }
}

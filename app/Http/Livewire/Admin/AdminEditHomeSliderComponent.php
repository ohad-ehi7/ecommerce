<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;


class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status;
    public $image;
    public $slide_id;
    public $new_image;


    public function mount($slide_id){
        $slide = HomeSlider::find($slide_id);
        $this->slide_id = $slide->slide_id;
        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->offer = $slide->offer;
        $this->link = $slide->link;
        $this->status = $slide->status;
        $this->image = $slide->image;


    }
    public  function updateSlide(){
        
        $this->validate([
         'top_title'=>'required',
         'title'=>'required',
         'sub_title'=>'required',
         'offer'=>'required',
         'link'=>'required',
         'status'=>'required',
         'image'=>'image'
        ]);

        $slide = HomeSlider::find($this->slide_id);
        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        $slide->status = $this->status;
        if ($this->new_image) {
            unlink(public_path('assets/imgs/slider/' . $slide->image));
            $imageName = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('', $imageName);
            $slide->image = $imageName;
        }

        $slide->slide_id = $this->slide_id;
        $slide->save();
        session()->flash('message', 'slide has been updated!');
    }



    
    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Product as ModelsProduct;
use Livewire\Component;

class Product extends Component
{
    // use WithPagination;
    // public function fixImage(ModelsProduct $pd){
    //     if(Storage::disk('public')->exists($pd->image)){
    //         $pd->image=Storage::url($pd->image);
    //     }else{
    //         $pd->image='/image/auto.jpg';
    //     }
    // }
    public $search='';
    public $contacts;

    // public function mount()
    // {
    //     $this->search='';
    //     $this->contacts=[];
    // }

    // public function searchh()
    // {
        
    // }
    public function render()
    {
        if (empty($this->search)) {
            $this->contacts = ModelsProduct::where('name', $this->search)->get();
        } else {
            $this->contacts =ModelsProduct::where('name', 'like', '%'.$this->search.'%')->get();
        }
        // $this->contacts= ModelsProduct::where('name','like','%'.$this->search.'%')->get()->toArray();
        return view('livewire.product');
    }
}

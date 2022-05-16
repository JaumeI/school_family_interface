<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MoveData extends Component
{
    public $name;
    public $originTitle;
    public $destinationTitle;
    public $origins;
    public $destinations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $originTitle, $destinationTitle, $origins, $destinations)
    {
        $this->name = $name;
        $this->originTitle = $originTitle;
        $this->destinationTitle = $destinationTitle;
        $this->origins = $origins;
        $this->destinations = $destinations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.move-data');
    }
}

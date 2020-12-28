<?php

namespace App\View\Components\Libs;

use Illuminate\View\Component;

class Form extends Component
{
    public $theme_id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($theme_id)
    {
            $this->theme_id = $theme_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form');
    }
}

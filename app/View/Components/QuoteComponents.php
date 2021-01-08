<?php

namespace App\View\Components;

use App\Models\Masseg;
use Illuminate\View\Component;

class QuoteComponents extends Component
{
    public $listMessages;
    public $massegId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listMessages, $massegId)
    {
        $this->listMessages = $listMessages;
        $this->massegId = $massegId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        return view('components.quote-components');
    }
}

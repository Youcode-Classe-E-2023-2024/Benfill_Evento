<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ticket extends Component
{
    public $qr;
    public $ticket;
    public $event;

    /**
     * Create a new component instance.
     */
    public function __construct($qr, $event, $ticket)
    {
        $this->qr = $qr;
        $this->ticket = $ticket;
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ticket');
    }
}

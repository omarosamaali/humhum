<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckGroup extends Component
{
    public $items;
    public $name;

    public function __construct($items = [], $name = 'options')
    {
        $this->items = $items;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.check-group');
    }
}

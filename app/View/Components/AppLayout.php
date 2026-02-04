<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Obtenir la vue / le contenu qui repr?sente le composant.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}

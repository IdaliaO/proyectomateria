<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('components.navbar'); // Asegúrate de que exista `resources/views/components/navbar.blade.php`
    }
}

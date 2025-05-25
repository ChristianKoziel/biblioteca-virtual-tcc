<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MobileMenu extends Component
{
    public $isHidden;
    public $menuItems;
    
    public function __construct($isHidden = true)
    {
        $this->isHidden = $isHidden;
        $this->menuItems = [
            ['label' => '📚 Categorias', 'href' => '#'],
            ['label' => '✍️ Autores', 'href' => '#'],
            ['label' => '🔥 Mais lidos', 'href' => '#'],
        ];
    }
    
    public function render()
    {
        return view('components.mobile-menu');
    }
}
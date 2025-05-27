<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategorySelect extends Component
{
    public $selected;
    public $categories;
    
    public function __construct($selected = null)
    {
        $this->selected = $selected;
        $this->categories = $this->getCategories();
    }
    
    protected function getCategories()
    {
        return [
            'Administração, Negócios e Economia',
            'Arte, Cinema e Fotografia',
            'Artesanato, Casa e Estilo de Vida',
            'Autoajuda',
            'Biografias e Histórias Reais',
            'Ciências',
            'Computação, Informática e Mídias Digitais',
            'Crônicas, Humor e Entretenimento',
            'Direito',
            'Educação, Referência e Didáticos',
            'Engenharia e Transporte',
            'Erótico',
            'Esportes e Lazer',
            'Fantasia, Horror e Ficção Científica',
            'Gastronomia e Culinária',
            'História',
            'HQs, Mangás e Graphic Novels',
            'Infantil',
            'Literatura e Ficção',
            'Medicina',
            'Policial, Suspense e Mistério',
            'Política, Filosofia e Ciências Sociais',
            'Religião e Espiritualidade',
            'Romance',
            'Saúde e Família',
            'Turismo e Guias de Viagem',
            'Inglês e Outras Línguas',
            'Jovens e Adolescentes'
        ];
    }
    
    public function render()
    {
        return view('components.category-select');
    }
}
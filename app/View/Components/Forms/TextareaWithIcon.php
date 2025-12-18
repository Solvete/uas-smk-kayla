<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaWithIcon extends Component
{
    public string $label;
    public string $name;
    public string $placeholder;
    public ?string $icon;
    public int $rows;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label,
        string $name,
        string $placeholder = '',   // ✅ OPTIONAL
        ?string $icon = null,        // ✅ OPTIONAL
        int $rows = 3                // ✅ DEFAULT
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.textarea-with-icon');
    }
}

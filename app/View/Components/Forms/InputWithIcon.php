<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputWithIcon extends Component
{
    public string $label;
    public string $name;
    public string $type;
    public string $placeholder;
    public ?string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label,
        string $name,
        string $type = 'text',
        string $placeholder = '', // ✅ JADI OPTIONAL (INI KUNCI)
        ?string $icon = null      // ✅ OPTIONAL
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-with-icon');
    }
}

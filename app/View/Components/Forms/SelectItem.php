<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SelectItem extends Component
{
    /**
     * The option value.
     *
     * @var string
     */
    public $value;

    /**
     * The option label.
     *
     * @var string
     */
    public $label;

    /**
     * The option colorCode.
     *
     * @var string
     */
    public $colorCode;

    /**
     * The selected option.
     *
     * @var string
     */
    public $selected;


    /**
     * Create a new component instance.
     *
     * @param $value
     * @param $label
     * @param null $colorCode
     * @param null $selected
     */
    public function __construct($value, $label, $colorCode = null, $selected = null)
    {
        $this->value = $value;
        $this->label = $label;
        $this->colorCode = $colorCode;
        $this->selected = $selected;
    }

    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($option)
    {
        return $option === $this->selected;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select-item');
    }
}

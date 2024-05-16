<?php

namespace MshMsh\Components;

use Illuminate\View\Component;

class Input extends Component
{
    use Attributes;


    public $name;
    public $model;
    public $input;
    public $lang;
    public $value;
    public $required;
    public $mytitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $model, $input, $lang)
    {
        $this->name = $name;
        $this->model = $model;
        $this->input = $input;
        $this->lang = $lang;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if ($this->name == 'images[]') {
            $component = 'images';
            $this->mytitle = __("Images");
        } else {
            $this->mytitle = $this->inputTitle();

            $component = $this->input['type'] ?? 'input';

            $this->required = $this->isRequired($component);
            if (isset($this->input['setting'])) {
                $this->settingInputValue();
            } else {
                $this->inputValue();
            }
        }
        try {
            return view('Common::components.' . $component);
        } catch (\Throwable $th) {
            return view('Common::components.input');
        }
    }
}

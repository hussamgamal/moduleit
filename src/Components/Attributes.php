<?php

namespace MshMsh\Components;

trait Attributes
{
    public function inputTitle()
    {
        $this->mytitle = app()->getLocale() == 'ar' ? $this->input['title'] : ucfirst(str_replace('[]', '', $this->name));
    }

    public function isRequired($component)
    {
        return (isset($this->input['empty'])) || ($this->model->id && in_array($component, ['image', 'password'])) ? '' : 'required';
    }

    public function settingInputValue()
    {
        $this->required = '';
        $this->value = $this->input['value'] ?? $this->model->where('key', $this->name)->first()->value ?? '';
        if (is_object($this->value)) {
            $this->value = $this->value->{$this->lang} ?? '';
        }
        if (!isset($this->input['multiple'])) {
            $this->name =  "{$this->name}[{$this->lang}]";
        } else {
            $this->value = $this->model->where('key', str_replace("[]", "", $this->name))->first()->value ?? [];
        }
    }

    public function inputValue()
    {
        $name = str_replace("[]", "", $this->name);
        if (strpos($name, "[") !== false) {
            $all = explode("[", $name);
            $name = $all[0];
            $object = str_replace("]", "", $all[1]);
            $this->value = $this->input['value'] ?? $this->model->$name["$object"] ?? $this->model->$name->$object ?? null;
        } else {
            $this->value = $this->input['value'] ?? $this->model->{$name} ?? '';
        }
        if ($this->lang != 'all') {
            if (is_array($this->value)) {
                $this->value = $this->input['value'] ?? $this->value[$this->lang] ?? '';
            } elseif (is_object($this->value)) {
                $this->value = $this->input['value'] ?? $this->value->{$this->lang} ?? '';
            }
            $this->name =  "{$this->name}[{$this->lang}]";
        }
    }
}

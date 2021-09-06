<?php

namespace app\core\form;

class SummernoteField extends BaseField{
    public function renderInput(): string {
        return sprintf('<textarea id="summernote" name="%s">%s</textarea>',
        $this->attribute,
        $this->model->{$this->attribute}
    );
    }
}
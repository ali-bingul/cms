<?php

namespace app\core\form;

class ImageField extends BaseField{
    public function renderInput(): string {
        return sprintf('<input type="file" name="%s">',
        $this->attribute
    );
    }
}
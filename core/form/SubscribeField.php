<?php


namespace app\core\form;

class SubscribeField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<input type="email" value="" style="color: white;" name="%s" class="email" id="mc-email" placeholder="Email Address" required="">',
            $this->attribute
        );
    }
}

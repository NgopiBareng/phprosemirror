<?php

namespace NgopiBareng\Phprosemirror;

class Phprosemirror {

    public function document($value) {
        if (is_string($value)) {
            $value = json_decode($value);
        } elseif (is_array($value)) {
            $value = json_decode(json_encode($value));
        }

        $this->document = $value;

        return $this;
    }

    public function toHTML($json) {
        $this->document($json);
    }
}

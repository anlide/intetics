<?php

namespace Model;

class Textarea {
    private string $value = '';

    public function setValue(string $value): void {
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function insertToDatabase(): int {
        // TODO: Move database processing to some other place
        \database::sql('INSERT INTO `textarea` (`data`) VALUES ("'.str_replace('"', '\"', $this->value).'");');

        return \database::lastInsertId();
    }
}
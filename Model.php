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
        // TODO: Implement it and return autoincrement value
        return 0;
    }
}
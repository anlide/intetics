<?php

namespace Sender;

class Email implements ISender {
    public function send(string $data): void
    {
        // TODO: Implement send() method.
    }

    public function getType(): string
    {
        return 'email';
    }
}
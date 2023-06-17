<?php

namespace Sender;

class SMS implements ISender {
    public function send(string $data): void
    {
        // TODO: Implement send() method.
    }

    public function getType(): string
    {
        return 'sms';
    }
}
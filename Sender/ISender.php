<?php

namespace Sender;

interface ISender {
    public function send(string $data): void;

    public function getType(): string;
}
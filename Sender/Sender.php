<?php

namespace Sender;

abstract class Sender {
    public const SENDER_TYPE_EMAIL = 'email';
    public const SENDER_TYPE_SMS = 'sms';
    public static function getSender($type): ISender {
        switch ($type) {
            case self::SENDER_TYPE_EMAIL:
                $sender = new Email();
                break;
            case self::SENDER_TYPE_SMS:
                $sender = new SMS();
                break;
            default:
                throw new \Exception('Unknown type sender requested');
        }
        return $sender;
    }
}
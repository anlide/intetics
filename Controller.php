<?php

namespace Controller;

use Sender\Sender;

class Textarea {
    private const PLACEHOLDER = 'Enter any text';
    private const STRING_LIMIT = 64000;

    /**
     * @var \Model\Textarea|null
     */
    private ?\Model\Textarea $textarea = null;

    /**
     * TODO: It should be at some general code, not at controller
     * @return string
     */
    private function getCsrf(): string {
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = sha1(rand(0, PHP_INT_MAX));
        }
        return $_SESSION['csrf'];
    }

    /**
     * Provide data for render page with textarea
     * @return array
     */
    public function index (): array {
        // TODO: Use model here for 'value'
        $this->textarea = new \Model\Textarea();
        return [
            'placeholder' => self::PLACEHOLDER,
            'value' => $this->textarea->getValue(),
            'error' => '',
            'csrf' => $this->getCsrf(),
        ];
    }

    /**
     * Provide data for render page with submitted textarea
     * @return string[]
     */
    public function submit (): array {
        // TODO: Implement save data to DB and return error or success message
        // TODO: Use model here for 'value'
        $this->textarea = new \Model\Textarea();
        // TODO: escape input data
        $data = $_POST['textarea'];
        try {
            $this->textarea->setValue($data);
            if ($_POST['csrf'] !== $this->getCsrf()) {
                throw new \Exception('CSRF token wrong, try again');
            }
            if (strlen($data) > self::STRING_LIMIT) {
                throw new \Exception('String length should be less then '.self::STRING_LIMIT.' symbols');
            }
            $autoIncrementValue = $this->textarea->insertToDatabase();
            $errorText = 'Inserted: '.$autoIncrementValue;
            try {
                $senderType = (rand(0, 100) > 50) ? Sender::SENDER_TYPE_EMAIL : Sender::SENDER_TYPE_SMS;
                $sender = Sender::getSender($senderType);
                $sender->send($data);
                $errorText .= ' | Sent via '.$sender->getType();
            } catch (\Exception $exception) {
                $errorText .= ' | Not sent: '.$exception->getMessage();
            }
        } catch (\Exception $exception) {
            $errorText = 'Not saved: '.$exception->getMessage();
        }
        return [
            'placeholder' => self::PLACEHOLDER,
            'value' => $this->textarea->getValue(),
            'error' => $errorText,
            'csrf' => $this->getCsrf(),
        ];
    }
}
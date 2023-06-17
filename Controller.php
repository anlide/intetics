<?php

namespace Controller;

class Textarea {
    private const placeholder = 'Enter any text';

    /**
     * @var \Model\Textarea|null
     */
    private ?\Model\Textarea $textarea = null;

    /**
     * Provide data for render page with textarea
     * @return array
     */
    public function index (): array {
        // TODO: Use model here for 'value'
        $this->textarea = new \Model\Textarea();
        return [
            'placeholder' => self::placeholder,
            'value' => $this->textarea->getValue(),
            'error' => '',
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
        $this->textarea->setValue($_POST['textarea']);
        // TODO: Save data
        $errorText = '';
        try {
            $autoIncrementValue = $this->textarea->insertToDatabase();
            $errorText = 'Inserted: '.$autoIncrementValue;
        } catch (\Exception $exception) {
            $errorText = 'Not saved: '.$exception->getMessage();
        }
        return [
            'placeholder' => self::placeholder,
            'value' => $this->textarea->getValue(),
            'error' => $errorText,
        ];
    }
}
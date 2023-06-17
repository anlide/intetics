<?php

namespace Kernel;

use Controller\Textarea;

class Kernel {
    private ?Textarea $selectedController = null;
    private ?string $selectedMethod = null;

    /**
     * @var string rendered content
     */
    private string $render = '';

    /**
     * Select controller to process
     * @return void
     */
    function route(): void
    {
        // Here should be selected controller+method based on input data
        $this->selectedController = new Textarea();
        if ($_SERVER['REQUEST_METHOD'] == strtoupper('get')) {
            $this->selectedMethod = 'index';
        } elseif ($_SERVER['REQUEST_METHOD'] == strtoupper('post')) {
            $this->selectedMethod = 'submit';
        } else {
            throw new \Exception('Unknown route');
    }
        // Execute selected controller+method
        $data = $this->selectedController->{$this->selectedMethod}();
        // Render data to related view (one view in this project)
        if ($data) {
            // Extract data from controller to local scope to access to the data from phtml file
            extract($data);
        }
        ob_start();
        // Render phtml file with variables
        include ('view.phtml');
        $this->render = ob_get_contents();
        ob_end_clean();
        // TODO: exception handler
    }
    /**
     * Return
     * @return string
     */
    function __toString ()
    {
        return $this->render;
    }
}
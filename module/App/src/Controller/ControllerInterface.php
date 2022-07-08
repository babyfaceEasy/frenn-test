<?php

namespace App\Controller;

interface ControllerInterface 
{
    /**
     * @param array $vars
     * @param string $template
     * @param bool $userLayout
     */
    public function render(array $vars, string $template, $useLayout = true): void;
}
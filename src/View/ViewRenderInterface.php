<?php

namespace Fin\View;

use Psr\Http\Message\ResponseInterface;

interface ViewRenderInterface
{
    public function render(string $template, array $context = []) : ResponseInterface;
}
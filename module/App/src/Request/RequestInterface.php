<?php

namespace App\Request;

interface RequestInterface
{
    public function has(string $key): bool;
    public function get(string $key);
    public function post(string $key);
    public function input(string $key);
    public function all(): array;
}
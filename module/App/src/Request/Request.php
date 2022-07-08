<?php

namespace App\Request;

class Request implements RequestInterface
{
    private $post;

    private $get;

    private $data;

    public function __construct(array $get = [], array $post = [])
    {
        $this->get = $this->cleanInput($get);
        $this->post = $this->cleanInput($post);

        $this->data = [...$this->get, ...$this->post];
    }

    private function cleanInput(array $input): array
    {
        foreach($input as $key => $val) {
            if ($key === 'purpose') {
                $input[$key] = trim($val);
                continue;
            }
            $input[$key] = preg_replace("#[[:punct:]]#", "", trim($val));
        }

        return $input;
    }

    public function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function get(string $key, $default = null)
    {
        if (!array_key_exists($key, $this->get)) return $default;

        return $this->get[$key];
    }

    public function post(string $key, $default = null)
    {
        if (!array_key_exists($key, $this->post)) return $default;

        return $this->post[$key];
    }

    public function input(string $key, $default = null)
    {
        if (!array_key_exists($key, $this->data)) return $default;
        return $this->data[$key];
    }

    public function all(): array
    {
        return $this->data;
    }
}
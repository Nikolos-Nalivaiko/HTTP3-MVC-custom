<?php

namespace Core;

class Request
{
    protected $queryParams;
    protected $bodyParams;
    protected $fileParams;
    protected $method;
    protected $uri;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->queryParams = $_GET;
        $this->fileParams = $this->normalizeFiles($_FILES);

        if($this->isJson())
        {
            $this->bodyParams = json_decode(file_get_contents('php://input'), true) ?? [];
        } else {
            $this->bodyParams = $_POST;
        }
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }
    
    public function set($key, $value)
    {
        $this->bodyParams[$key] = $value;
    }

    public function getQueryParam($key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    public function getBodyParam($key, $default = null)
    {
        return $this->bodyParams[$key] ?? $default;
    }

    public function all()
    {
        return array_merge($this->queryParams, $this->bodyParams, $this->fileParams);
    }

    public function hasFile($key)
    {
        return isset($this->fileParams[$key]) && !empty($this->fileParams[$key]);
    }

    public function files($key = null)
    {
        if ($key === null) {
            return $this->fileParams;
        }

        return $this->fileParams[$key] ?? null;
    }

    protected function isJson()
    {
        return isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false;
    }

    private function normalizeFiles(array $files)
    {
        $result = [];
        foreach ($files as $key => $file) {
            if (is_array($file['name'])) {
                foreach ($file['name'] as $index => $name) {
                    $result[$key][$index] = [
                        'name' => $file['name'][$index],
                        'type' => $file['type'][$index],
                        'tmp_name' => $file['tmp_name'][$index],
                        'error' => $file['error'][$index],
                        'size' => $file['size'][$index],
                    ];
                }
            } else {
                $result[$key] = $file;
            }
        }
        return $result;
    }
}
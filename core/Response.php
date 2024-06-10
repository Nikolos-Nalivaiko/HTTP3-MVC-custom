<?php

namespace Core;

class Response
{
    protected $headers = [];
    protected $statusCode = 200;
    protected $body;

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setContent($content)
    {
        $this->body = $content;
    }

    public function getContent()
    {
        return $this->body;
    }

    public function setJsonContent($data)
    {
        $this->setHeader('Content-Type', 'application/json');
        $this->setContent(json_encode($data));
    }
}

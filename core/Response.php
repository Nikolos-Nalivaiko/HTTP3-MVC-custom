<?php

declare(strict_types=1);

namespace Core;

class Response
{
    protected array $headers = [];
    protected int $statusCode = 200;
    protected string $body = '';

    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setContent(string $content): void
    {
        $this->body = $content;
    }

    public function getContent(): string
    {
        return $this->body;
    }

    public function setJsonContent(array $data): void
    {
        $this->setHeader('Content-Type', 'application/json');
        $this->setContent(json_encode($data));
    }
}

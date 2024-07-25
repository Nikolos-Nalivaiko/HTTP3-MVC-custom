<?php

declare(strict_types=1);

namespace Core;

class Response
{
    private $headers = [];
    private $statusCode = 200;
    private $body = '';

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setContent(string $content): self
    {
        $this->body = $content;
        return $this;
    }

    public function getContent(): string
    {
        return $this->body;
    }

    public function setJsonContent(array $data): self
    {
        $this->setHeader('Content-Type', 'application/json');
        $json = json_encode($data);

        if ($json === false) {
            throw new \RuntimeException('JSON encoding error: ' . json_last_error_msg());
        }

        $this->setContent($json);
        return $this;
    }
}

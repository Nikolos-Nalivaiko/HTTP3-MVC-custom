<?php

declare(strict_types=1);

namespace Core;

class View 
{
    protected static array $config;
    protected static string $layout = 'main';
    protected string $view;
    protected array $data;

    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public static function init(array $config): void
    {
        self::$config = $config;
    }

    public static function render(string $view, array $data = []): void
    {
        $viewsPath = self::$config['views_path'];

        extract($data);

        ob_start();
        require $viewsPath . '/' . $view . '.php';
        $content = ob_get_clean();
        
        $layoutPath = self::$config['layouts_path'] . '/' . self::$layout . '.php';
        require $layoutPath;
    }

    public static function setLayout(string $layout): void
    {
        self::$layout = $layout;
    }

    public static function errorCode(int $code): void
    {
        http_response_code($code);
        $errorPath = self::$config['errors_path'];
        require $errorPath . '/' . $code . '.php';
        exit();
    }

    public static function view(string $view, array $data = []): self
    {
        return new self($view, $data);
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getData(): array
    {
        return $this->data;
    }
}

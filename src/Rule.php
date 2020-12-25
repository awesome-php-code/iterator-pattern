<?php

namespace AwesomePhpCode\IteratorPattern;

class Rule
{
    private string $name;
    private int $type;
    private int $position;

    /**
     * @var callable
     */
    protected $condition;

    private bool $enabled = true;

    public function __construct(string $name, int $type, int $position, callable $condition)
    {
        $this->name = $name;
        $this->type = $type;
        $this->position = $position;
        $this->condition = $condition;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function run($value): bool
    {
        return call_user_func($this->condition, $value);
    }
}

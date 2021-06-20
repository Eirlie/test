<?php

declare(strict_types=1);

namespace App\Service\View;

class PaginatedList
{
    /**
     * PaginatedList constructor.
     */
    public function __construct(protected int $count, protected array $items)
    {
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return static
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     *
     * @return static
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
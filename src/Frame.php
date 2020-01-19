<?php

declare(strict_types=1);

namespace jwhulette\pipes;

use Illuminate\Support\Collection;

class Frame
{
    public Collection $header;
    public Collection $data;
    public array $attribute = [];
    public bool $end = false;

    /**
     * Set the frame data.
     *
     * @param array $data
     */
    public function setData(array $data): Frame
    {
        $this->data = collect($data);

        if (isset($this->header) && $this->header->isNotEmpty()) {
            $this->data = $this->header->combine($this->data);
        }

        return $this;
    }

    /**
     * Set the frame header data.
     *
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = collect($header);
    }

    /**
     * Set a frame attribute.
     *
     * @param array $attribute
     */
    public function setAttribute(array $attribute): void
    {
        $this->attribute[key($attribute)] = $attribute[key($attribute)];
    }

    /**
     * Set the frame as the last data element.
     */
    public function setEnd(): void
    {
        $this->end = true;
    }
}

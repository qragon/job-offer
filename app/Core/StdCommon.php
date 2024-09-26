<?php

namespace App\Core;

#[\AllowDynamicProperties]
abstract class StdCommon
{
    protected array $srcData = [];

    public function __construct($data = [])
    {
        $this->srcData = (array)$data;
        $this->fill((array)$data);
    }

    public function __get($name)
    {
        return $this->srcData[$name] ?? null;
    }

    private function fill($attributes): void
    {
        if (count($attributes)) {
            foreach ($attributes as $key => $value) {
                $this->setAttribute($key, $value);
            }
        }
    }

    private function setAttribute($key, $value): static
    {
        $this->{$key} = $value;

        return $this;
    }
}

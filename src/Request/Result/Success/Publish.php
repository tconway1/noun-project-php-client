<?php namespace MattyRad\NounProject\Request\Result\Success;

use MattyRad\Support\Result\Success;

class Publish extends Success
{
    private $published;

    public function __construct(array $res)
    {
        $this->published = $res;
    }

    public function getPublished(): array
    {
        return $this->published;
    }
}

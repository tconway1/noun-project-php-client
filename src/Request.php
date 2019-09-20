<?php namespace MattyRad\NounProject;

use MattyRad\Support;

abstract class Request
{
    abstract public function getUri(): string;

    abstract public function createResult(array $response_data): Support\Result;

    public function getBody() {
        return null;
    }

    public function getHttpType(): string
    {
        return 'GET';
    }
}

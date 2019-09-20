<?php namespace MattyRad\NounProject\Request;

use MattyRad\NounProject;
use MattyRad\Support;

class Publish extends NounProject\Request
{
    private $icons;
    private $test;

    public function __construct(
        string $icons,
        bool $test = false
    ) {
        $this->icons = $icons;
        $this->test = $test;
    }

    public function getUri(): string
    {
        $uri = '/notify/publish';

        if ($this->test) {
            $uri .= "?test=1";
        }

        return $uri;
    }

    public function getBody()
    {
        return [
            "icons" => $this->icons
        ];
    }

    public function getHttpType(): string
    {
        return "POST";
    }

    public function createResult(array $response_data): Support\Result
    {
        if (! array_key_exists('licenses_consumed', $response_data)) {
            return new Result\Failure\UnexpectedResponse('licenses_consumed', $response_data);
        }

        if (! array_key_exists('result', $response_data)) {
            return new Result\Failure\UnexpectedResponse('result', $response_data);
        }

        return new NounProject\Request\Result\Success\Publish($response_data);
    }
}

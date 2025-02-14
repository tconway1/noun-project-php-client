<?php namespace MattyRad\NounProject\Request;

use MattyRad\NounProject;
use MattyRad\Support;

class RecentIcons extends NounProject\Request
{
    private $offset;
    private $page;
    private $limit;

    public function __construct(
        $offset = 0,
        $page = 0,
        $limit = 0
    ) {
        $this->offset = $offset;
        $this->page = $page;
        $this->limit = $limit;
    }

    // FIXME: this could get cleaned up
    public function getUri(): string
    {
        $uri = '/icons/recent_uploads?';

        if ($this->offset) {
            $uri .= 'offset=' . urlencode($this->offset) . '&';
        }

        if ($this->page) {
            $uri .= 'page=' . urlencode($this->page) . '&';
        }

        if ($this->limit) {
            $uri .= 'limit=' . urlencode($this->limit) . '&';
        }

        return trim($uri, '&');
    }

    public function createResult(array $response_data): Support\Result
    {
        if (! array_key_exists('recent_uploads', $response_data)) {
            return new Result\Failure\UnexpectedResponse('recent_uploads', $response_data);
        }

        return new Result\Success\Icons($response_data['recent_uploads']);
    }
}

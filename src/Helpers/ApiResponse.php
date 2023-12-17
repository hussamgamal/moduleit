<?php

namespace MshMsh\Helpers;

class ApiResponse
{
    public function __construct(
        public string $message = '',
        public array|object|null $data = null,
        public bool $status = true,
        public int $status_code = 200
    ) {
        $this->getResponse();
    }

    function getResponse()
    {
        $this->emptyDataForNotAuth();
        $response = Response::get($this->status, $this->message, $this->data);
        
        $this->status_code = 200;
        return response()->json($response, $this->status_code);
    }

    private function emptyDataForNotAuth()
    {
        if ($this->status_code == 422) {
            if ($this->data && count($this->data)) {
                $this->message = $this->data[array_key_first($this->data)];
                $this->data = null;
            }
        }
    }
}

<?php

namespace App\v1\Util\Logger\Formatter;

class JsonFormatter extends \Monolog\Formatter\JsonFormatter
{
    /**
     * @param array $record
     * @return string
     */
    public function format(array $record)
    {

        $data = $record['context'];
        $data['message'] = $record['message'];
        $data['severity'] = $record['level_name'];

        unset(
            $record['level_name'],
            $record['channel'],
            $record['level'],
            $record['datetime'],
            $record['extra']
        );

        return $this->toJson($data) . ($this->appendNewline ? "\n" : '');
    }
}

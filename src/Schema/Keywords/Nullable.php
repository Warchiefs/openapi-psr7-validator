<?php

declare(strict_types=1);

namespace League\OpenAPIValidation\Schema\Keywords;

use League\OpenAPIValidation\Schema\Exception\KeywordMismatch;

class Nullable extends BaseKeyword
{
    /**
     * Allows sending a null value for the defined schema. Default value is false.
     *
     * @param mixed $data
     * @param bool $nullable
     * @param string|array $type
     *
     * @throws KeywordMismatch
     */
    public function validate($data, bool $nullable, $type) : void
    {
        if ($data === null) {
            if (is_array($type) && (array_search('null', $type) || array_search(null, $type))) {
                return;
            }
            if ($type === null || $type === 'null') {
                return;
            }
            if ($nullable) {
                return;
            }
            throw KeywordMismatch::fromKeyword('nullable', $data, 'Value cannot be null');
        }
    }
}

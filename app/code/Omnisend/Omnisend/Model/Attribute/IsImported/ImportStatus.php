<?php

namespace Omnisend\Omnisend\Model\Attribute\IsImported;

use Omnisend\Omnisend\Model\RequestService;

class ImportStatus
{
    const IMPORT_SUCCESSFUL = 1;
    const IMPORT_FAILED = 0;

    /**
     * @param $response
     * @return int
     */
    public function getImportStatus($response)
    {
        if ($response === null || $response == RequestService::HTTP_RESPONSE_NOT_FOUND) {
            return self::IMPORT_FAILED;
        }

        return self::IMPORT_SUCCESSFUL;
    }
}
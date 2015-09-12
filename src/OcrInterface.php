<?php

namespace Jfx\Ocr;

interface OcrInterface
{
    const DEFAULT_TIMEOUT = 600;

    /**
     * Generate the command to execute.
     *
     * @return array()
     */
    public function buildCommandArguments();

    /**
     * Hook to permit to cleanup the resources use f
     * or execute the scan.
     */
    public function cleanup();
}

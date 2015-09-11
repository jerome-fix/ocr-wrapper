<?php

namespace Jfx\Ocr;

interface OcrInterface
{
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

<?php

namespace Zapoyok\Ocr;

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

    /**
     * @param \SplFileInfo $file
     *
     * @return BaseOcr
     */
    public function setFile(\SplFileInfo $file);

    /**
     * @return \SplFileInfo
     */
    public function getFile();

    public function buildCommand();

    public function scan();

    /**
     * @return string
     */
    public function getBinary();

    /**
     * @param string $binary
     *
     * @return BaseOcr
     */
    public function setBinary($binary);

    /**
     * @return int
     */
    public function getTimeout();

    /**
     * @param int $timeout
     *
     * @return BaseOcr
     */
    public function setTimeout($timeout);

    /**
     * @return string
     */
    public function getLanguages();

    /**
     * @param array $languages
     *
     * @return BaseOcr
     */
    public function setLanguages($languages);

    /**
     * @param string $language
     *
     * @return BaseOcr
     */
    public function addLanguage($language);

    /**
     * @param $dir
     *
     * @throws \Zapoyok\Ocr\Exception\DirectoryNotFoundException
     *
     * @return $this
     */
    public function setTmpDir($dir);

    /**
     * Returns the path of a directory to place temporary files if defined,
     * otherwise returns the default temp directory of the operating system.
     *
     * @return string
     */
    public function getTmpDir();
}

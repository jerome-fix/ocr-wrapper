<?php

namespace Zapoyok\Ocr;

use Zapoyok\Ocr\Exception\CommandException;
use Zapoyok\Ocr\Exception\DirectoryNotFoundException;
use Symfony\Component\Process\ProcessBuilder;

abstract class BaseOcr implements OcrInterface
{
    /**
     * @var \SplFileInfo
     */
    protected $file;

    /**
     * @var \SplFileInfo
     */
    protected $file_original;

    /**
     * Timeout for process execution time.
     *
     * @var int
     */
    protected $timeout = self::DEFAULT_TIMEOUT;

    /**
     * External binary to execute : tessaract, gocr,….
     *
     * @var string
     */
    protected $binary;

    /**
     * @var array
     */
    protected $languages = [];

    /**
     * @var string
     */
    protected $tmpDir = null;

    /**
     * @var array
     */
    protected $tmpFiles = [];

    /**
     * @param \SplFileInfo $file
     *
     * @return BaseOcr
     */
    public function setFile(\SplFileInfo $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return \SplFileInfo
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Generate the command to execute.
     *
     * @return array()
     */
    abstract public function buildCommandArguments();

    /**
     * Hook to permit to cleanup the resources use f
     * or execute the scan.
     */
    public function cleanup()
    {
        foreach ($this->tmpFiles as $file) {
            unset($file);
        }
    }

    /**
     * Execute command and return output.
     *
     * @param array $arguments
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function execute(array $arguments)
    {
        \array_unshift($arguments, $this->binary);

        $builder = ProcessBuilder::create($arguments);

        $process = $builder->getProcess();
        $builder->getProcess()->getCommandLine();
        $process->setTimeout($this->timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw CommandException::factory($process);
        }

        return $process->getOutput() ? $process->getOutput() : $process->getErrorOutput();
    }

    public function buildCommand()
    {
        $arguments = $this->buildCommandArguments();
        \array_unshift($arguments, $this->binary);

        $builder = ProcessBuilder::create($arguments);

        $process = $builder->getProcess();

        return $process->getCommandLine();
    }

    final public function scan()
    {
        $this->file_original = $this->file;

        $arguments = $this->buildCommandArguments();
        $output = $this->execute($arguments);

        $this->cleanup();

        $this->file = $this->file_original;

        return trim($output);
    }

    /**
     * @return string
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * @param string $binary
     *
     * @return BaseOcr
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     *
     * @return BaseOcr
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     *
     * @return BaseOcr
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @param string $language
     *
     * @return BaseOcr
     */
    public function addLanguage($language)
    {
        $this->languages[] = $language;

        return $this;
    }

    protected function generateTmpFile($ext)
    {
        $tmp = $this->getTmpDir() . uniqid() . '.' . $ext;
        $this->tmpFiles[] = $tmp;

        return $tmp;
    }

    /**
     * @param $dir
     *
     * @throws \Zapoyok\Ocr\Exception\DirectoryNotFoundException
     *
     * @return $this
     */
    public function setTmpDir($dir)
    {
        $this->tmpDir = $dir;

        if (false === is_dir($this->tmpDir)) {
            throw new DirectoryNotFoundException($this->tmpDir);
        }

        return $this;
    }

    /**
     * Returns the path of a directory to place temporary files if defined,
     * otherwise returns the default temp directory of the operating system.
     *
     * @return string
     */
    public function getTmpDir()
    {
        if (!$this->tmpDir) {
            $this->tmpDir = sys_get_temp_dir();
        }

        $this->tmpDir = realpath($this->tmpDir) . DIRECTORY_SEPARATOR;

        return $this->tmpDir;
    }
}

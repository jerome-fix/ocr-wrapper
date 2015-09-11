<?php

// TesseractTest.php

/**
 * This file is part of the Jfx project.
 *
 * (c) Jérôme Fix <jerome.fix@zapoyok.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jfx\OCR\tests;

require __DIR__ . '/bootstrap.php';

use Jfx\Ocr\Tesseract;

class TesseractTest extends \PHPUnit_Framework_TestCase
{
    protected $imagesDir;

    public function setUp()
    {
        $this->imagesDir = __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
    }

    public function testGetVersion()
    {
        $ocr = new Tesseract();
        $this->assertRegexp('/tesseract/', $ocr->getVersion());
    }

    public function testWhiteListCommand()
    {
        $file = new \SplFileInfo($this->imagesDir . 'hello.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $ocr->setWhitelist(range('a', 'z'));
        $expectedOut = 'abcdefghijklmnopqrstuvwxyz';
        $this->assertEquals($expectedOut, $ocr->getWhitelist());

        $ocr->setWhitelist(range('A', 'Z'), range(0, 9), '_-@.');
        $expectedOut = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-@.';
        $this->assertEquals($expectedOut, $ocr->getWhitelist());
    }

    public function testBuildCommand()
    {
        $file = new \SplFileInfo($this->imagesDir . 'hello.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $expectedCmd = sprintf("'tesseract' '%s' '-l' '%s' 'stdout'", $file->getPathname(), 'eng');
        $this->assertEquals($expectedCmd, $ocr->buildCommand());

        $ocr->setLanguages(['fra']);
        $expectedCmd = sprintf("'tesseract' '%s' '-l' '%s' 'stdout'", $file->getPathname(), 'fra');
        $this->assertEquals($expectedCmd, $ocr->buildCommand());
    }

    public function testBasicScan()
    {
        $file = new \SplFileInfo($this->imagesDir . 'hello.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $expectedText = 'Hello Tesseract OCR, welcome to PHP';
        $this->assertEquals($expectedText, $ocr->scan());
    }

    public function testSpecificLanguageRecognition()
    {
        $file = new \SplFileInfo($this->imagesDir . 'german.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $ocr->addLanguage(Tesseract::LANGUAGE_DEU);
        $this->assertEquals('grüßen in Deutsch', $ocr->scan());
    }

    public function testWhiteListConfigFileContent()
    {
        $file = new \SplFileInfo($this->imagesDir . '617.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $ocr->setWhitelist(range('A', 'Z'));
        $expectedValue = 'tessedit_char_whitelist ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ocr->buildCommand();
        $this->assertEquals($expectedValue, file_get_contents($ocr->getConfigFile()));
    }

    public function testWhiteListRecognition()
    {
        $file = new \SplFileInfo($this->imagesDir . '617.png');
        $ocr = new Tesseract();
        $ocr->setFile($file);

        $this->assertEquals('617', $ocr->scan());

        $ocr->setWhitelist(range(0, 9));

        $cmd = $ocr->buildCommand();
        $expectedCmd = sprintf("'tesseract' '%s' '-l' '%s' 'stdout' 'nobatch' '%s'", $file->getPathname(), 'eng', $ocr->getConfigFile());
        $this->assertEquals($expectedCmd, $cmd);

        $ocr->setWhitelist(range(0, 9));
        $this->assertEquals('617', $ocr->scan());

        $ocr->setWhitelist(range('A', 'Z'));
        $this->assertNotEquals('617', $ocr->scan());
    }
}

<?php

/**
 * This file is part of the Jfx project.
 *
 * (c) Jérôme Fix <jerome.fix@zapoyok.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Jfx\ocr\tests;

require __DIR__ . '/bootstrap.php';

use Jfx\Ocr\BaseOcr;

class FakeOcr extends BaseOcr
{
    /**
     * {@inheritdoc}
     */
    public function buildCommandArguments()
    {
        return [];
    }
}

class BaseOcrTest extends \PHPUnit_Framework_TestCase // \PHPUnit_Framework_TestCase
{
    public function testLanguage()
    {
        $ocr = new FakeOcr();

        $this->assertInternalType('array', $ocr->getLanguages());

        $ocr->addLanguage('fr');
        $this->assertInternalType('array', $ocr->getLanguages());
        $this->assertContains('fr', $ocr->getLanguages());

        $ocr->addLanguage('en');
        $this->assertInternalType('array', $ocr->getLanguages());
        $this->assertContains('en', $ocr->getLanguages());
        $this->assertEquals(2, count($ocr->getLanguages()));
    }

    public function testSetTmpDir()
    {
        $ocr = new FakeOcr();
        @mkdir( sys_get_temp_dir() . DIRECTORY_SEPARATOR .'abc');
        $ocr->setTmpDir( sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'abc');
        $this->assertEquals(sys_get_temp_dir() .'/abc' . DIRECTORY_SEPARATOR, $ocr->getTmpDir());
        @unlink( sys_get_temp_dir() . DIRECTORY_SEPARATOR .'abc');

    }

    public function testSetTmpDirByDefault()
    {
        $ocr = new FakeOcr();
       $this->assertEquals(sys_get_temp_dir() . DIRECTORY_SEPARATOR, $ocr->getTmpDir());

    }

    public function testDirectoryNotFoundExceptionGetTmpDir()
    {
        $this->setExpectedException('Jfx\\Ocr\\Exception\\DirectoryNotFoundException');
        $ocr = new FakeOcr();
        $ocr->setTmpDir('bogus_dir/abc');
    }
}

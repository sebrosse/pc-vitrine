<?php

namespace MailjetWp\Sepia\Test\UnitTest;

use MailjetWp\PHPUnit\Framework\TestCase;
use MailjetWp\Sepia\PoParser\Parser;
class HeaderTest extends TestCase
{
    public function testGetPluralFormsCount()
    {
        $catalog = $this->parseFile();
        $this->assertEquals(3, $catalog->getHeader()->getPluralFormsCount());
    }
    /**
     * @return \Sepia\PoParser\Catalog\Catalog
     */
    protected function parseFile()
    {
        return Parser::parseFile(\dirname(\dirname(__DIR__)) . '/fixtures/basicHeadersMultiline.po');
    }
}

<?php

use PHPUnit\Framework\TestCase;

class GetItemsTest extends TestCase
{
    public function testRetrieveItems() 
    {
        $this->assertSame(RetrieveItems(), '{"error":"Could not resolve host: -catalog-api","errno":6}');
    }
}

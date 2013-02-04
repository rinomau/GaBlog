<?php
namespace GaBlogTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class CategoryControllerTest
    extends AbstractControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testNewAction()
    {
        $this->assertMatchedRouteName('blog');
    }
}
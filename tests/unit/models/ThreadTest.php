<?php

namespace tests\models;

use app\models\Threads;

class ThreadTest extends \Codeception\Test\Unit
{
    public function testGetFirstThread()
    {
        expect_that($thread = Threads::getFirstThread(1));
        expect($thread->title)->equals('first');
    }
}
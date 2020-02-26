<?php

namespace App\Tests\Entity;
use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testImplementationTask()
    {
        $title = 'test';
        $content = 'test';
        $user = new User();
        $task = new Task();

        $task->setTitle($title);
        $task->setContent($content);
        $task->setUserId($user);

        $this->assertSame($title, $task->getTitle());
        $this->assertSame($content, $task->getContent());
        $this->assertSame($user, $task->getUserId());

    }


}
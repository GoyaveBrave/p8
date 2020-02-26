<?php

namespace App\Tests\Entity;
use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testImplementationTask()
    {
        $username = 'test';
        $password = 'test';
        $email = 'test@test.fr';
        $roles = array('ROLE_USER');
        $user = new User();

        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setRoles($roles);

        $this->assertSame($username, $user->getUsername());
        $this->assertSame($password, $user->getPassword());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($roles, $user->getRoles());
    }
}
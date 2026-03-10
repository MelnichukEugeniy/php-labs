<?php
/**
 * Клас Users — модель користувача
 */
namespace LR3\V13;

class Users
{
    public string $nickname;
    public string $name;
    public string $surname;
    public int $age;
    public string $email;
    public string $password;


    public function getInfo(): string
    {
        return "Ім'я: {$this->name}, Email: {$this->email}, Логін: {$this->nickname}, Пароль: {$this->password}";
    }

    public function __construct(
        string $name = '',
        string $email = '',
        string $nickname = '',
        string $password = '',
        string $surname = '',
        int $age = 0
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->surname = $surname;
        $this->age = $age;
    }


    public function __clone(): void
{
    $this->name = 'User';
    $this->nickname = 'User_' . uniqid();
    $this->surname = '';
    $this->age = 0;
    $this->email = 'user' . rand(1000, 9999) . '@example.com';
    $this->password = 'qwerty';
}

}
// flkjdsjfdskldsfjflksjdf
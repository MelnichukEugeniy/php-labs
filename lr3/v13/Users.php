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
    public string $age;
    public string $email;
    public string $password;

    /**
     * task2
     */
    public function getInfo(): string
    {
        return "Ім'я: {$this->name}, Email: {$this->email}, Логін: {$this->nickname}, Пароль: {$this->password}";
    }
}

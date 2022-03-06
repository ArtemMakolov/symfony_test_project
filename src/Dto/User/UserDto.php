<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Enum\Security\RoleEnum;

class UserDto
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $middleName;
    /** @var string[] {@see RoleEnum} */
    private array $permissions;

    /**
     * UserDto constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $middleName
     * @param string[] $permissions
     */
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $middleName,
        array $permissions
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->permissions = $permissions;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @return string[]
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }
}

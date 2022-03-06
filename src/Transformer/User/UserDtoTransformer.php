<?php
declare(strict_types=1);

namespace App\Transformer\User;

use App\Dto\User\UserDto;
use App\Entity\User;

class UserDtoTransformer
{
    public function fromUserEntity(User $user): UserDto
    {
        return new UserDto(
            $user->getId(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getMiddleName(),
            $user->getRoles(),
        );
    }
}

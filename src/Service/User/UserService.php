<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Dto\User\UserDto;
use App\Exception\User\UserNotFoundException;
use App\Repository\User\UserRepository;
use App\Transformer\User\UserDtoTransformer;

class UserService
{
    private UserRepository $repository;
    private UserDtoTransformer $userDtoTransformer;

    /**
     * @param UserRepository $repository
     * @param UserDtoTransformer $userDtoTransformer
     */
    public function __construct
    (
        UserRepository $repository,
        UserDtoTransformer $userDtoTransformer
    )
    {
        $this->repository = $repository;
        $this->userDtoTransformer = $userDtoTransformer;
    }

    /**
     * Find user by id
     *
     * @param int $id
     * @return UserDto
     * @throws UserNotFoundException
     */
    public function find(int $id): UserDto
    {
        $entity = $this->repository->find($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        return $this->userDtoTransformer->fromUserEntity($entity);
    }
}
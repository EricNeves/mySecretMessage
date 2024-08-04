<?php

namespace App\Application\UseCases\User\RegisterUser;

use App\Application\Dtos\User\RegisterUserDto;
use App\Domain\Entities\User;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\UserRepositoryPort;
use Exception;

class RegisterUserUseCase implements IRegisterUserUseCase
{
    public function __construct(private UserRepositoryPort $userRepository, private PasswordHasherPort $passwordHasher)
    {
    }

    public function execute(RegisterUserDto $registerUserDto): array
    {
        $passwordHashed = $this->passwordHasher->hash($registerUserDto->password);

        $user = new User(null, $registerUserDto->name, $registerUserDto->email, $passwordHashed);

        $register = $this->userRepository->save($user);

        if (!$register) {
            throw new Exception('Sorry, we could not register the user');
        }

        unset($user->password);

        return $user->toArray();
    }
}

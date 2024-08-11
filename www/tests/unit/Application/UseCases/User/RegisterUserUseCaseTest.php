<?php

use App\Application\Dtos\User\RegisterUserDto;
use App\Application\UseCases\User\RegisterUser\RegisterUserUseCase;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\UserRepositoryPort;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    private $userRepository;
    private $passwordHasher;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryPort::class);
        $this->passwordHasher = $this->createMock(PasswordHasherPort::class);
    }

    /**
     * @test
     */
    public function shouldRegisterUser(): void
    {
        $this->passwordHasher->method('hash')->willReturn('hashed_password');

        $this->userRepository->method('save')->willReturn(true);

        $registerUserUseCase = new RegisterUserUseCase($this->userRepository, $this->passwordHasher);

        $registerUserDto = new RegisterUserDto('John Doe', 'john@test.com', 'password');

        $user = $registerUserUseCase->execute($registerUserDto);

        $this->assertIsArray($user);
        $this->assertArrayHasKey('name', $user);
        $this->assertArrayNotHasKey('password', $user);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotRegistered(): void
    {
        $this->passwordHasher->method('hash')->willReturn('hashed_password');

        $this->userRepository->method('save')->willReturn(false);

        $this->expectException(Exception::class);

        $registerUserUseCase = new RegisterUserUseCase($this->userRepository, $this->passwordHasher);

        $registerUserDto = new RegisterUserDto('John Doe', 'john@test.com', 'password');

        $registerUserUseCase->execute($registerUserDto);
    }
}

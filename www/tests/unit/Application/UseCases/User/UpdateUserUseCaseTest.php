<?php

use App\Application\Dtos\User\UpdateUserDto;
use App\Application\UseCases\User\UpdateUser\UpdateUserUseCase;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\UserRepositoryPort;
use PHPUnit\Framework\TestCase;

class UpdateUserUseCaseTest extends TestCase
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
    public function testShouldUpdateUser(): void
    {
        $this->passwordHasher->method('hash')->willReturn('hashed_password');

        $this->userRepository->method('update')->willReturn(true);
        $this->userRepository->method('findById')->willReturn([
            'id'    => 1,
            'name'  => 'John Doe',
            'email' => 'john@test.com',
        ]);

        $updateUserUseCase = new UpdateUserUseCase($this->userRepository, $this->passwordHasher);

        $updateUserDto = new UpdateUserDto(1, 'John Doe', 'password');

        $user = $updateUserUseCase->execute($updateUserDto);

        $this->assertIsArray($user);
        $this->assertArrayHasKey('name', $user);
        $this->assertArrayNotHasKey('password', $user);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotUpdated(): void
    {
        $this->passwordHasher->method('hash')->willReturn('hashed_password');

        $this->userRepository->method('update')->willReturn(false);

        $this->expectException(Exception::class);

        $updateUserUseCase = new UpdateUserUseCase($this->userRepository, $this->passwordHasher);

        $updateUserDto = new UpdateUserDto(1, 'John Doe', 'password');

        $updateUserUseCase->execute($updateUserDto);
    }
}

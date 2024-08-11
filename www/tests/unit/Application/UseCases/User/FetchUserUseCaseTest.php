<?php

use App\Application\UseCases\User\FetchUser\FetchUserUseCase;
use App\Domain\Ports\Out\UserRepositoryPort;
use PHPUnit\Framework\TestCase;

class FetchUserUseCaseTest extends TestCase
{
    private $userRepository;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryPort::class);
    }

    /**
     * @test
     */
    public function shouldReturnUserData(): void
    {
        $this->userRepository->method('findById')->willReturn([
            'id'    => '1',
            'name'  => 'John Doe',
            'email' => 'john@test.com',
        ]);

        $fetchUserUseCase = new FetchUserUseCase($this->userRepository);

        $user = $fetchUserUseCase->execute('1');

        $this->assertIsArray($user);
        $this->assertArrayHasKey('id', $user);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserNotFound(): void
    {
        $this->userRepository->method('findById')->willReturn(false);

        $this->expectException(Exception::class);

        $fetchUserUseCase = new FetchUserUseCase($this->userRepository);

        $fetchUserUseCase->execute('1');
    }
}

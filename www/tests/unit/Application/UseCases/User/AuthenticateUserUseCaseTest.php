<?php

use App\Application\Dtos\User\AuthenticateUserDto;
use App\Application\UseCases\User\AuthenticateUser\AuthenticateUserUseCase;
use App\Domain\Ports\In\AuthenticationPort;
use PHPUnit\Framework\TestCase;

class AuthenticateUserUseCaseTest extends TestCase
{
    private $authentication;

    public function setUp(): void
    {
        $this->authentication = $this->createMock(AuthenticationPort::class);
    }

    /**
     * @test
     */
    public function shouldAuthenticateUser(): void
    {
        $authenticateUserDto = new AuthenticateUserDto("johndoe@test.com", "123");

        $this->authentication->method('authenticate')
            ->willReturn("token");

        $authenticaUserUseCase = new AuthenticateUserUseCase($this->authentication);

        $authenticate = $authenticaUserUseCase->execute($authenticateUserDto);

        $this->assertEquals("token", $authenticate);
    }
}

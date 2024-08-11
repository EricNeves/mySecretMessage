<?php

use App\Application\Dtos\Message\RegisterMessageDto;
use App\Application\Services\Uuid;
use App\Application\UseCases\Message\RegisterMessage\RegisterMessageUseCase;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;
use PHPUnit\Framework\TestCase;

class RegisterMessageUseCaseTest extends TestCase
{
    private $messageRepository;
    private $passwordHasher;
    private $uuid;

    public function setUp(): void
    {
        $this->messageRepository = $this->createMock(MessageRepositoryPort::class);
        $this->passwordHasher    = $this->createMock(PasswordHasherPort::class);
        $this->uuid              = $this->createMock(Uuid::class);
    }

    /**
     * @test
     */
    public function shouldRegisterMessage(): void
    {
        $this->uuid->method('generateUuid')->willReturn('123e4567-e89b-12d3-a456-426614174000');
        $this->passwordHasher->method('hash')->willReturn('hashed_secret_key');

        $this->messageRepository->method('exists')->willReturn(false);
        $this->messageRepository->expects($this->once())->method('save');

        $registerMessageDto = new RegisterMessageDto('My Secret', '1', '123', 60);

        $registerMessageUseCase = new RegisterMessageUseCase($this->messageRepository, $this->passwordHasher, $this->uuid);

        $message = $registerMessageUseCase->execute($registerMessageDto);

        $this->assertIsArray($message);
        $this->assertArrayHasKey('message_id', $message);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenUserAlreadyHasMessage(): void
    {
        $this->uuid->method('generateUuid')->willReturn('123e4567-e89b-12d3-a456-426614174000');
        $this->passwordHasher->method('hash')->willReturn('hashed_secret_key');

        $this->messageRepository->method('exists')->willReturn(true);
        $this->messageRepository->expects($this->never())->method('save');

        $registerMessageDto = new RegisterMessageDto('My Secret', '1', '123', 60);

        $registerMessageUseCase = new RegisterMessageUseCase($this->messageRepository, $this->passwordHasher, $this->uuid);

        $this->expectException(Exception::class);

        $registerMessageUseCase->execute($registerMessageDto);
    }
}

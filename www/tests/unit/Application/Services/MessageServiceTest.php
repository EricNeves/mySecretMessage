<?php

use App\Application\Services\MessageService;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;
use PHPUnit\Framework\TestCase;

class MessageServiceTest extends TestCase
{
    private $messageRepository;
    private $passwordHasher;

    public function setUp(): void
    {
        $this->messageRepository = $this->createMock(MessageRepositoryPort::class);
        $this->passwordHasher    = $this->createMock(PasswordHasherPort::class);
    }

    /**
     * @test
     */
    public function shouldReturnSecureMessage(): void
    {
        $this->messageRepository->method('fetchMessageByID')->willReturn([
            'message_id' => '1',
            'message'    => 'Hello World',
            'user_id'    => '1',
            'secret_key' => 'hashed_secret_key',
        ]);

        $this->passwordHasher->method('verify')->willReturn(true);

        $messageService = new MessageService($this->messageRepository, $this->passwordHasher);

        $secretMessage = $messageService->fetchSecureMessage('1', 'secret_key');

        $this->assertIsArray($secretMessage);
        $this->assertArrayHasKey('message', $secretMessage);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfMessageNotFoundOrExpired(): void
    {
        $this->messageRepository->method('fetchMessageByID')->willReturn([]);

        $this->passwordHasher->method('verify')->willReturn(true);

        $this->expectException(Exception::class);

        $messageService = new MessageService($this->messageRepository, $this->passwordHasher);

        $messageService->fetchSecureMessage('1', 'secret_key');
    }

    /**
     * @test
     */
    public function shouldThrowExceptionIfSecretKeyNotMatch(): void
    {
        $this->messageRepository->method('fetchMessageByID')->willReturn([
            'message_id' => '1',
            'message'    => 'Hello World',
            'user_id'    => '1',
            'secret_key' => 'hashed_secret_key',
        ]);

        $this->passwordHasher->method('verify')->willReturn(false);

        $this->expectException(Exception::class);

        $messageService = new MessageService($this->messageRepository, $this->passwordHasher);

        $messageService->fetchSecureMessage('1', 'secret_key');
    }
}

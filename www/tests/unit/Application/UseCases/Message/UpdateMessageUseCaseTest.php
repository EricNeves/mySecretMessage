<?php

use App\Application\Dtos\Message\UpdateMessageDto;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\UpdateMessage\UpdateMessageUseCase;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\MessageRepositoryPort;
use PHPUnit\Framework\TestCase;

class UpdateMessageUseCaseTest extends TestCase
{
    private $messageRepository;
    private $passwordHasher;
    private $message;

    public function setUp(): void
    {
        $this->messageRepository = $this->createMock(MessageRepositoryPort::class);
        $this->passwordHasher    = $this->createMock(PasswordHasherPort::class);
        $this->message           = $this->createMock(MessageService::class);
    }

    /**
     * @test
     */
    public function shouldUpdateMessage(): void
    {
        $this->message->method('fetchSecureMessage')->willReturn([
            'message_id'  => '123e4567-e89b-12d3-a456-426614174000',
            'secret_key'  => 'hashed_secret_key',
            'message'     => 'My Secret Message',
            'ttl_seconds' => 60,
            'user_id'     => '1',
        ]);

        $this->passwordHasher->method('hash')->willReturn('hashed_new_secret_key');

        $this->messageRepository->method('update');

        $updateMessageDto = new UpdateMessageDto('My New Secret Message', 'secret_key', 'new_secret_key', '1', 60);

        $updateMessageUseCase = new UpdateMessageUseCase(
            $this->messageRepository,
            $this->message,
            $this->passwordHasher
        );

        $message = $updateMessageUseCase->execute($updateMessageDto);

        $this->assertIsArray($message);
        $this->assertArrayHasKey('message', $message);
    }
}

<?php

use App\Application\UseCases\Message\FetchMessageWithoutPassword\FetchMessageWithoutPasswordUseCase;
use App\Domain\Ports\Out\MessageRepositoryPort;
use PHPUnit\Framework\TestCase;

class FetchMessageWithoutPasswordUseCaseTest extends TestCase
{
    private $messageRepository;

    public function setUp(): void
    {
        $this->messageRepository = $this->createMock(MessageRepositoryPort::class);
    }

    /**
     * @test
     */
    public function shouldReturnMessageWithoutPassword(): void
    {
        $this->messageRepository->method('fetchMessageByID')->willReturn([
            'message_id'  => '123e4567-e89b-12d3-a456-426614174000',
            'secret_key'  => 'hashed_secret_key',
            'message'     => 'My Secret Message',
            'ttl_seconds' => 60,
            'user_id'     => '1',
        ]);

        $fetchMessageWithoutPasswordUseCase = new FetchMessageWithoutPasswordUseCase($this->messageRepository);

        $message = $fetchMessageWithoutPasswordUseCase->execute('1');

        $this->assertIsArray($message);
        $this->assertArrayHasKey('message_id', $message);
    }
}

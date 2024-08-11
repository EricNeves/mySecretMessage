<?php

use App\Application\Dtos\Message\ShowSharedMessageDto;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\ShowSharedMessage\ShowSharedMessageUseCase;
use PHPUnit\Framework\TestCase;

class ShowSharedMessageUseCaseTest extends TestCase
{
    private $messageService;

    public function setUp(): void
    {
        $this->messageService = $this->createMock(MessageService::class);
    }

    /**
     * @test
     */
    public function shouldShowSharedMessage(): void
    {
        $this->messageService->method('fetchSecureMessage')->willReturn([
            'message_id'  => '123e4567-e89b-12d3-a456-426614174000',
            'secret_key'  => 'hashed_secret_key',
            'message'     => 'My Secret Message',
            'ttl_seconds' => 60,
            'user_id'     => '1',
        ]);

        $showSharedMessageDto = new ShowSharedMessageDto('1', '123e4567-e89b-12d3-a456-426614174000', 'secret_key');

        $showSharedMessageUseCase = new ShowSharedMessageUseCase($this->messageService);

        $message = $showSharedMessageUseCase->execute($showSharedMessageDto);

        $this->assertIsArray($message);
        $this->assertArrayHasKey('message_id', $message);
        $this->assertArrayNotHasKey('secret_key', $message);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenMessageNotFound(): void
    {
        $this->messageService->method('fetchSecureMessage')->willReturn([
            'message_id'  => '123e4567-e89b-12d3-a456-426614174000',
            'secret_key'  => 'hashed_secret_key',
            'message'     => 'My Secret Message',
            'ttl_seconds' => 60,
            'user_id'     => '1',
        ]);

        $showSharedMessageDto = new ShowSharedMessageDto('1', '123e4567-e89b-12d3-a456-426614174123', 'secret_key');

        $this->expectException(Exception::class);

        $showSharedMessageUseCase = new ShowSharedMessageUseCase($this->messageService);

        $showSharedMessageUseCase->execute($showSharedMessageDto);
    }
}

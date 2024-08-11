<?php

use App\Application\Dtos\Message\FetchMessageSecureDto;
use App\Application\Services\MessageService;
use App\Application\UseCases\Message\FetchMessageSecure\FetchMessageSecureUseCase;
use PHPUnit\Framework\TestCase;

class FetchMessageSecureUseCaseTest extends TestCase
{
    private $messageService;

    public function setUp(): void
    {
        $this->messageService = $this->createMock(MessageService::class);
    }

    /**
     * @test
     */
    public function shouldReturnSecureMessage(): void
    {
        $this->messageService->method('fetchSecureMessage')->willReturn([
            'message_id'  => '123e4567-e89b-12d3-a456-426614174000',
            'secret_key'  => '123',
            'message'     => 'My Secret Message',
            'ttl_seconds' => 60,
            'user_id'     => '1',
        ]);

        $fetchMessageSecureDto = new FetchMessageSecureDto('1', '123');

        $fetchMessageSecureUseCase = new FetchMessageSecureUseCase($this->messageService);

        $secureMessage = $fetchMessageSecureUseCase->execute($fetchMessageSecureDto);

        $this->assertIsArray($secureMessage);
        $this->assertArrayHasKey('message_id', $secureMessage);
    }
}

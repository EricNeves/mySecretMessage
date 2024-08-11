<?php

use App\Application\Dtos\Message\DeleteMessageDto;
use App\Application\UseCases\Message\DeleteMessage\DeleteMessageUseCase;
use App\Domain\Ports\Out\MessageRepositoryPort;
use PHPUnit\Framework\TestCase;

class DeleteMessageUseCaseTest extends TestCase
{
    private $messageRepository;

    public function setUp(): void
    {
        $this->messageRepository = $this->createMock(MessageRepositoryPort::class);
    }

    /**
     * @test
     */
    public function shouldDeleteMessage(): void
    {
        $this->messageRepository->expects($this->once())
            ->method('remove')
            ->with(1);

        $deleteMessageUseCase = new DeleteMessageUseCase($this->messageRepository);

        $deleteMessageDto = new DeleteMessageDto('1');

        $deleteMessageUseCase->execute($deleteMessageDto);

        $this->assertTrue(true);
    }
}

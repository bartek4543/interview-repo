<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{

    private const NAME_VALUE = 'uname';
    private const EMAIL_VALUE = 'uemail';
    private const PASSWORD_VALUE = 'upassword';
    private const ID_VALUE = 99;

    private UserService $userService;
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function testUpdate(): void
    {
        $request = $this->createMock(UserRequest::class);
        $request->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive([UserService::NAME], [UserService::EMAIL])
            ->willReturnOnConsecutiveCalls(self::NAME_VALUE, self::EMAIL_VALUE);
        $request->expects($this->once())
            ->method('route')
            ->with('id')
            ->willReturn((string) self::ID_VALUE);
        $this->userRepository->expects($this->once())
            ->method('update')
            ->with(self::ID_VALUE, [UserService::NAME => self::NAME_VALUE, UserService::EMAIL => self::EMAIL_VALUE]);
        $this->userService->update($request);
    }

    public function testGetAllUsers(): void
    {
        $this->userRepository->expects($this->once())
            ->method('getAll');
        $this->userService->getAllUsers();
    }

    public function testDelete(): void
    {
        $this->userRepository->expects($this->once())
            ->method('delete')
            ->with(self::ID_VALUE);
        $this->userService->delete(self::ID_VALUE);
    }

    public function testGetById(): void
    {
        $this->userRepository->expects($this->once())
            ->method('getById')
            ->with(self::ID_VALUE)
            ->willReturn($this->createMock(User::class));
        $this->userService->getById(self::ID_VALUE);
    }

    public function testSave(): void
    {
        $request = $this->createMock(UserRequest::class);
        $request->expects($this->exactly(3))
            ->method('get')
            ->withConsecutive([UserService::NAME], [UserService::EMAIL], [UserService::PASSWORD])
            ->willReturnOnConsecutiveCalls(self::NAME_VALUE, self::EMAIL_VALUE, self::PASSWORD_VALUE);
        $this->userRepository->expects($this->once())
            ->method('save')
            ->with([UserService::NAME => self::NAME_VALUE, UserService::EMAIL => self::EMAIL_VALUE, UserService::PASSWORD => self::PASSWORD_VALUE]);
        $this->userService->save($request);
    }
}

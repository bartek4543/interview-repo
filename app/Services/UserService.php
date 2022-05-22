<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

final class UserService
{
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const ID = 'id';

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function save(UserRequest $request): void
    {
        $this->userRepository->save([
            self::NAME => $request->get(self::NAME),
            self::EMAIL => $request->get(self::EMAIL),
            self::PASSWORD => $request->get(self::PASSWORD),
        ]);
    }

    public function getById(int $id): User
    {
        return $this->userRepository->getById($id);
    }

    public function update(UserRequest $request): void
    {
        $this->userRepository->update((int)$request->route(self::ID), [
            self::NAME => $request->get(self::NAME),
            self::EMAIL => $request->get(self::EMAIL),
        ]);
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }
}

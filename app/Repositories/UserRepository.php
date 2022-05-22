<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByEmail(string $email): array
    {
        return $this->model->where('email', $email)->get();
    }
}

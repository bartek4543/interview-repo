<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function welcomePage(): View
    {
        $users = $this->userService->getAllUsers();
        return view('welcome', compact('users'));
    }

    public function create(): View
    {
        return view('user.create');
    }

    public function save(UserRequest $request): RedirectResponse
    {
        $this->userService->save($request);
        return redirect(RouteServiceProvider::HOME);
    }

    public function edit(int $id): View
    {
        $user = $this->userService->getById($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request): RedirectResponse
    {
        $this->userService->update($request);
        return redirect(RouteServiceProvider::HOME);
    }

    public function delete(int $id): RedirectResponse
    {
        $this->userService->delete($id);
        return redirect(RouteServiceProvider::HOME);
    }
}

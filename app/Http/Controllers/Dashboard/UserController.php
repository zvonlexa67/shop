<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\User\DestroyAction;
use App\Actions\Dashboard\User\IndexAction;
use App\Actions\Dashboard\User\StoreAction;
use App\Actions\Dashboard\User\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\StoreRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(int $user_id, IndexAction $action): Response
    {
        return Inertia::render('dashboard/user/Index', $action($user_id));
    }

    public function store(StoreRequest $request, StoreAction $storeUser): RedirectResponse
    {
        return redirect()->intended(route('dashboard.users.index', $storeUser($request->all())));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.users.index', $action($request->all())));
    }

    public function destroy(int $user_id, DestroyAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.users.index', $action($user_id)));
    }
}

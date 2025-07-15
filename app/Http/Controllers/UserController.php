<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|staff');
    }

    /**
     * Checks if the current user has authorization to alter the provided data
     */
    public function checkAuthorization($data): bool
    {
        if (!auth('sanctum')->user()->hasRole('admin'))
        {
            if ($data->user->hasRole('admin')) {
                return false;
            }
        }

        if (auth('sanctum')->user()->hasRole('user')){
            if (auth('sanctum')->id() !== $data->user->id) {
                return false;
            }
        }
        return true;
    }

    public function index()
    {
        $users = User::paginate();

        return view('users.index', compact(['users']));
    }

    public function show(User $user, Request $request)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {

        // TODO: Fix fields not updating

        $validatedData = $request->validated();
        $user = User::create($validatedData);
        return redirect(route('users.index'))->with('create-success', "Created {$user->name}");
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->role === 'staff'){
            if ($user->role !== 'admin') {
                return redirect(route('definitions.index'))->with('message', "Unauthorized action");
            }
            if ($user->id !== $authenticatedUser->id) {
                return redirect(route('definitions.index'))->with('message', "Unauthorized action");
            }
        }

        if ($authenticatedUser->role === 'user'){
            if ($user->id !== $authenticatedUser->id) {
                return redirect(route('definitions.index'))->with('message', "Unauthorized action");
            }
        }

        $user->update($validatedData);
        return redirect(route('users.index'))->with("update-success", "Updated {$user->name}");
    }

    public function delete(User $user)
    {
        return view('users.delete', compact('user'));
    }

    public function destroy(User $user)
    {
        $authenticatedUser = Auth::user();

        if(!$this->checkAuthorization($user))
        {
            return redirect(route('words.index'))->with("message", "Unauthorized");
        }

        $oldUser = $user;
        $user->delete();

        if ($user->id === $authenticatedUser->id) {
            return redirect(route('static.home'));
        } else {
            return redirect(route('users.index'))->with("delete-success", "Deleted '{$oldUser->name}'");
        }
    }


}

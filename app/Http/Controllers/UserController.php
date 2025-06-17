<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * User service instance
     *
     * @var \App\Services\UserService
     */
    protected $user_service;
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user_service = new UserService();
    }

    /**
     * Get User List
     *
     * @return \Illuminate\View\View
     */
    public function getUserList()
    {
        // Fetch user list using the user service
        $users = $this->user_service->getUserList();
        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Create User
     *
     * @param \App\Http\Requests\UserSaveRequest $request
     * @param int|null $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createUser(UserSaveRequest $request)
    {
        // Logic to create a new user
        if ($request->isMethod('post')) {
            $this->user_service->saveUser($request);
            // Redirect to user list with success message
            return redirect()->route('user.list')->with('success', 'User created successfully.');
        }
        $user = new User();
        return view('user.save', [
            'user' => $user,
        ]);
    }

    /**
     * Edit User
     *
     * @param \App\Http\Requests\UserSaveRequest $request
     * @param int|null $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editUser(UserSaveRequest $request, $id = null)
    {
        // Logic to create a new user
        if ($request->isMethod('post')) {
            $this->user_service->saveUser($request, $id);
            // Redirect to user list with success message
            return redirect()->route('user.list')->with('success', 'User Updated successfully.');
        }
        $user = User::find($id);
        return view('user.save', [
            'user' => $user,
        ]);
    }
}
<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService
{
    /**
     * Get user list
     *
     * @return array
     */
    public function getUserList()
    {
        // Logic to fetch user list from database or any other source
        return User::all();
    }
    
    /**
     * saveUser
     *
     * @param  Request $request
     * @param  $id
     * @return void
     */
    public function saveUser(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();

            $user = $id ? User::findOrFail($id) : new User();
            if ($request->has('password')) {
                $request['password'] = Hash::make($request->input('password'));
            }
            $user->fill($request->all())->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }
}

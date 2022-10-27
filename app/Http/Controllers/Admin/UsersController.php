<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        return view('admin.users', [
            'users' => User::query()->get()
        ]);
    }



    public function edit($id)
    {
        return view('admin.user', [
            'user' => User::query()
                ->where('id', '=', $id)
                ->first()
        ]);
    }


    public function update($id, Request $request)
    {
        $data = $request->only(['name', 'email', 'is_admin']);
        $data['is_admin'] = isset($data['is_admin']);
        $user = User::query()
            ->where('id', '=', $id)
            ->first()
            ->fill($data)
            ->save();
        if ($user) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.update.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.users.update.error'));
        }
    }


    public function destroy($id)
    {
        if (User::query()
            ->where('id', '=', $id)
            ->first()
            ->delete($id)) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.remove.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.users.remove.error'));
        }
    }
}

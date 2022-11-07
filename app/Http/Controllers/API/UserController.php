<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\ImageService;

class UserController extends Controller
{
    /**
     * Show user.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id) {
        try {
            $user = User::findOrFail($id);

            if (empty($user)) {
                return response()->json('No user with that id', 500);
            }

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Something went wrong in UserController.show | ' . $e->getMessage()
            ], 400);
        }
    }
    /**
     * Update user.
     *
     * @param App\Http\Requests\User\UpdateUserRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('image')) {
                (new ImageService)->updateImage($user, $request, '/images/users/', 'update');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->location = $request->location;
            $user->description = $request->description;

            $user->save();

            return response()->json('User details update', 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => 'Something went wrong in UserController.update? Please try again.'
            ], 400);
        }
    }
}

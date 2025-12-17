<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\User_Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function user_profile(Request $request)
    {
        $user = $request->user();

        $exams = User_Answers::select(
            'category',
            'exam_order',
            DB::raw('SUM(points) as total_points'),
            DB::raw('MAX(created_at) as last_attempt')
        )
            ->where('user_id', $user->id)
            ->groupBy('category', 'exam_order')
            ->orderBy('category')
            ->orderBy('exam_order')
            ->get();

        return view('userProfile', compact('user', 'exams'));
    }


    public function store(StoreUserRequest $request)
    {
        $validated =  $request->validated();

        if ($request->hasFile("avatar")) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated["avatar"] = $path;
        }

        $user = User::create([
            'userName' => $validated["userName"],
            'avatar' => $validated["avatar"] ?? null,
            'email' => $validated["email"],
            'password' => Hash::make($validated["password"]),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully');
    }


    public function login(LoginUserRequest $request)
    {
        $validated  = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        Auth::login($user);

        return redirect()->route('home')->with('success', 'logged in successfully');
    }

    public function update(UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $authUser = $request->user();

        if ($request->hasFile("avatar")) {
            if ($authUser->avatar && Storage::disk('public')->exists($authUser->avatar)) {
                Storage::disk('public')->delete($authUser->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated["avatar"] = $path;
        }

        $authUser->update([
            'userName' => $validated["userName"] ?? $authUser->userName,
            'avatar' => $validated["avatar"] ?? $authUser->avatar
        ]);

        return response()->json([
            'message' => "Profile updated successfully",
            'user' => $authUser,
            "ok" => true,
            'user' => $authUser,
            'userv' => $validated
        ]);
    }
}

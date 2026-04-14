<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function verifyAgent(User $user, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($user->role !== 'agent') {
            return response()->json([
                'message' => 'This user is not an agent'
            ], 400);
        }

        $user->update([
            'is_verified' => true,
        ]);

        return response()->json([
            'message' => 'Agent verified successfully',
            'data' => $user,
        ]);
    }

    public function unverifyAgent(User $user, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($user->role !== 'agent') {
            return response()->json([
                'message' => 'This user is not an agent'
            ], 400);
        }

        $user->update([
            'is_verified' => false,
        ]);

        return response()->json([
            'message' => 'Agent unverified successfully',
            'data' => $user,
        ]);
    }


    public function banUser(User $user, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($user->role === 'admin') {
            return response()->json([
                'message' => 'You cannot ban an admin'
            ], 400);
        }

        $user->update([
            'is_banned' => true,
        ]);

        return response()->json([
            'message' => 'User banned successfully',
            'data' => $user,
        ]);
    }

    public function unbanUser(User $user, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $user->update([
            'is_banned' => false,
        ]);

        return response()->json([
            'message' => 'User unbanned successfully',
            'data' => $user,
        ]);
    }
}

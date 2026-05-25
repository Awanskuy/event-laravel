<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Statistics Section counts
        $totalUsers = User::count();
        $totalOrganizers = User::where('role', 'organizer')->count();
        $totalParticipants = User::where('role', 'user')->count();

        // Build Query with Search and Role Filter
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && in_array($request->input('role'), ['admin', 'organizer', 'user'])) {
            $query->where('role', $request->input('role'));
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        // User Detail View check
        $userDetail = null;
        if ($request->filled('view')) {
            $userDetail = User::withCount(['tickets', 'events'])->find($request->input('view'));
        }

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalOrganizers',
            'totalParticipants',
            'userDetail'
        ));
    }
}

<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Str;

class UserSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$q = $request->get('q', '')) return response()->json([]);


        return User::where('id', '!=', $request->excludedUser)
            ->where(DB::raw('LOWER(name)'), 'like', '%' . Str::lower($q) . '%')
            ->get(['id', 'name']);
    }
}

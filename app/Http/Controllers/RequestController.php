<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function accept(Request $request, $id)
    {
        $request = Request::find($id);
        $request->update([
            'accepted' => true,
            'rejected' => false,
            'loading' => false,
        ]);

        // Logic for accepting request
    }

    public function reject(Request $request, $id)
    {
        $request = Request::find($id);
        $request->update([
            'accepted' => false,
            'rejected' => true,
            'loading' => false,
        ]);

        // Logic for rejecting request
    }
}

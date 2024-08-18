<?php

namespace App\Http\Controllers\customer;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function comment(Request $request) {
        $validator = $request->validate(['userComment'=>'required']);
        $data = [
            'product_id' => $request->product_id,
            'user_id' => $request->userId,
            'comment' => $request->userComment
        ];
        Comment::create($data);
        return back();
    }
}

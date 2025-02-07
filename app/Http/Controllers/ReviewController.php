<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Guest;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getReviews()
    {

    }
    public function addReview(Request $request)
    {

        $data = $request->validate([
            'guestID' => 'required',
            'resortID' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);

        Review::create($data);

        return redirect(route('user.resort.details', ['resortID' => $request['resortID']]))->with('commentSuccess', 'Comment / Review have been submitted successfully');
    }

    public function destroy(Request $request)
    {
        Review::findOrFail($request['reviewID'])->delete();
        return redirect(route('user.resort.details', ['resortID' => $request['resortID']]))->with('commentSuccess', 'Comment / Review have been submitted successfully');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'guestID' => 'required',
            'resortID' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);
        
        Review::findOrFail($request['reviewID'])->update($data);

        return redirect(route('user.resort.details', ['resortID' => $request['resortID']]))->with('commentSuccess', 'Comment / Review have been submitted successfully');
    }
}

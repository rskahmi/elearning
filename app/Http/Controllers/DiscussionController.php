<?php

namespace App\Http\Controllers;

use App\Models\DiscussionModel;
use App\Models\ReplyModel;
use App\Models\CourseModel;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function allCourses()
    {
        $courses = CourseModel::all();
        return view('after-login.discussion.all', compact('courses'));
    }

    public function index($courseId)
    {
        $course = CourseModel::findOrFail($courseId);
        $discussions = DiscussionModel::with(['user', 'replies.user'])
            ->where('course_id', $courseId)
            ->latest()
            ->get();
        return view('after-login.discussion.index', compact('course', 'discussions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'content' => 'required'
        ]);

        $discussion = DiscussionModel::create([
            'course_id' => $request->course_id,
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
        return response()->json($discussion);
    }

    public function reply(Request $request, $discussionId)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $reply = ReplyModel::create([
            'discussion_id' => $discussionId,
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
        return response()->json($reply);
    }
}

<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $bookmarks = Bookmark::with('jobSeeker', 'job')->where('job_seeker_id', auth()->user()->jobSeeker->id)->get();

            return DataTables::of($bookmarks)
                ->addIndexColumn()
                ->addColumn('job_title', function ($bookmark) {
                    return $bookmark->job->title;
                })
                ->addColumn('company', function ($bookmark) {
                    return $bookmark->job->employer->company_name;
                })
                ->addColumn('work_type', function ($bookmark) {
                    return $bookmark->job->work_type;
                })
                ->addColumn('salary', function ($bookmark) {
                    return "₱" . number_format($bookmark->job->salary, 2);
                })
                ->addColumn('date_added', function ($bookmark) {
                    return $bookmark->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($bookmark) {
                    return
                        "<div class='d-flex align-items-center justify-content-arround gap-2'>
                    <a href='" . route('job_seeker.jobs.show', $bookmark->job->id) . "' class='btn btn-success btn-sm'><i class='fas fa-eye'></i></a>
                    
                        <button class='btn btn-danger btn-sm text-light deleteBookmarkButton' data-id='$bookmark->id'><i class='fas fa-trash'></i></button>
                    
                </div>";
                })
                ->rawColumns(['job_title', 'company', 'work_type', 'action'])
                ->make(true);
        }

        return view('job_seeker.bookmark');
    }

    public function store(Job $job)
    {

        $bookmark_count = Bookmark::where('job_id', $job->id)->where('job_seeker_id', auth()->user()->jobSeeker->id)->count();

        if ($bookmark_count > 0) {
            return redirect()->back()->with('error', 'Job Already in the Bookmark');
        }

        Bookmark::create([
            'job_id' => $job->id,
            'job_seeker_id' => auth()->user()->jobSeeker->id
        ]);

        return redirect()->back()->with('success', 'Job Successfully Added to Bookmark');
    }

    public function destroy($id)
    {
        $bookmark = Bookmark::findOrFail($id);

        $bookmark->delete();

        return redirect()->route('bookmark.index')->with('success', 'Job Successfully Deleted from Bookmark');
    }
}

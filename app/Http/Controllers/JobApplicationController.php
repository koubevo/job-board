<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
class JobApplicationController extends Controller
{

    use AuthorizesRequests;

    public function create(Offer $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }


    public function store(Offer $job, Request $request)
    {

        $validatedData = request()->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        $job->jobApplications()->create([
            'user_id' => request()->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Job application submitted.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $application)
    {
        //
    }
}

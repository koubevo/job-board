<?php

namespace App\Http\Controllers;

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
        $job->jobApplications()->create([
            'user_id' => request()->user()->id,
            ...request()->validate([
                'expected_salary' => 'required|min:1|max:1000000'
            ])
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Job application submitted.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

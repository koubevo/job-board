<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAnyEmployer', Offer::class);
        return view('my_job.index', [
            'jobs' => request()->user()->employer->jobs()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->withTrashed()
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Offer::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->authorize('create', Offer::class);

        $request->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')->with('success', 'Job offer created!');
    }

    public function edit(Offer $myJob)
    {
        $this->authorize('update', $myJob);
        return view('my_job.edit', ['job' => $myJob]);
    }

    public function update(JobRequest $request, Offer $myJob)
    {
        $this->authorize('update', $myJob);

        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')->with('success', 'Offer edited!');
    }

    public function destroy(Offer $myJob)
    {
        $myJob->delete();
        return redirect()->route('my-jobs.index')->with('success', 'Offer deleted.');
    }


}

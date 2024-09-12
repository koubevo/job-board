<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my_job.index', [
            'jobs' => request()->user()->employer->jobs()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:5000',
            'description' => 'required|string',
            'experience' => 'required|in:' . implode(',', Offer::$experience),
            'category' => 'required|in:' . implode(',', Offer::$category)
        ]);

        $request->user()->employer->jobs()->create($validatedData);

        return redirect()->route('my-jobs.index')->with('success', 'Job offer created!');
    }


}

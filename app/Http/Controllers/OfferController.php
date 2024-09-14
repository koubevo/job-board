<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Offer::class);
        $filters = request()->only(['search', 'min_salary', 'max_salary', 'experience', 'category']);

        return view('job.index', ['jobs' => Offer::with('employer')->latest()->filter($filters)->get()]);
    }


    public function show(Offer $job)
    {
        $this->authorize('view', $job);
        return view('job.show', ['job' => $job->load('employer.jobs')]);
    }
}
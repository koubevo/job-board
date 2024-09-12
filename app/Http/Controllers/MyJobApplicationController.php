<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MyJobApplicationController extends Controller
{

    use AuthorizesRequests;


    public function index()
    {

        return view(
            'my_job_application.index',
            [
                'applications' => DB::table('job_applications')
                    ->join('offers', 'job_applications.offer_id', '=', 'offers.id')
                    ->where('job_applications.user_id', request()->user()->id)
                    ->select(
                        'job_applications.id as application_id',  // Alias pro id
                        'job_applications.*',                    // Zahrnuje všechny ostatní sloupce z job_applications
                        'offers.*'                              // Zahrnuje všechny sloupce z offers
                    )
                    ->orderBy('job_applications.created_at', 'desc')
                    ->get()
            ],
        );
    }

    public function destroy(string $id)
    {
        JobApplication::find($id)->delete();
        return redirect()->back()->with(
            'success',
            'Job application canceled.'
        );
    }


}

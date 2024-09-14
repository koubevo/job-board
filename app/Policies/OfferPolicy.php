<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use function Symfony\Component\String\b;

class OfferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewAnyEmployer(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Offer $offer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->employer != null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Offer $offer): bool|Response
    {
        if ($offer->jobApplications->count() > 0) {
            return Response::deny('Cannot change the job with applicants.');
        }

        if ($offer->employer->user_id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Offer $offer): bool
    {
        return $offer->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Offer $offer): bool
    {
        return $offer->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Offer $offer): bool
    {
        return $offer->employer->user_id === $user->id;
    }

    public function apply(User $user, Offer $job): bool
    {
        return !$job->hasUserApplied($user);

    }
}

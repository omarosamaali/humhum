<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class NoMoreThanOneActiveChallenge implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // This rule only applies if the 'status' being submitted is 'active'
        if (request()->input('status') === 'active') {
            $chefId = Auth::id(); // Get the authenticated chef's ID

            // Check if the chef already has an active challenge
            $activeChallengeCount = Challenge::where('chef_id', $chefId)
                ->where('status', 'active')
                ->count();

            if ($activeChallengeCount > 0) {
                $fail('لا يمكنك إضافة أكثر من تحدي فعال واحد في نفس الوقت.');
            }
        }
    }
}

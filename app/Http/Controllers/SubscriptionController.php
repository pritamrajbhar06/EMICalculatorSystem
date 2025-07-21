<?php

namespace App\Http\Controllers;

use App\Enums\UserRegistrationStatus;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SubscriptionController extends Controller
{
    public function checkout(Request $request)
    {
        return $request->user()
            ->newSubscription('default', env('STRIPE_BASIC_PRICE_ID'))
            ->checkout([
                'success_url' => route('subscription.success'),
                'cancel_url'  => route('user.logout'),
            ]);
    }


    public function success(Request $request)
    {
        $userService = new UserService();
        $userService->update(
            $request->user()->id,
            [
                'registration_status' => UserRegistrationStatus::SUBSCRIBED_COMPLETED,
            ]
        );

        return redirect()->route('user.dashboard')->with('message', 'Subscription successful. Welcome!');
    }


}

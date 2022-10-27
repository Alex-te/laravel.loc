<?php

namespace App\Http\Controllers;

use App\Services\Contracts\Social;
use \Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use \Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class SocialProvidersController extends Controller
{
    public function redirect(string $network): SymfonyRedirectResponse|RedirectResponse
    {
        return Socialite::driver($network)->redirect();
    }

    public function callback($driver, Social $social)
    {
        return redirect(
            $social->loginAndGetRedirectUrl(
                Socialite::driver($driver)->user()
            )
        );
    }
}

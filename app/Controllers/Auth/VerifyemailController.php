<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use CodeIgniter\I18n\Time;

class VerifyemailController extends BaseController
{
    /**
     * Mark the authenticated users email addres as verified.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function index(string $hash)
    {
        // Check first if user email already verified
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        
        // Check if hash equal with current user email.
        if (! hash_equals($hash, sha1(auth()->user()->email))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        $signature = hash_hmac('sha256', auth()->user()->email, config('Encryption')->key);

        // Check signature key
        if (! hash_equals($signature, $this->request->getVar('signature'))) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.token'));
        }

        // Check for token if expired
        if ($this->request->getVar('expires') < Time::now()->getTimestamp()) {
            return redirect()->route('verification.notice')->with('error', lang('Passwords.expired'));
        }

        auth()->user()->markEmailAsVerified();

        Events::trigger('fireVerifiedUser', auth()->user());

        return redirect()->route('dashboard');
    }
}

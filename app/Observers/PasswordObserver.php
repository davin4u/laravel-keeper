<?php

namespace App\Observers;

use App\Password;
use Illuminate\Support\Facades\Auth;

class PasswordObserver
{
    /**
     * Handle the password "created" event.
     *
     * @param  \App\Password  $password
     * @return void
     */
    public function created(Password $password)
    {
        //
    }

    /**
     * Handle the password "updated" event.
     *
     * @param  \App\Password  $password
     * @return void
     */
    public function updated(Password $password)
    {
        //
    }

    /**
     * Handle the password "deleted" event.
     *
     * @param  \App\Password  $password
     * @return void
     */
    public function deleted(Password $password)
    {
        //
    }

    /**
     * Handle the password "restored" event.
     *
     * @param  \App\Password  $password
     * @return void
     */
    public function restored(Password $password)
    {
        //
    }

    /**
     * Handle the password "force deleted" event.
     *
     * @param  \App\Password  $password
     * @return void
     */
    public function forceDeleted(Password $password)
    {
        //
    }
}

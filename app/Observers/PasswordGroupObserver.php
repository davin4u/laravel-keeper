<?php

namespace App\Observers;

use App\Password;
use App\PasswordGroup;

class PasswordGroupObserver
{
    /**
     * Handle the password group "created" event.
     *
     * @param  \App\PasswordGroup  $passwordGroup
     * @return void
     */
    public function created(PasswordGroup $passwordGroup)
    {
        //
    }

    /**
     * Handle the password group "updated" event.
     *
     * @param  \App\PasswordGroup  $passwordGroup
     * @return void
     */
    public function updated(PasswordGroup $passwordGroup)
    {
        //
    }

    /**
     * @param PasswordGroup $passwordGroup
     * @throws \Exception
     */
    public function deleted(PasswordGroup $passwordGroup)
    {
        $passwords = $passwordGroup->passwords;

        foreach ($passwords as $password) {
            /** @var Password $password */

            $password->delete();
        }
    }

    /**
     * Handle the password group "restored" event.
     *
     * @param  \App\PasswordGroup  $passwordGroup
     * @return void
     */
    public function restored(PasswordGroup $passwordGroup)
    {
        //
    }

    /**
     * Handle the password group "force deleted" event.
     *
     * @param  \App\PasswordGroup  $passwordGroup
     * @return void
     */
    public function forceDeleted(PasswordGroup $passwordGroup)
    {
        //
    }
}

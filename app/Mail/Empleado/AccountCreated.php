<?php

namespace App\Mail\Empleado;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cuenta;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cuenta)
    {
        $this->user=$user;
        $this->cuenta=$cuenta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.Empleado.account-created');
    }
}

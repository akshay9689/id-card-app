<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $password)
    {

        $this->name= $name;
        $this->password= $password;
        $this->subject= "Login Deatils";
    }

    
    public function build()
    {

        return $this->view('mail', ['name' => $this->name, 'password' => $this->password])->subject($this->subject);
       
        // ->attach($this->filePath);
        // return $this->view('notification')
        //     ->subject('This is notification')
        //     ->attach($this->filename);
        
    }

    
}

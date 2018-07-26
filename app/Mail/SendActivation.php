<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PharIo\Manifest\InvalidEmailException;

class SendActivation extends Mailable
{
    use Queueable, SerializesModels;

    protected $template = null;
    protected $contentVariables = []; // Content variables inside of template

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!$this->template) {
            throw new InvalidEmailException('Cannot find template property. Maybe, you need to call setTemplate() method?');
        }
        return $this->view($this->template, $this->contentVariables);
    }

    /**
     * Set template name
     *
     * @param $template
     */
    public function setTemplate($template, $contentVars) {
        $this->template = $template;
        $this->contentVariables = $contentVars;
        return $this;
    }
}

<?php

namespace App\Components;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\EventNotFoundHandler;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/**
 * Class generates notices
 *
 * Class Notifier
 * @package App\Components
 */

class Notifier extends Component {
    protected $mails = [ // Templates for different situations
        'sendActivation' => [
            'class' => \App\Mail\SendActivation::class,
            'template' => 'mail.send-activation'
        ]
    ];

    protected $messages = []; // Messages: notices, warnings...

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Send email notice
     *
     * @param $event Event type
     * @param $contentVars Arr of content vars
     * @return $this \App\Components\Notifier
     */
    public function sendEmailNotice($event, $contentVars, User $to) {
        if(isset($this->mails[$event])) {
            $this->_writeNotice('success', 'Email for activation has been sent.');
            $eventMailObj = new ($this->mails[$event]['class'])();
            Mail::to($to)->send($eventMailObj->setTemplate($this->mails[$event]['template'], $contentVars));
            return $this;
        }

        throw new EventNotFoundException('Event '.$event.' not found');
    }

    /**
     * Get all notices
     *
     * @return array
     */
    public function flush($type = 'all') {
        if($type != 'all' && isset($this->messages[$type])) {
            return array_filter($this->messages, function($k) use ($type) {
                return $k == $type;
            }, ARRAY_FILTER_USE_BOTH);
        } elseif($type != 'all' && !isset($this->messages[$type])) {
            return [];
        }

        return $this->messages;
    }

    /**
     * Write notice
     *
     * @param $noticeType
     * @param $text
     * @return $this
     */
    private function _writeNotice($noticeType, $text) {
        $this->messages[$noticeType] = $text;
        return $this;
    }
}
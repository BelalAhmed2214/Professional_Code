<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if(Session()->has('Video is visited'))
        {
            $this->updateViews($event->video);
        }
        else
            return false;
    
    }
    public function updateViews($video)
    {
        $video->views=$video->views+1;
        $video->save();
        Session()->put('Video is visited',$video->id);

    }
}

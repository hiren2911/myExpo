<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Event;
use App\Mail\EventEnds;

class NotifyEventEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifyEventEnd:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Event Admin about stands booked for events';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Fech all the events completed yesterday
        $endedEvents = Event::where('endDate', date('Y-m-d',strtotime('-1 day')))->get();
        
        
        foreach($endedEvents as $event) {
            
            // Output event title on console
            // $this->output->text($event->title);
            // Send event end mail
            Mail::to($event->email)->send(new EventEnds($event));
        }
    }
}

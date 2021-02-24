<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Project;

class ProjectChanged extends Mailable
{
    use Queueable, SerializesModels;

    // A levélhez fontos adatokat ide tároljuk
    public $changedData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     // A konstruktornak át tudunk adni adatot, amit kitesz egy public attribútumba.
     // Azt utána eléri a view, és fel tudjuk tölteni a levelet adattal
    public function __construct(Project $project)
    {
        //
        $this->changedData = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@welover.hu')
                    ->view('emails.project.changed');

        // return $this->view('view.name');
    }
}

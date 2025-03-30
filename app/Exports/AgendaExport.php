<?php

namespace App\Exports;

use App\Models\Agenda;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgendaExport implements FromView
{
    protected $agenda;

    public function __construct($agendaId)
    {
        $this->agenda = Agenda::with('agendaDetails')->findOrFail($agendaId);
    }

    public function view(): View
    {
        // $agenda = $this->agenda;
        // $records = $agenda->agendaDetails->groupBy('jenis_nama');

        // return view('exports.agenda_details', compact('agenda', 'records'));
        return view('exports.agenda_details', [
            'agenda' => $this->agenda,
            'records' => $this->agenda->agendaDetails->groupBy('agendaJenis.name'),
        ]);
    }
}

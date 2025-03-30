<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Exports\AgendaExport;
use App\Exports\HasilRapatExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportExcel($id)
    {
        $agenda = Agenda::findOrFail($id);
        $filename = 'Agenda_rapat_' . Carbon::parse($agenda->tgl_rapat)->format('Y-m-d') . '.xlsx';

        return Excel::download(new AgendaExport($id), $filename);
    }

    public function exportPlenoExcel($id)
    {
        $agenda = Agenda::findOrFail($id);
        $filename = 'Hasil_rapat_' . Carbon::parse($agenda->tgl_rapat)->format('Y-m-d') . '.xlsx';

        return Excel::download(new HasilRapatExport($id), $filename);
    }
}

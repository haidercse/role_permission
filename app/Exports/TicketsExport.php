<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
// use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TicketsExport implements
         FromView,
        ShouldAutoSize,
        WithHeadings,
        WithEvents,
        WithMapping
        //FromQuery
{
    use Exportable;
    /**
    *  @return view ticket
    *  if data is less than 1000 then we use this method !
    *
    */

    public function view():View
    {
        return view('pages.ticket.internal.index',[
            'tickets' => Ticket::all(),
            'products' => Product::all(),
            'users' => User::all(),
        ]);

    }
    // public function query()
    // {
    //     return Ticket::query()->with(['product','status','user']);
    // }
    public function map($user): array
    {
        return[
            $user->product->name,
            $user->ticket_code ,
            $user->title,
            $user->status->name,
            $user->ticket_number,
            $user->user->name
        ];
    }

    public function headings(): array
    {
        return [
            'Product Name',
            'Ticket Id',
            'Title',
            'Status',
            'Issu Number',
            'Assigine To',

        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            }
        ];
    }
}

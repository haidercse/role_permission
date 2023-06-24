<?php

namespace App\Http\Controllers\Report;

use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketReportController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
              $this->user = Auth::guard('web')->user();
              return $next($request);
        });
    }
    public function index(Request $request)
    {
        if (!$this->user->hasPermissionTo('report.list') ) {
            return abort(403, 'Unauthoeized access to delete this!');

        }
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'client');
        })->get();

        $products = Product::all();
        $statuses = Status::all();

        return view('pages.report.ticket.index', compact('products', 'users', 'statuses'));
    }
    public function ticket_index_new(Request $request)
    {
        if (!$this->user->hasPermissionTo('report.list') ) {
            return abort(403, 'Unauthoeized !');

        }
        
        $last_month = "";
        $current_month = "";
        if($request->month_id == 1){
            $current_month = 1;
           // dd('1');
        }elseif($request->month_id == 2){
            $last_month = 1;
            //dd('2');
        }

        $tickets = Ticket::with([
            'product',
            'status',
            'user'
        ])
            ->when($request->product_id, function ($query) use ($request) {
            return $query->where('product_id', $request->product_id);
        })
            ->when($request->date, function ($query) use ($request) {
            return $query->where('raising_date', $request->date);
        })
            ->when($request->user_id, function ($query) use ($request) {
            return $query->where('tickets.user_id', $request->user_id);
        })
            ->when($request->ticket_code, function ($query) use ($request) {
            return $query->where('ticket_code', $request->ticket_code);
        })
            ->when($request->status_id, function ($query) use ($request) {
            return $query->where('status_id', $request->status_id);
        })
            ->when($current_month, function ($query) use ($request) {
              //  dd('cur');
            return $query->whereYear('created_at', Carbon::now()->year)
                         ->whereMonth('created_at', Carbon::now()->month);
                          //current month
        })
        ->when($last_month, function ($query) use ($request) {
           // dd('last');
            return $query->whereMonth('created_at',  Carbon::now()->startOfMonth()->subMonth(1)); //last month
        })
            ->orderBy('id', 'asc')
            ->select(
            'tickets.*'
        )
        ->orderBy('id','desc')
        ->get();

        $result = DataTables::of($tickets)

            ->addIndexColumn()

            ->addColumn('product_name', function ($row) {
            return $row->product->short_name;
        })
            ->addColumn('_ticket_code', function ($row) {
            return $row->ticket_code;
        })
            ->addColumn('_title', function ($row) {
               return Str::limit($row->title, 50);

        })
            ->addColumn('_raising_date', function ($row) {
            return $row->raising_date;
        })
            ->addColumn('status', function ($row) {
            return $row->status->name;
        })
            ->addColumn('_issue_number', function ($row) {
            return $row->ticket_number;
        })
            ->addColumn('assigine_to', function ($row) {
            return $row->user->name;
        })
        // ->rawColumns([''])
        ->make(true);


        return $result;

    }



}

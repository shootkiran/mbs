<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Log;
use App\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Collection;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->user()->staff) {
            return redirect('/');
        }
        $exam_id = request()->exam_id??null;
        $examination = $exam_id ? Examination::findorfail($exam_id) : Examination::where('available', 1)->first();
        $collections = $examination->Collections;
        $level5_total = $examination->Collections()->sum('level5');
        $level4_total = $examination->Collections()->sum('level4');
        $level3_total = $examination->Collections()->sum('level3');
        $level2_total = $examination->Collections()->sum('level2');
        $level1_total = $examination->Collections()->sum('level1');
        $students_total = $examination->Collections()->sum('students_count');
        $amount_total = $examination->Collections()->sum('amount_received');
        return view('collection.index', compact('collections', 'level1_total', 'level2_total', 'level3_total', 'level4_total', 'level5_total', 'amount_total', 'students_total','examination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->user()->staff) {
            return redirect('/');
        }
        $last_id = Collection::where('collected_by', request()->user()->id)->orderby('id', 'DESC')->first();
        $last_id = $last_id ? $last_id->id : 0;
        return view('collection.create', compact('last_id'));
    }

    public function createSingle()
    {
        if (!request()->user()->staff) {
            return redirect('/');
        }
        $last_id = Collection::where('collected_by', request()->user()->id)->orderby('id', 'DESC')->first();
        $last_id = $last_id ? $last_id->id : 0;
        return view('collection.createSingle', compact('last_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'students_count' => 'gt:0',
            'amount_received' => 'gt:0'
        ]);
        $examination = Examination::where('available', 1)->first();
        $cln = new Collection();
        $cln->datetime = Carbon::now('Asia/Kathmandu');
        $cln->name = strtoupper($request->name);
        $cln->examination_id = $examination->id;
        $cln->contact = $request->contact;
        $cln->level5 = $request->level5;
        $cln->level4 = $request->level4;
        $cln->level3 = $request->level3;
        $cln->level2 = $request->level2;
        $cln->level1 = $request->level1;
        $cln->students_count = $request->students_count;
        $cln->amount_received = $request->amount_received;
        $cln->collected_by = $request->user()->id;
        $cln->collection_id = Collection::where('examination_id', $examination->id)->max('collection_id') + 1;
        $cln->save();
        //Print this
        echo redirect()->route('collection.show', $cln->id);
    }

    public function storeSingle(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'amount_received' => 'gt:0',
            'dobad' => 'required|date|after:1900-01-01'
        ]);
        //create collection single
        $examination = Examination::where('available', 1)->first();
        $cln = new Collection();
        $cln->datetime = Carbon::now('Asia/Kathmandu');
        $cln->name = strtoupper($request->name);
        $cln->contact = $request->contact;
        $level = $request->level;
        $cln->collection_id = Collection::where('examination_id', $examination->id)->max('collection_id') + 1;
        $cln->level5 = $level == 5 ? 1 : 0;
        $cln->level4 = $level == 4 ? 1 : 0;
        $cln->level3 = $level == 3 ? 1 : 0;
        $cln->level2 = $level == 2 ? 1 : 0;
        $cln->level1 = $level == 1 ? 1 : 0;
        $cln->students_count = 1;
        $cln->amount_received = $request->amount_received;
        $cln->examination_id = $examination->id;
        $cln->collected_by = $request->user()->id;
        //  dd($cln);
        $cln->save();
        //store registration also
        $rc = new RegistrationController();
        $rc->storeOneRegistration($cln->id, $cln->name, $request->dobad, $request->level);
        //Print this
        echo redirect()->route('collection.show', $cln->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        $exam_id = request()->exam_id??null;
        $examination = $exam_id ? Examination::findorfail($exam_id) : Examination::where('available', 1)->first();
        $generator = new BarcodeGeneratorSVG();
        $regid = $collection->regid();
        $bc = $generator->getBarcode($regid, $generator::TYPE_CODE_128);
        $exam_date = Carbon::parse($examination->exam_date);
        return view('collection.show', compact('collection', 'regid', 'bc', 'examination', 'exam_date'));
    }

    public function refunded()
    {
        if (!request()->user()->staff) {
            return redirect('/');
        }
        $exam_id = request()->exam_id??null;
        $examination = $exam_id ? Examination::findorfail($exam_id) : Examination::where('available', 1)->first();
        $collections = $examination->Collections()->where('refunded', 1)->get();
        $level5_total = $examination->Collections()->where('refunded', 1)->sum('level5');
        $level4_total = $examination->Collections()->where('refunded', 1)->sum('level4');
        $level3_total = $examination->Collections()->where('refunded', 1)->sum('level3');
        $level2_total = $examination->Collections()->where('refunded', 1)->sum('level2');
        $level1_total = $examination->Collections()->where('refunded', 1)->sum('level1');
        $students_total = $examination->Collections()->where('refunded', 1)->sum('students_count');
        $amount_total = $examination->Collections()->where('refunded', 1)->sum('amount_received');
        return view('collection.index', compact('collections', 'level1_total', 'level2_total', 'level3_total', 'level4_total', 'level5_total', 'amount_total', 'students_total','examination'));
    }

    public function sync()
    {

    }

    public function refund($id)
    {
        $collection = Collection::find($id);
        $collection->refunded = 1;
        $collection->save();
        Log::create(['activity' => "Collection Refunded",
            'collection_id' => $id]);
        return redirect()->back()->withErrors("Refunded Successfully");
    }

    public function edit(Collection $collection)
    {

        return view('collection.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $regs = $collection->registration;

        foreach ($regs as $reg) {
            //destroy all in levels;
            //level 5
            DB::table('level5')->where('reg_id', $reg->id)->delete();
            //level 4
            DB::table('level4')->where('reg_id', $reg->id)->delete();
            //level 3
            DB::table('level3')->where('reg_id', $reg->id)->delete();
            //level 2
            DB::table('level2')->where('reg_id', $reg->id)->delete();
            //level 1
            DB::table('level1')->where('reg_id', $reg->id)->delete();
            //destroy all registrations;
            $reg->delete();
        }
        //destroy collection;
        $collection->delete();
        return redirect()->route('collection.index');
    }

    public function search(Request $request)
    {
        //dd($request);
        $request->validate([
            'keyword' => 'required',
        ]);
        $keyword = $request->keyword;
        $collections = Collection::where('id', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->orWhere('contact', 'LIKE', "$keyword")->get();
        return view('collection.search', compact('collections', 'keyword'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Models\Examination;
use App\Level5;
use App\Log;
use App\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createFromCollection($collection_id)
    {
        $collection = Collection::findorfail($collection_id);
        if ($collection->students_count == 1) {
            //single form
            return view('registration.createFromCollection', compact('collection'));
        } else {
            return view('registration.createFromCollectionGroup', compact('collection'));
        }
        return redirect('home');

    }

    public function ajaxRegistration()
    {
        $request = request();
        $collection_id = $request->collection_id;

        //  dd($collection_id);
        $reg = $this->storeOneRegistration($collection_id, $request->name, $request->dobad, $request->level);
        $collection = Collection::find($collection_id);
        $count = $collection->registration()->count();
        $table = $this->ajaxRegistrationTable($collection_id);
        $return_array = [
            'table' => $table,
            'count' => $count
        ];

        return $return_array;
    }

    public function ajaxRegistrationTable($collection_id)
    {
        $collection = Collection::findorfail($collection_id);
        $regs = $collection->registration;
        $tbl = "";
        foreach ($regs as $reg) {
            $tbl .= "<tr>";
            $tbl .= "<td>$reg->reg_number</td>";
            $tbl .= "<td>$reg->name</td>";
            $tbl .= "<td>$reg->dobad</td>";
            $tbl .= "<td>$reg->level</td>";
            $tbl .= "</tr>";
        }
        return $tbl;
    }

    public function getData($level)
    {
        $examination = Examination::where('available', 1)->first();
        $regs = $examination->Registrations()->where('level', $level)->orderby('reg_number', 'ASC')->get();
        echo "<table width=100% border=1>";
        $sn = 1;
        foreach ($regs as $reg) {
            echo "<tr>";
            echo "<td>$sn</td>";
            echo "<td>" . $reg->reg_number . '</td>';
            echo "<td>" . $reg->name . '</td>';
            echo "<td>" . $reg->dobad . '</td>';
            echo "</tr>";
            $sn++;
        }
        echo "</table>";
    }

    public function storeOneRegistration($collection_id, $name, $dobad, $level, $user_id = null, $contact = null, $dummy = 0)
    {
        $collection = $collection_id ? Collection::findorfail($collection_id) : [];
        $examination = Examination::where('available', 1)->first();
        $level_table = 'level' . $level;
        $l = $examination->$level_table();

        $now = Carbon::now();
        $empty_row = DB::table($level_table)->where('examination_id', $examination->id)->where('reg_id', 0)->first();
        $next_sn = $empty_row->id??DB::table($level_table)->where('examination_id', $examination->id)->max('sn') + 1;
        $reg_number = $level . "50" . sprintf("%04d", $next_sn);

        $reg = new Registration();
        $reg->name = $name;
        $reg->dobad = $dobad;
        $reg->level = $level;
        $reg->reg_number = $reg_number;
        $reg->examination_id = $examination->id;
        $reg->payment_received = 1;//being collected at office
        $reg->created_at = $now;
        $reg->updated_at = $now;
        $reg->user_id = $user_id;
        $reg->collection_id = $collection_id;
        $reg->dummy = $dummy;
        $reg->save();
        //Store in Level Table

        if ($empty_row) {
            DB::table($level_table)->where('examination_id', $examination->id)->update([
                'reg_id' => $reg->id
            ]);
        } else {
            DB::table($level_table)->insert([
                'examination_id' => $examination->id,
                'reg_id' => $reg->id,
                'sn' => $next_sn]);

        }
        return $reg;
    }

    public function storeFromSingleCollection(Request $request, $collection_id)
    {
        $collection = Collection::findorfail($collection_id);

        $name = $request->name;
        $dobad = $request->dobad;
        $level = $request->level;
        $this->storeOneRegistration("$collection_id", $name, $dobad, $level);
        return redirect()->to('/collection');
    }

    public function getLevel($level)
    {
        $examination = Examination::where('available', 1)->first();

        if (Auth::user()->staff) {
            $registrations = $examination->registrations()->where('level', $level)->get();
            $dummy_count = $examination->registrations()->where('dummy', 1)->count();
//            dd($registrations);
            return view('registration.index', compact('registrations', 'dummy_count'));
        } else {
            return redirect('home');
        }
    }

    public function index()
    {

        $examination = Examination::where('available', 1)->first();

        if (Auth::user()->staff) {
            $registrations = $examination->registrations;
            $dummy_count = $examination->registrations()->where('dummy', 1)->count();
//            dd($registrations);
            return view('registration.index', compact('registrations', 'dummy_count'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $regs = Registration::where('examination_id',6)->where('level',5)->get();
        $examination = Examination::find(6);
        foreach($regs as $registration){

            echo "Level not equal";
            //delete level table data
            $old_level = $registration->level;
            $new_level = $old_level;
            $old_level_table = "level" . $old_level;
            DB::table($old_level_table)->where('examination_id', $examination->id)->where('reg_id', $registration->id)->update(['reg_id' => 0]);
            $level_table = 'level' . $new_level;
            $empty_row = DB::table($level_table)->where('examination_id', $examination->id)->where('reg_id', 0)->first();
            if ($empty_row) {
                $next = $empty_row->sn;
                $update_level = true;
            } else {
                $next = DB::table($level_table)->where('examination_id', $examination->id)->max('sn') + 1;
                $update_level = false;
            }
            //create new level reg
            if ($update_level) {
                DB::table($level_table)->where('examination_id', $examination->id)->where('sn', $next)->update([
                    'reg_id' => $registration->id,
                ]);
            } else {
                DB::table($level_table)->insert(['reg_id' => $registration->id, 'sn' => $next, 'examination_id' => $examination->id]);

            }
            // update reg number
            $reg_number = $new_level . "50" . sprintf("%04d", $next);
            $registration->reg_number = $reg_number;
            $registration->level = $new_level;
            $registration->save();

        }
      //  die('not is use');

    }

    public function store(Request $request)
    {
        die('not in use');
    }

    /**
     * Display the specified resource.
     *
     * @param Registration $registration
     *
     * @return Response
     */
    public function show(Registration $registration)
    {
        dump($registration);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Registration $registration
     *
     * @return Response
     */
    public function edit(Registration $registration)
    {
        return view('registration.edit', compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Registration $registration
     *
     * @return Response
     */
    public function update(Request $request, Registration $registration)
    {
        $examination = Examination::where('available', 1)->first();
        $request->validate([
            'name' => 'required',
            'level' => 'gt:0',
            'dobad' => 'required|date'
        ]);
        $registration->dummy = 0;
        $registration->save();
        if ($request->name != $registration->name) {
            $registration->name = strtoupper($request->name);
            $registration->save();
            // save name

            //save log
        }
        if ($request->dobad != $registration->dobad) {
            $registration->dobad = $request->dobad;
            $registration->save();
            // save name

            //save log
        }
        if ($request->level != $registration->level) {
            echo "Level not equal";
            //delete level table data
            $old_level = $registration->level;
            $new_level = $request->level;
            $old_level_table = "level" . $old_level;
            DB::table($old_level_table)->where('examination_id', $examination->id)->where('reg_id', $registration->id)->update(['reg_id' => 0]);
            $level_table = 'level' . $new_level;
            $empty_row = DB::table($level_table)->where('examination_id', $examination->id)->where('reg_id', 0)->first();
            if ($empty_row) {
                $next = $empty_row->sn;
                $update_level = true;
            } else {
                $next = DB::table($level_table)->where('examination_id', $examination->id)->max('sn') + 1;
                $update_level = false;
            }
            //create new level reg
            if ($update_level) {
                DB::table($level_table)->where('examination_id', $examination->id)->where('sn', $next)->update([
                    'reg_id' => $registration->id,
                ]);
            } else {
                DB::table($level_table)->insert(['reg_id' => $registration->id, 'sn' => $next, 'examination_id' => $examination->id]);

            }
            // update reg number
            $reg_number = $new_level . "50" . sprintf("%04d", $next);
            $registration->reg_number = $reg_number;
            $registration->level = $new_level;
            $registration->save();

            //save log
            Log::create(['activity' => "Level Changed from $old_level to $new_level",
                'registration_id' => $registration->id]);
        }
        return redirect()->route('collection.edit', $registration->collection_id)->withErrors("Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Registration $registration
     *
     * @return Response
     */
    public function destroy(Registration $registration)
    {
        //dd($registration);
        //delete from label table
        $level_table = 'level' . $registration->level;
        DB::table($level_table)->where('reg_id', $registration->id)->update(['reg_id' => 0]);
        //delete from registration
        $registration->delete();
        return redirect()->route('registration.index');
    }

    public function dummy($collection_id)
    {
        $collection = Collection::findorfail($collection_id);
        if ($collection->registration()->count() == 0) {
            $level5_count = $collection->level5;
            $level4_count = $collection->level4;
            $level3_count = $collection->level3;
            $level2_count = $collection->level2;
            $level1_count = $collection->level1;
            if ($level5_count) {
                $i = 1;
                while ($i <= $level5_count) {
                    $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "5", null, null, 1);
                    $i++;
                }
            }
            if ($level4_count) {
                $i = 1;
                while ($i <= $level4_count) {
                    $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "4", null, null, 1);
                    $i++;
                }
            }
            if ($level3_count) {
                $i = 1;
                while ($i <= $level3_count) {
                    $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "3", null, null, 1);
                    $i++;
                }
            }
            if ($level2_count) {
                $i = 1;
                while ($i <= $level2_count) {
                    $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "2", null, null, 1);
                    $i++;
                }
            }
            if ($level1_count) {
                $i = 1;
                while ($i <= $level1_count) {
                    $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "1", null, null, 1);
                    $i++;
                }
            }
            return redirect()->route('collection.edit', $collection_id)->withErrors("Dummy Created SuccessFully");
        } else {
            $reg_count = $collection->registration()->count();
            $std_count = $collection->students_count;
            $diff = $std_count - $reg_count;
            $i = 1;
            while ($i <= $diff) {
                $this->storeOneRegistration("$collection_id", "$collection->name", "1800-01-01", "1", null, null, 1);
                $i++;
            }
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);
        $keyword = $request->keyword;
        $registrations = Registration::where('id', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->orWhere('reg_number', 'LIKE', "%$keyword%")
            ->orWhere('admission_number', 'LIKE', "%$keyword%")->get();
        return view('registration.search', compact('registrations', 'keyword'));
    }

    public function temp()
    {
        $temps = DB::table('temp')->get();
        foreach ($temps as $temp) {
            $d = Carbon::parse($temp->dob)->toDateString();
            //dd($d);
            $na = $temp->na;
            $r = Registration::where('name', $na)->where('dobad', $d)->where('level', $temp->lv)->get();
            if ($r->count() == 1) {
                $one = Registration::where('name', $na)->where('dobad', $d)->where('level', $temp->lv)->first();
                $one->admission_number = $temp->ad;
                $one->save();
            } elseif ($r->count() > 1) {
                echo $na . " has more than 1";
            } else {
                //not found try first name
                $firstname = explode(" ", $temp->na)[0];
                $r2 = Registration::where('name', 'like', "%$firstname%")->where('dobad', $d)->where('level', $temp->lv)->get();
                if ($r2->count() == 1) {
                    $one2 = Registration::where('name', 'like', "%$firstname%")->where('dobad', $d)->where('level', $temp->lv)->first();
                    $one2->admission_number = $temp->ad;
                    $one2->save();
                } elseif ($r2->count() > 1) {
                    echo $na . " has more than 1";
                } else {
                    echo "<table width='100%' border='1'>";
                    echo "<tr><td>$na</td><td>" . $temp->lv . "</td><td>$d</td><td>" . $temp->ad . "</td></tr>";
                    echo "</table>";
                }
            }
            /*
            $d = $temp->dob;
            $x = 1;
            $y = (int)substr($d, 0);
            if (is_int($y)) {
                $len = strlen($y);
                $newdate = substr($d, $len);
                DB::table('temp')->where('ad', $temp->ad)->update(['dob' => $newdate]);
            }*/
            /*$registrations = Registration::all();
            foreach($registrations as $registration){
                $first_name = explode(" ",$registration->name)[0];
                $temp = DB::table('temp')->where("na","LIKE",$first_name)->get();
                if($temp){}*/
        }
    }

    public function ajaxUpdate(Request $request)
    {
        $request->validate([
            'registration_id' => 'required',
            'name' => 'required',
            'level' => 'gt:0',
            'dobad' => 'required|date|after:1900-01-01'
        ]);
        $status = ['status' => 'unchanged'];
        $registration = Registration::find($request->registration_id);
        if ($request->name != $registration->name) {
            $registration->name = strtoupper($request->name);
            $registration->save();
            $status = ['status' => 'changed'];
            // save name

            //save log
        }
        if ($request->dobad != $registration->dobad) {
            $registration->dobad = $request->dobad;
            $registration->save();
            $status = ['status' => 'changed'];
            // save name

            //save log
        }

        return json_encode($status);
    }
}

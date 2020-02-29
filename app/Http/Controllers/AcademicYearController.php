<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{
    // get All Session
    public function index()
    {
        $academicyr = AcademicYear::where('domain','TS')->orderBy('id', 'DESC')->get()->toArray();
        return array_reverse($academicyr);
    }

    // Save and Update Session
    public function store(Request $request)
    {           
        if($request->input('id') == "")
        {          
            //Save  
            return $this->SaveSession($request);
        }
        else
        {
            //Update
            return $this->UpdateSession($request);
        }
    }

    public function SaveSession($request){
        $check = AcademicYear::where('session', $request->input('session'))->where('domain', 'TS')->get()->count();
        if ($check > 0)
        {
            $checkActive = AcademicYear::where('session', $request->input('session'))->where('domain', 'TS')->get();
            if($checkActive[0]->is_active == 'delete')
            {
                //Save Update is_active
                $checkActive[0]->is_active = "no";
                $checkActive[0]->save(); 
                return response()->json(['text' => 'Session added successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Session already exists', 'type' => 'error']);
        }
        else
        {
            $checkisActive = AcademicYear::where('is_active', 'yes')->where('domain','TS')->get()->count();            
            if($checkisActive === 0){
                // Save
                $academicyr = new AcademicYear([
                    'session' => $request->input('session'),
                    'is_active' => 'yes',
                    'domain' => 'TS'
                ]);        
                $academicyr->save();
            }
            else
            {
                // Save
                $academicyr = new AcademicYear([
                    'session' => $request->input('session'),
                    'is_active' => 'no',
                    'domain' => 'TS'
                ]);        
                $academicyr->save();
            }
            return response()->json(['text' => 'Session added successfully', 'type' => 'success']);
        }
    }

    public function UpdateSession($request){
        $check = AcademicYear::where('session', $request->input('session'))->where('domain', 'TS')->get()->count();
        if ($check > 0)
        {
            $checkSession = AcademicYear::where('session', $request->input('session'))->where('domain', 'TS')->get();                
            $Session = AcademicYear::where('id', $request->input('id'))->where('domain', 'TS')->get();
            for( $i = 0; $i < count($checkSession); $i++){                
                $a = 0;
                if($checkSession[$i]->is_active == "delete") $a = 1;
            }
            if($a == 1 || $Session[0]->session == $request->input('session'))
            {
                $Session[0]->session = $request->input('session');
                $Session[0]->is_active = "no";
                $Session[0]->save();               
                return response()->json(['text' => 'Session updated successfully', 'type' => 'success']);
            }
            else        return response()->json(['text' => 'Session already exists', 'type' => 'error']);
        }
        else
        {
            $academicyr = AcademicYear::find($request->input('id'));
            $academicyr->update($request->all());                
            return response()->json(['text' => 'Session updated successfully', 'type' => 'success']);
        }
    }

    public function edit($id)
    {        
        $academicyr = AcademicYear::find($id);
        return response()->json($academicyr);
    }

    public function update(Request $request)
    {        
        $updateOldSession = AcademicYear::find($request->input('oldid'));
        $updateOldSession->is_active = "no";
        $updateOldSession->save();

        $updateSession = AcademicYear::find($request->input('updateid'));
        $updateSession->is_active = "yes";
        $updateSession->save();

        return response()->json(['text' => 'Session updated successfully', 'type' => 'success']);
    }

    // Delete Session
    public function destroy($id)
    {
        // $aaaa = DB::table('academic_years as aca_yrs')
        //             ->select("aca_yrs.id", "c.session_id", "cs.session_id")
        //             ->join("classes AS c", "aca_yrs.id", "=", "c.session_id")
        //             ->join("class_sections AS cs", "aca_yrs.id", "=", "cs.session_id")
        //             ->join("subjects AS sub", "aca_yrs.id", "=", "sub.session_id")
        //             ->where("aca_yrs", "=", $id)->get();
        // $aaaa = DB::select("SELECT aca_yrs.id FROM academic_years aca_yrs INNER JOIN class_sections cs ON aca_yrs.id = cs.session_id INNER JOIN classes c ON aca_yrs.id = c.session_id INNER JOIN sections s ON aca_yrs.id = s.session_id WHERE aca_yrs.id = ? AND aca_yrs.domain = 'TS' AND cs.domain = 'TS'", [$id]);

        // $aaaa = DB::select("SELECT COUNT(*) totalRecord FROM (SELECT aca_yrs.id FROM academic_years aca_yrs INNER JOIN class_sections cs ON aca_yrs.id = cs.session_id INNER JOIN classes c ON aca_yrs.id = c.session_id INNER JOIN sections s ON aca_yrs.id = s.session_id  INNER JOIN subjects sub ON aca_yrs.id = sub.session_id WHERE aca_yrs.id = ? AND aca_yrs.domain = 'TS' AND cs.domain = 'TS') result", [$id]);
        // INNER JOIN assignclassteachers asscTeach ON	aca_yrs.id = asscTeach.session_id

        // print_r($aaaa[0]->totalRecord);

        $academicyr = AcademicYear::find($id);
        $academicyr->is_active = "delete";
        $academicyr->save();
        
        return response()->json(['text' => 'Session deleted successfully', 'type' => 'success']);
    }
}

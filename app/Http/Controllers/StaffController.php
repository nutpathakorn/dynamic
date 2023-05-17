<?php
namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $staff = new Staff;
            $staff->staff_id = $request->input('staff_id');
            $staff->staff_name = $request->input('staff_name');
            $staff->staff_dept_id = $request->input('staff_dept_id');
            $staff->staff_dept_name = $request->input('staff_dept_name');
            $staff->staff_addr = $request->input('staff_addr');
            $staff->staff_rd = $request->input('staff_rd');
            $staff->staff_dist = $request->input('staff_dist');
            $staff->staff_prov = $request->input('staff_prov');
            $staff->staff_subd = $request->input('staff_subd');
            $staff->staff_post = $request->input('staff_post');
            $staff->staff_phon = $request->input('staff_phon');
            $staff->staff_mobi = $request->input('staff_mobi');
            $staff->staff_mail = $request->input('staff_mail');
            $staff->save();

            DB::commit();

            //return redirect()->route('companies.index')->with('success', 'staff added successfully');
            return response()->json(['msg' => 'ok']);

        } catch (\Exception $e) {
            DB::rollBack();

            //return redirect()->route('companies.index')->with('error', 'Failed to add staff: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    

    public function getStaffMas(Request $request)
    {

        try {
            $results = DB::select('CALL db_bright.stp_search_staff_mas(?,?);',[
                $request->input('basket_id'),
                $request->input('basket_group_id')
            ]);
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    } 

    public function getStaffAll(Request $request)
    {

        try {
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_staff_all(?, ?, ?);', [
                $start,
                $length,
                $searchTerm
            ]);

            $totalRecords = DB::select('SELECT @total_records AS total_records')[0]->total_records;
            $filteredRecords = DB::select('SELECT @filtered_records AS filtered_records')[0]->filtered_records;

            return response()->json([
                'data' => $results,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function insStaffMas(Request $request)
    {
        try {     
                $results = DB::select('CALL db_bright.stp_master_basket_staff_ins(?, ?, ?, ?);', [
                    $request->input('basket_id'),
                    $request->input('basket_group_id'),
                    $request->input('value'),
                    $request->input('text')
                ]);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


}
<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

use GuzzleHttp\Client;

class BackendController extends Controller
{
    public function insMasterBasket(Request $request)
    {
        try {
            $basket_name = $request->input('basket_name');
            $basket_province_id = (int) $request->input('basket_province_id');
            $basket_district_id = (int) $request->input('basket_district_id');
            $basket_sub_district_id = (int) $request->input('basket_sub_district_id');
            $basket_province = $request->input('basket_province');
            $basket_district = $request->input('basket_district');
            $basket_sub_district = $request->input('basket_sub_district');

            $results = DB::select('CALL db_bright.stp_master_basket_ins(?,?,?,?,?,?,?);', [
                $basket_name,
                $basket_province_id,
                $basket_district_id,
                $basket_sub_district_id,
                $basket_province,
                $basket_district,
                $basket_sub_district
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getMasterBasketCompany(Request $request)
    {

        try {
            $company_owner_id = $request->input('company_owner_id');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_master_basket_companies(?, ?, ?, ?);', [
                $company_owner_id,
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

 
    public function updateJobStatusBSJ(Request $request)
    {
        try {

            $company_user_cid = $request->input('company_user_cid');
            $company_owner_id = $request->input('company_owner_id');
            $basket_id = $request->input('basket_id');
            $basket_name = $request->input('basket_name');
            $staff_id = $request->input('staff_id');
            $staff_name = $request->input('staff_name');
            $job_status = $request->input('job_status');
            $job_status_name = $request->input('job_status_name');

            $results = DB::select('CALL db_bright.stp_job_master_update(?,?,?,?,?,?,?,?);', [
                $company_user_cid,
                $company_owner_id,
                $basket_id,
                $basket_name,
                $staff_id,
                $staff_name,
                $job_status,
                $job_status_name
            ]);

            return response()->json([
                'data' => $results
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getJobStatusAll()
    {
        try {

            $results = DB::select('CALL db_bright.stp_search_job_status_all();');

            return response()->json([
                'data' => $results
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getMasterBasketAll()
    {
        try {

            $results = DB::select('CALL db_bright.stp_search_master_basket_all();');

            return response()->json([
                'data' => $results
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
 
    public function getMasterBasket(Request $request)
    {

        try {
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];
            $job_start_date = $request->input('job_start_date');

            $results = DB::select('CALL db_bright.stp_search_master_basket(?, ?, ?, ?);', [
                $start,
                $length,
                $searchTerm,
                $job_start_date
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

    public function delMasterBasket(Request $request)
    {

        try {
            $id = (int) $request->input('id');
            $results = DB::select('CALL db_bright.stp_delete_master_basket(?);', [
                $id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    } 

    public function updateBasketCompany(Request $request)
    {
        try {
            $results = DB::select('CALL db_bright.stp_update_basket_companies(?,?,?,?,?);', [
                $request->input('company_owner_id'),
                $request->input('company_user_id'),
                $request->input('basket_id'),
                $request->input('basket_name'),
                $request->input('addr_type')
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);     
        }
    }
    
    public function updateMasterBasket(Request $request)
    {

        try {
            $results = DB::select('CALL db_bright.stp_master_bucket_update(?,?,?,?,?,?,?,?);', [
                $request->input('id'),
                $request->input('basket_name'),
                $request->input('basket_province_id'),
                $request->input('basket_district_id'),
                $request->input('basket_sub_district_id'),
                $request->input('basket_province'),
                $request->input('basket_district'),
                $request->input('basket_sub_district')
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getMasterBasketId(Request $request)
    {

        try {
            $id = (int) $request->input('id');
            $results = DB::select('CALL db_bright.stp_search_master_basket_id(?);', [
                $id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getMasterBasketStaffId(Request $request)
    {

        try {
            $basket_id = (int) $request->input('basket_id');
            $basket_group_id = (int) $request->input('basket_group_id');
            $results = DB::select('CALL db_bright.stp_search_master_basket_staff_id(?, ?);', [
                $basket_id,
                $basket_group_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }
    
    public function deleteMasterBasketStaffId(Request $request)
    {

        try {
            $basket_id = (int) $request->input('basket_id');
            $basket_group_id = (int) $request->input('basket_group_id');
            $results = DB::select('CALL db_bright.stp_delete_master_basket_staff(?,?);', [
                $basket_id,
                $basket_group_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    } 
      
}
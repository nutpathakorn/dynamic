<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

use GuzzleHttp\Client;

// Open extension=gd in php.ini
// composer remove phpoffice/phpexcel
// composer require phpoffice/phpspreadsheet
// composer require google/cloud-language

class CompanyController extends Controller
{
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $company = new Company;
            $company->user_id = $request->input('user_id');
            $company->company_id = $request->input('company_id');
            $company->company_name = $request->input('company_name');
            $company->company_addr = $request->input('company_addr');
            $company->company_rd = $request->input('company_rd');
            $company->company_dist = $request->input('company_dist');
            $company->company_prov = $request->input('company_prov');
            $company->company_subd = $request->input('company_subd');
            $company->company_post = $request->input('company_post');
            $company->company_phon = $request->input('company_phon');
            $company->company_mobi = $request->input('company_mobi');
            $company->company_mail = $request->input('company_mail');
            $company->save();

            DB::commit();

            //return redirect()->route('companies.index')->with('success', 'Company added successfully');
            return response()->json(['msg' => 'ok']);

        } catch (\Exception $e) {
            DB::rollBack();

            //return redirect()->route('companies.index')->with('error', 'Failed to add company: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getCustomerId(Request $request)
    {

        try {
            $results = DB::select('CALL db_bright.stp_search_custid(?);', [
                $request->input('cus_id')
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function checkCompanyUserId(Request $request)
    {

        try {
            $company_user_cid = $request->input('company_user_cid');
            $company_owner_id = $request->input('company_owner_id');
            $results = DB::select('CALL db_bright.stp_check_companies_user_id(?,?);', [
                $company_user_cid,
                $company_owner_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getCompanyAll(Request $request)
    {

        try {
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_companies(?, ?, ?);', [
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


    public function getCompanyUser(Request $request)
    {

        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_companies_user(?, ?, ?, ?);', [
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

    public function updateJobStatus(Request $request)
    {

        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $company_user_cid = (int) $request->input('company_user_cid');
            $job_status = (int) $request->input('job_status');
            $job_status_name = $request->input('job_status_name');

            $results = DB::select('CALL db_bright.stp_update_job_status(?,?,?,?);', [
                $company_owner_id,
                $company_user_cid,
                $job_status,
                $job_status_name
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getJobMasterAll(Request $request)
    {
        try {
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_job_master_all(?, ?, ?);', [
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

    public function getJobMaster(Request $request)
    {
        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_job_master(?, ?, ?, ?);', [
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

    public function getJobMasterByDateAll(Request $request)
    {
        try {
            $job_start_date = $request->input('job_start_date');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_job_master_by_date_all(?, ?, ?, ?);', [
                $job_start_date,
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


    public function getJobMasterByDate(Request $request)
    {
        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $job_start_date = $request->input('job_start_date');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_job_master_by_date(?, ?, ?, ?, ?);', [
                $company_owner_id,
                $job_start_date,
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

    public function getJobMasterByBetweenDate(Request $request)
    {
        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $job_start_date = $request->input('job_start_date');
            $job_end_date = $request->input('job_end_date');
            $start = (int) $request->input('start');
            $length = (int) $request->input('length');
            $searchTerm = $request->input('search')['value'];

            $results = DB::select('CALL db_bright.stp_search_job_master_by_between_date(?, ?, ?, ?, ?, ?);', [
                $company_owner_id,
                $job_start_date,
                $job_end_date,
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


    

    public function getCompanyUserById(Request $request)
    {

        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $company_user_id = (int) $request->input('company_user_id');
            $results = DB::select('CALL db_bright.stp_edit_companies_user_id(?,?);', [
                $company_owner_id,
                $company_user_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function getCompanyOwnerId(Request $request)
    {
        try {
            $company_id = $request->input('company_id');
            $results = DB::select('CALL db_bright.stp_search_companies_owner_id(?);', [
                $company_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }

    public function delCompanyUser(Request $request)
    {

        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $company_user_id = (int) $request->input('company_user_id');
            $results = DB::select('CALL db_bright.stp_delete_companies_user(?,?);', [
                $company_owner_id,
                $company_user_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }   

    public function updateCompanyUserId(Request $request)
    {
        try {
            $results = DB::select('CALL db_bright.stp_companies_user_update (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);', [
                $request->input('company_owner_id'),
                $request->input('company_user_cid'), 
                $request->input('company_user_name'),

                $request->input('company_addr1_name'),
                $request->input('company_addr1_addr'), 
                $request->input('company_addr1_province_id'),
                $request->input('company_addr1_province'),
                $request->input('company_addr1_district_id'),
                $request->input('company_addr1_district'), 
                $request->input('company_addr1_subdistrict_id'),
                $request->input('company_addr1_subdistrict'),
                $request->input('company_addr1_post'),
                $request->input('company_addr1_condition'),

                $request->input('company_addr2_name'), 
                $request->input('company_addr2_addr'), 
                $request->input('company_addr2_province_id'),
                $request->input('company_addr2_province'),
                $request->input('company_addr2_district_id'),
                $request->input('company_addr2_district'), 
                $request->input('company_addr2_subdistrict_id'),
                $request->input('company_addr2_subdistrict'),
                $request->input('company_addr2_post'), 
                $request->input('company_addr2_condition')
            ]);
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);   
        }
    }



    public function insCompanyUserId(Request $request)
    {
        try {
            $results = DB::select('CALL db_bright.stp_companies_user_ins (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);', [
                $request->input('company_owner_id'),
                $request->input('company_user_cid'), 
                $request->input('company_user_name'),

                $request->input('company_addr1_name'),
                $request->input('company_addr1_addr'), 
                $request->input('company_addr1_province_id'),
                $request->input('company_addr1_province'),
                $request->input('company_addr1_district_id'),
                $request->input('company_addr1_district'), 
                $request->input('company_addr1_subdistrict_id'),
                $request->input('company_addr1_subdistrict'),
                $request->input('company_addr1_post'),
                $request->input('company_addr1_condition'),

                $request->input('company_addr2_name'), 
                $request->input('company_addr2_addr'), 
                $request->input('company_addr2_province_id'),
                $request->input('company_addr2_province'),
                $request->input('company_addr2_district_id'),
                $request->input('company_addr2_district'), 
                $request->input('company_addr2_subdistrict_id'),
                $request->input('company_addr2_subdistrict'),
                $request->input('company_addr2_post'), 
                $request->input('company_addr2_condition')
            ]);
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);   
        }
    }
 
    public function insJobDetail(Request $request)
    {
        try {
            $basketCompanyResult = DB::select('CALL db_bright.stp_search_basket_addr(?,?,?)', [
                $request->input('company_owner_id'),
                $request->input('company_user_cid'),
                $request->input('job_type_name')
            ]);  

            if (empty($basketCompanyResult)) {

                $basketResult = DB::select('CALL db_bright.stp_search_basket(?,?,?)', [
                    $request->input('cus_addr_province_id'),
                    $request->input('cus_addr_district_id'),
                    $request->input('cus_addr_sub_district_id')
                ]);

                if (empty($basketResult)){
                    $bid = "";
                    $bname = "";
                }else{
                    $bid = $basketResult[0]->id;
                    $bname = $basketResult[0]->basket_name;
                }
                
            } else {
                $bid = $basketCompanyResult[0]->basket_id;
                $bname = $basketCompanyResult[0]->basket_name;
            }

            if (empty($bid)) {
                $sid = "";
                $sname = "";
            } else {
                $staffBasketResult = DB::select('CALL db_bright.stp_search_basket_staff(?)', [
                    $bid
                ]);
                $sid = $staffBasketResult[0]->staff_id;
                $sname = $staffBasketResult[0]->staff_name;
            }

            $results = DB::select('CALL db_bright.stp_job_master_ins(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                $request->input('company_owner_id'), 
                $request->input('company_user_cid'), 
                $request->input('cus_name'), 
                $request->input('cus_address'),
                $request->input('job_type_id'), 
                $request->input('job_type_name'),
                $request->input('cus_recive_name'),
                $request->input('cus_recive_phone'),
                $request->input('cus_recive_mobile'),
                $request->input('cus_addr_lat'),
                $request->input('cus_addr_long'),
                $request->input('cus_addr_sub_district_id'),
                $request->input('cus_addr_sub_district_name'),
                $request->input('cus_addr_district_id'),
                $request->input('cus_addr_district_name'),
                $request->input('cus_addr_province_id'),
                $request->input('cus_addr_province_name'),
                $request->input('cus_addr_sub_post'),
                $request->input('shipping_price'),
                $request->input('shipping_details_docs'),
                $request->input('shipping_details_condition'),
                $request->input('shipping_condition'),
                $request->input('job_start_date'),
                session()->get('user_id'),
                $request->input('job_time_preriod'),
                $bid,
                $bname,
                $sid,
                $sname
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }


    public function import(Request $request)
    {
        $file = $request->file('file');
        $path = $file->getRealPath();
        $company_owner_id = $request->input('company_owner_id');
        //dd($company_owner_id);
        $data = Excel::toArray([], $path);
        //dd($data);
        
    
        foreach (array_slice($data[0], 2) as $row) {
            if (!empty($row[0])) {
                $subDistResult = DB::select('CALL db_bright.stp_search_subdistrictsid(?)', [$row[10]]);
                if (empty($subDistResult)) {
                    $sCode = 0;
                    $sNameInThai = $row[8];
                    $sZipcode = $row[11];
                } else {
                    $sCode = $subDistResult[0]->id;
                    $sNameInThai = $subDistResult[0]->name_in_thai;
                    $sZipcode = $subDistResult[0]->zip_code;
                }

                $distResult = DB::select('CALL db_bright.stp_search_districts_id(?)', [$row[11]]);
                if (empty($distResult)) {
                    $dCode = 0;
                    $dNameInThai = $row[9];
                } else {
                    $dCode = $distResult[0]->id;
                    $dNameInThai = $distResult[0]->name_in_thai;
                }

                $provinceResult = DB::select('CALL db_bright.stp_search_province_id(?)', [$row[12]]);
                if (empty($provinceResult)) {
                    $pCode = 0;
                    $pNameInThai = $row[10];
                } else {
                    $pCode = $provinceResult[0]->id;
                    $pNameInThai = $provinceResult[0]->name_in_thai;
                }

                $basketResult = DB::select('CALL db_bright.stp_search_basket(?,?,?)', [
                    $pCode,
                    $dCode,
                    $sCode
                ]);

                if (empty($basketResult)) {
                    $bid = "";
                    $bname = "";
                } else {
                    $bid = $basketResult[0]->id;
                    $bname = $basketResult[0]->basket_name;
                }

                if (empty($bid)) {
                    $sid = "";
                    $sname = "";
                } else {
                    $staffBasketResult = DB::select('CALL db_bright.stp_search_basket_staff(?)', [
                        $bid
                    ]);
                    $sid = $staffBasketResult[0]->staff_id;
                    $sname = $staffBasketResult[0]->staff_name;
                }

                DB::select('CALL db_bright.stp_job_master_ins(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                    $company_owner_id,
                    intval($row[0]),
                    $row[1],
                    $row[2],
                    $row[3],
                    $row[4],
                    $row[5],
                    $row[6],
                    $row[7],
                    $row[8],
                    $row[9],
                    $sCode,
                    $sNameInThai,
                    $dCode,
                    $dNameInThai,
                    $pCode,
                    $pNameInThai,
                    $sZipcode,
                    $row[14],
                    $row[15],
                    $row[16],
                    $row[17],
                    $row[18],
                    session()->get('user_id'),
                    intval($row[19]),
                    $bid,
                    $bname,
                    $sid,
                    $sname
                ]);
            }
        }
    
        return response()->json(['msg' => 'ok']);
    }
}
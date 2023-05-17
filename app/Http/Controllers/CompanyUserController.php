<?php
namespace App\Http\Controllers;

use App\Models\Company_user;
use App\Models\Company_user_addr1;
use App\Models\Company_user_addr2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyUserController extends Controller
{
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $company = new Company_user;
            $company->company_owner_id = $request->input('company_owner_id');
            $company->company_user_cid = $request->input('company_user_cid');
            $company->company_user_name = $request->input('company_user_name');
            $company->save();

            DB::commit();

            // DB::beginTransaction();

            // $company = new Company_user_addr1;
            // $company->company_owner_id = $request->input('company_owner_id');
            // $company->company_addr1_name = $request->input('company_addr1_name');
            // $company->company_addr1_addr = $request->input('company_addr1_addr');
            // $company->company_addr1_province_id = $request->input('company_addr1_province_id');
            // $company->company_addr1_province = $request->input('company_addr1_province');
            // $company->company_addr1_district_id = $request->input('company_addr1_district_id');
            // $company->company_addr1_district = $request->input('company_addr1_district');
            // $company->company_addr1_subdistrict_id = $request->input('company_addr1_subdistrict_id');
            // $company->company_addr1_subdistrict = $request->input('company_addr1_subdistrict');
            // $company->company_addr1_post = $request->input('company_addr1_post');
            // $company->company_addr1_condition = $request->input('company_addr1_condition');
            // $company->save();

            // DB::commit();

            // DB::beginTransaction();

            // $company = new Company_user_addr2;
            // $company->company_owner_id = $request->input('company_owner_id');
            // $company->company_addr2_name = $request->input('company_addr2_name');
            // $company->company_addr2_addr = $request->input('company_addr2_addr');
            // $company->company_addr2_province_id = $request->input('company_addr2_province_id');
            // $company->company_addr2_province = $request->input('company_addr2_province');
            // $company->company_addr2_district_id = $request->input('company_addr2_district_id');
            // $company->company_addr2_district = $request->input('company_addr2_district');
            // $company->company_addr2_subdistrict_id = $request->input('company_addr2_subdistrict_id');
            // $company->company_addr2_subdistrict = $request->input('company_addr2_subdistrict');
            // $company->company_addr2_post = $request->input('company_addr2_post');
            // $company->company_addr2_condition = $request->input('company_addr2_condition');
            // $company->save();

            // DB::commit();

            //return redirect()->route('companies.index')->with('success', 'Company added successfully');
            return response()->json(['msg' => 'ok', 'company_user_id' => $company->id]);

        } catch (\Exception $e) {
            DB::rollBack();

            //return redirect()->route('companies.index')->with('error', 'Failed to add company: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
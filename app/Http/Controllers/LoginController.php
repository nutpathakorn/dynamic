<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

use GuzzleHttp\Client;

class LoginController extends Controller
{
   
    public function addsession(Request $request){
    if(request()->ajax()) {
        $token = $request->token;
        $email = $request->email;
        $user_id = $request->user_id;
        
        $request->session()->put('token', $token);
        $request->session()->put('email', $email);
        $request->session()->put('user_id', $user_id);

        if ($request->session()->exists('token')) {
            return response()->json(['token' => $token,'email' => $email,'user_id' => $user_id], 200);
        }else{
            return response()->json(['error' => 'cannot put session'], 401);
        }
        
        
    } 
    }

    public function deletesession(Request $request){

            session()->forget('token');
            session()->forget('email');
            if (!$request->session()->exists('token')) {
                return redirect()->to('/');
            }
    }

    public function getCompanyDetails(Request $request)
    {

        try {
            $company_owner_id = (int) $request->input('company_owner_id');
            $results = DB::select('CALL db_bright.stp_check_user_login_details(?);', [
                $company_owner_id
            ]);
            
            return $results;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
            
        }
    }  

    

}

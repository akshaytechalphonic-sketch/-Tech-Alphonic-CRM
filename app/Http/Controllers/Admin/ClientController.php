<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ClientController extends Controller
{
    public function index()
    {
        $data['clients'] = DB::table('clients')->get();
        $data['inactiveClients'] = DB::table('clients')->where('status','0')->get();
        $data['activeClients'] = DB::table('clients')->where('status','1')->get();
        $data['completed'] = DB::table('clients')->where('status','2')->get();
        $data['droped'] = DB::table('clients')->where('status','3')->get();

        $data['editclients'] = DB::table('clients')->whereIn('inc_status',[1,2])->get();
        return view('admin.client.client',$data);
    }
    public function create(Request $request)
    {
        if (request()->isMethod('post'))
        {
            if($request->input('firstForm')=='1')
            {
                $data = [
                    'name' => $request->input('od_clientName'),
                    'type' => $request->input('od_type'),
                    'ministry' => $request->input('od_ministry'),
                    'department' => $request->input('od_department'),
                    'organisation_name' => $request->input('od_organisation_name'),
                    'office_zone' => $request->input('od_office_zone'),
                    'contact_no' => $request->input('od_contact_no'),
                    'email' => $request->input('od_email'),
                    'gstin' => $request->input('od_gstin'),
                    'address' => $request->input('od_address'),
                    'ifd_concurrence' => $request->input('ifd_concurrence'),
                    'role' => $request->input('ifd_role'),
                    'admin_approval_designation' => $request->input('ifd_admin_approval_designation'),
                    'payment_mode' => $request->input('ifd_payment_mode'),
                    'financial_approval_designation' => $request->input('ifd_financial_approval_designation'),
                    'fa_designation' => $request->input('fa_designation'),
                    'fa_email' => $request->input('fa_email'),
                    'fa_gstin' => $request->input('fa_gstin'),
                    'fa_address' => $request->input('fa_address'),
                    'inc_status' => '1'
                ];
                    $insertGetId =  DB::table('clients')->insertGetId($data);
                    session()->put('firstArray', $data);
                    session()->put('insertGetId', $insertGetId);
            }

            if($request->input('firstForm')=='2')
            {
                $insertGetId = session()->get('insertGetId');
                DB::table('clients')->where('id',$insertGetId)->delete();
                $update1 = [
                            'cd_contact_no' => $request->input('consignee_contact_no'),
                            'cd_gstin' => $request->input('consignee_email'),
                            'cd_address' => $request->input('consignee_address'),
                            'cd_service_description' => $request->input('service_description'),
                            'sp_gem_seller_id' => $request->input('sp_gem_seller_id'),
                            'sp_company_name' => $request->input('sp_company_name'),
                            'sp_contact_number' => $request->input('sp_contact_number'),
                            'sp_email' => $request->input('sp_email'),
                            'sp_address' => $request->input('sp_address'),
                            'sp_msme_verified' => $request->input('sp_msme_verified'),
                            'sp_msme_registration' => $request->input('sp_msme_registration'),
                            'sp_mse_social_category' => $request->input('sp_mse_social_category'),
                            'sp_gender' => $request->input('sp_gender'),
                            'sp_gstin' => $request->input('sp_gstin'),
                            'inc_status' => '2'
                        ];

                 $firstArray = session()->get('firstArray');
                 $updateData = array_merge($firstArray, $update1);
                 $secondInsertId =  DB::table('clients')->insertGetId($updateData);
                 session()->put('finalArray', $updateData);
                 session()->put('secondInsertId', $secondInsertId);
            }

            if($request->input('firstForm')=='3')
            {
              $update2 = [
                            'service_start_date' => $request->input('service_start_date'),
                            'service_end_date' => $request->input('service_end_date'),
                            'establishment_area' => $request->input('establishment_area'),
                            'category_profile' => $request->input('category_profile'),
                            'category_skills' => $request->input('category_skills'),
                            'gender' => $request->input('gender'),
                            'duty_hours_per_day' => $request->input('duty_hours_per_day'),
                            'qualification' => $request->input('qualification'),
                            'ex_serviceman' => $request->input('ex_serviceman'),
                            'age_limit' => $request->input('age_limit'),
                            'years_experience' => $request->input('years_experience'),
                            'additional_requirement' => $request->input('additional_requirement'),
                            'district' => $request->input('district'),
                            'zipcode' => $request->input('zipcode'),
                            'working_days' => $request->input('working_days'),
                            'tenure_duration_employment' => $request->input('tenure_duration_employment'),
                            'basic_pay' => $request->input('basic_pay'),
                            'provident_fund' => $request->input('provident_fund'),
                            'edli' => $request->input('edli'),
                            'esi' => $request->input('esi'),
                            'epf' => $request->input('epf'),
                            'bonus' => $request->input('bonus'),
                            'optional_allowance_1' => $request->input('optional_allowance_1'),
                            'optional_allowance_2' => $request->input('optional_allowance_2'),
                            'optional_allowance_3' => $request->input('optional_allowance_3'),
                            'total_value_without_addons' => $request->input('total_value_without_addons'),
                            'total_addons_value' => $request->input('total_addons_value'),
                            'total_value_including_addons' => $request->input('total_value_including_addons'),
                            'total_contract_value' => $request->input('total_contract_value'),
                            'inc_status' =>'3'
                        ];

                        $finalArray = session()->get('finalArray');
                        $secondInsertId = session()->get('secondInsertId');
                        $updateData = array_merge($finalArray, $update2);
                        DB::table('clients')->where('id',$secondInsertId)->delete();
                        DB::table('clients')->insert($updateData);

                        return response()->json([
                            'success' => true,
                            'message' => 'Client added successfully!'
                        ]);
            }
           //  return redirect(route('admin.client.index'))->with('success', 'Client Added Successfully!');
        }
        return view('admin.client.create-client');
    }

     public function delete(Request $request,$id)
     {
           $id = $request->input('id');
           DB::table('clients')->where('id',$id)->delete();
           return response()->json([
            'success' => true,
            'message' => 'Client deleted successfully!'
        ]);
     }

     public function detail(Request $request,$id)
     {

        $data['clientDetail'] =  DB::table('clients')->where('id',$id)->first();
        return view('admin.client.client-view',$data);
     }


    public function update(Request $request,$id)
    {
         $data['allclients']  = DB::table('clients')->where('id',$id)->first();
         return view('admin.client.edit-client',$data);
    }


    public function save(Request $request)
    {
        if (request()->isMethod('post'))
        {
            if($request->input('firstForm')=='1')
            {
                $update1 = [
                    'name' => $request->input('od_clientName'),
                    'type' => $request->input('od_type'),
                    'ministry' => $request->input('od_ministry'),
                    'department' => $request->input('od_department'),
                    'organisation_name' => $request->input('od_organisation_name'),
                    'office_zone' => $request->input('od_office_zone'),
                    'contact_no' => $request->input('od_contact_no'),
                    'email' => $request->input('od_email'),
                    'gstin' => $request->input('od_gstin'),
                    'address' => $request->input('od_address'),
                    'ifd_concurrence' => $request->input('ifd_concurrence'),
                    'role' => $request->input('ifd_role'),
                    'admin_approval_designation' => $request->input('ifd_admin_approval_designation'),
                    'payment_mode' => $request->input('ifd_payment_mode'),
                    'financial_approval_designation' => $request->input('ifd_financial_approval_designation'),
                    'fa_designation' => $request->input('fa_designation'),
                    'fa_email' => $request->input('fa_email'),
                    'fa_gstin' => $request->input('fa_gstin'),
                    'fa_address' => $request->input('fa_address'),
                    'status' => $request->input('selectStatus'),
                ];
                    DB::table('clients')->where('id',$request->input('clientId'))->update($update1);

            }

            if($request->input('firstForm')=='2')
            {
                $update2 = [
                            'cd_contact_no' => $request->input('consignee_contact_no'),
                            'cd_email_id' => $request->input('consignee_email'),
                            'cd_address' => $request->input('consignee_address'),
                            'cd_service_description' => $request->input('service_description'),
                            'sp_gem_seller_id' => $request->input('sp_gem_seller_id'),
                            'sp_company_name' => $request->input('sp_company_name'),
                            'sp_contact_number' => $request->input('sp_contact_number'),
                            'sp_email' => $request->input('sp_email'),
                            'sp_address' => $request->input('sp_address'),
                            'sp_msme_verified' => $request->input('sp_msme_verified'),
                            'sp_msme_registration' => $request->input('sp_msme_registration'),
                            'sp_mse_social_category' => $request->input('sp_mse_social_category'),
                            'sp_gender' => $request->input('sp_gender'),
                            'sp_gstin' => $request->input('sp_gstin'),
                        ];
                    DB::table('clients')->where('id',$request->input('clientId'))->update($update2);
            }

            if($request->input('firstForm')=='3')
            {
              $update3 = [
                            'service_start_date' => $request->input('service_start_date'),
                            'service_end_date' => $request->input('service_end_date'),
                            'establishment_area' => $request->input('establishment_area'),
                            'category_profile' => $request->input('category_profile'),
                            'category_skills' => $request->input('category_skills'),
                            'gender' => $request->input('gender'),
                            'duty_hours_per_day' => $request->input('duty_hours_per_day'),
                            'qualification' => $request->input('qualification'),
                            'ex_serviceman' => $request->input('ex_serviceman'),
                            'age_limit' => $request->input('age_limit'),
                            'years_experience' => $request->input('years_experience'),
                            'additional_requirement' => $request->input('additional_requirement'),
                            'district' => $request->input('district'),
                            'zipcode' => $request->input('zipcode'),
                            'working_days' => $request->input('working_days'),
                            'tenure_duration_employment' => $request->input('tenure_duration_employment'),
                            'basic_pay' => $request->input('basic_pay'),
                            'provident_fund' => $request->input('provident_fund'),
                            'edli' => $request->input('edli'),
                            'esi' => $request->input('esi'),
                            'epf' => $request->input('epf'),
                            'bonus' => $request->input('bonus'),
                            'optional_allowance_1' => $request->input('optional_allowance_1'),
                            'optional_allowance_2' => $request->input('optional_allowance_2'),
                            'optional_allowance_3' => $request->input('optional_allowance_3'),
                            'total_value_without_addons' => $request->input('total_value_without_addons'),
                            'total_addons_value' => $request->input('total_addons_value'),
                            'total_value_including_addons' => $request->input('total_value_including_addons'),
                            'total_contract_value' => $request->input('total_contract_value'),
                        ];

               DB::table('clients')->where('id',$request->input('clientId'))->update($update3);
               return response()->json([
                'success' => true,
                'message' => 'Client updated successfully!'
            ]);
                    }


        }

    }

}

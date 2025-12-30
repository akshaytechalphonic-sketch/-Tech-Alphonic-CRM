<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Client;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::with(['getDesignationName','getClientName'])->get();
        return view('admin.employee.employee', $data);
    }
    public function create(Request $request)
    {
        if (request()->isMethod('post'))
        {

            $profileImage = null;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $image = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/profile_image/'), $image);
                $profileImage = 'admin/assets/profile_image/' . $image;
            }

            $cvUpload = null;
            if ($request->hasFile('cvupload')) {
                $cvFile = $request->file('cvupload');
                $cvName = time() . '_cv.' . $cvFile->getClientOriginalExtension();
                $cvFile->move(public_path('admin/assets/cv/'), $cvName);
                $cvUpload = 'admin/assets/cv/' . $cvName;
            }

                Employee::create([
                    'name' => $request->name,
                    'email'        => $request->email,
                    'mobile_no'     => $request->mobile_no,
                    'father_name' =>$request->input('father_name'),
                    'ipn_no' =>$request->input('father_name'),
                    'uan_no' =>$request->input('father_name'),
                    'rand_id' =>'EMP'.rand(9999,0000),
                    'client_id' =>$request->input('client_id'),
                    'gstin' =>$request->input('gstin'),
                    'address' =>$request->input('address'),
                    'ifd_concurrence' =>$request->input('ifd_concurrence'),
                    'role' =>$request->input('role'),
                    'designation_of_administrative_approval' =>$request->input('designation_of_administrative_approval'),
                    'payment_mode' =>$request->input('payment_mode'),
                    'designation_of_financial_approval' =>$request->input('designation_of_financial_approval'),
                    'profile_image'    => $profileImage,
                    'cvupload'    => $cvUpload,

                ]);
            return redirect('admin/employee')->with('success', 'Employee Added Successfully!');
        }

        $data['client'] = Client::orderBy('id','desc')->get();
        $data['designations'] = DB::table('destinations')->get();
        return view('admin.employee.create',$data);
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
       $data['employeeDetail'] =  DB::table('employees')->where('id',$id)->first();
       return view('admin.employee.employee-view',$data);
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
                   'fa_address' => $request->input('fa_address')
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

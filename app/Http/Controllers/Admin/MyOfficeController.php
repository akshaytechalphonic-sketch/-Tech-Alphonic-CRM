<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeDepartments;
use App\Models\OfficeEmployees;
use App\Models\OfficeDesignations;
use App\Models\OfficeTeams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Meeting;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class MyOfficeController extends Controller
{

    // public function index()
    // {

    //     $departments = OfficeDepartments::withCount('employees')->get();
    //     $select_departments = OfficeDepartments::where('status', '1')->get();
    //     $designations = OfficeDesignations::withCount('employees')->with('department')->get();
    //     $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
    //     $teams = OfficeTeams::all();

    //     return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'teams'));
    // }
    public function index(Request $request)
    {
    //    dd($request->all());
        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $teams = OfficeTeams::all();

        $office_employees = OfficeEmployees::with(['designation', 'designation.department']);

        if ($request->status === 'online') {          
            $office_employees->where('is_online', '1');
        }

        if ($request->status === 'offline') {
            $office_employees->where('is_online', '0');
        }
         if ($request->status === '1') {          
            $office_employees->where('status', '1');
        }

        if ($request->status === '2') {
            $office_employees->where('status', '2');
        }


        $office_employees = $office_employees->get();

        return view(
            'admin.office.create-employee',
            compact(
                'office_employees',
                'departments',
                'designations',
                'select_departments',
                'teams'
            )
        );
    }


    public function meetinglist()
    {
        $now = Carbon::now('Asia/Kolkata');
        $meetings = Meeting::when(isset($_GET['employee']) && $_GET['employee'] != null, fn($q) => $q->where('created_by', $_GET['employee']))
            ->when(isset($_GET['status']) && $_GET['status'] != null, fn($q) => $q->where('status', $_GET['status']))
            ->when(isset($_GET['date']) && $_GET['date'] != null,  fn($q) => $q->where('date', $_GET['date']))
            ->orderBy('id', 'DESC')
            ->with('employee')
            ->get();
        $sales_emp = OfficeEmployees::whereHas('designation.department', function ($query) {
            $query->where('department_name', 'Sales');
        })->with(['designation', 'designation.department'])->get();
        return view('admin.office.meetings', compact('meetings', 'sales_emp'));
    }

    public function profile($id)
    {
        $profile = OfficeEmployees::with(['designation', 'designation.department'])->find($id);

        return view('admin.office.profile', compact('profile'));
    }

    public function create(Request $request)
    {
        // dd($request);
        if (request()->isMethod('post')) {

            $ip_file = null;
            if ($request->hasFile('ip_file')) {
                $file = $request->file('ip_file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/ip/'), $image);
                $ip_file = 'admin/assets/office/ip/' . $image;
            }
            $uan_file = null;
            if ($request->hasFile('uan_file')) {
                $file = $request->file('uan_file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/uan/'), $image);
                $uan_file = 'admin/assets/office/uan/' . $image;
            }
            $aadhar_file = null;
            if ($request->hasFile('aadhar_file')) {
                $file = $request->file('aadhar_file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/addhar/'), $image);
                $aadhar_file = 'admin/assets/office/addhar/' . $image;
            }
            $pan_file = null;
            if ($request->hasFile('pan_file')) {
                $file = $request->file('pan_file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/pan/'), $image);
                $pan_file = 'admin/assets/office/pan/' . $image;
            }
            $rent_elec_file = null;
            if ($request->hasFile('rent_elec_file')) {
                $file = $request->file('rent_elec_file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/rent-elec/'), $image);
                $rent_elec_file = 'admin/assets/office/rent-elec/' . $image;
            }
            $profileImage = null;
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/profile/'), $image);
                $profileImage = 'admin/assets/office/profile/' . $image;
            }
            $cvUpload = null;
            if ($request->hasFile('cvupload')) {
                $cvFile = $request->file('cvupload');
                $cvName = str()->random(20) . '.' . $cvFile->getClientOriginalExtension();
                $cvFile->move(public_path('admin/assets/office/cv/'), $cvName);
                $cvUpload = 'admin/assets/office/cv/' . $cvName;
            }
            $police_verification = null;
            if ($request->hasFile('police_verification')) {
                $file = $request->file('police_verification');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/police-verification/'), $image);
                $police_verification = 'admin/assets/office/police-verification/' . $image;
            }
            $family_photo = null;
            if ($request->hasFile('family_photo')) {
                $file = $request->file('family_photo');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/family-photo/'), $image);
                $family_photo = 'admin/assets/office/family-photo/' . $image;
            }
            $school_document = null;
            if ($request->hasFile('school_document')) {
                $file = $request->file('school_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/education/'), $image);
                $school_document = 'admin/assets/office/education/' . $image;
            }
            $high_school_document = null;
            if ($request->hasFile('high_school_document')) {
                $file = $request->file('high_school_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/education/'), $image);
                $high_school_document = 'admin/assets/office/education/' . $image;
            }
            $graducation_document = null;
            if ($request->hasFile('graducation_document')) {
                $file = $request->file('graducation_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/education/'), $image);
                $graducation_document = 'admin/assets/office/education/' . $image;
            }
            $masters_document = null;
            if ($request->hasFile('masters_document')) {
                $file = $request->file('masters_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/education/'), $image);
                $masters_document = 'admin/assets/office/education/' . $image;
            }
            $certificate = null;
            if ($request->hasFile('certificate')) {
                $file = $request->file('certificate');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/education/'), $image);
                $certificate = 'admin/assets/office/education/' . $image;
            }
            $other_document = null;
            if ($request->hasFile('other_document')) {
                $file = $request->file('other_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/other/'), $image);
                $other_document = 'admin/assets/office/other/' . $image;
            }

            $OfficeEmployees = new OfficeEmployees;
            $OfficeEmployees->doj =  $request->input('doj');
            $OfficeEmployees->name =  $request->input('name');
            $OfficeEmployees->email  = $request->input('email');
            $OfficeEmployees->gender  = $request->input('gender');
            $OfficeEmployees->mobile_no     = $request->input('mobile_no');
            $OfficeEmployees->dob = $request->input('dob');
            $OfficeEmployees->religion = $request->input('religion');
            $OfficeEmployees->marital_status = $request->input('marital_status');
            $OfficeEmployees->children = $request->input('children');
            $OfficeEmployees->father_name = $request->input('father_name');
            $OfficeEmployees->mother_name = $request->input('mother_name');
            $OfficeEmployees->family_contact = $request->input('family_contact');
            $OfficeEmployees->family_photo = $family_photo;
            $OfficeEmployees->permanent_building_no = $request->input('permanent_building_no');
            $OfficeEmployees->permanent_area = $request->input('permanent_area');
            $OfficeEmployees->permanent_city = $request->input('permanent_city');
            $OfficeEmployees->permanent_country = $request->input('permanent_country');
            $OfficeEmployees->present_building_no = $request->input('present_building_no');
            $OfficeEmployees->present_area = $request->input('present_area');
            $OfficeEmployees->present_city = $request->input('present_city');
            $OfficeEmployees->present_country = $request->input('present_country');
            $OfficeEmployees->ipn_no =  $request->input('ipn_no');
            $OfficeEmployees->ipn_file =  $ip_file;
            $OfficeEmployees->uan_no =  $request->input('uan_no');
            $OfficeEmployees->uan_file =  $uan_file;
            $OfficeEmployees->designation_id = $request->input('designation_id');
            $OfficeEmployees->aadhar_no = $request->input('aadhar_no');
            $OfficeEmployees->aadhar_file =  $aadhar_file;
            $OfficeEmployees->pan_no = $request->input('pan_no');
            $OfficeEmployees->pan_file =  $pan_file;
            $OfficeEmployees->rent_elec = $request->input('rent_elec');
            $OfficeEmployees->rent_elec_file =  $rent_elec_file;
            $OfficeEmployees->reference = $request->input('reference');
            $OfficeEmployees->total_exp = $request->input('total_exp');
            $OfficeEmployees->about_employee = $request->input('about_employee');

            $OfficeEmployees->school_year = $request->input('school_year');
            $OfficeEmployees->high_school_year = $request->input('high_school_year');
            $OfficeEmployees->graducation_year = $request->input('graducation_year');
            $OfficeEmployees->masters_year = $request->input('masters_year');

            $OfficeEmployees->school_document = $school_document;
            $OfficeEmployees->high_school_document = $high_school_document;
            $OfficeEmployees->graducation_document = $graducation_document;
            $OfficeEmployees->masters_document = $masters_document;
            $OfficeEmployees->certificate = $certificate;

            $OfficeEmployees->bank_name = $request->input('bank_name');
            $OfficeEmployees->branch_location = $request->input('branch_location');
            $OfficeEmployees->ifsc = $request->input('ifsc');
            $OfficeEmployees->account_no = $request->input('account_no');
            $OfficeEmployees->profile_image = $profileImage;
            $OfficeEmployees->cvupload = $cvUpload;
            $OfficeEmployees->police_verification = $police_verification;
            $OfficeEmployees->other_document = $other_document;

            $OfficeEmployees->monthly_casual_leave = $request->input('monthly_casual_leave');
            $OfficeEmployees->monthly_paid_leave = $request->input('monthly_paid_leave');
            $OfficeEmployees->monthly_sick_leave = $request->input('monthly_sick_leave');
            $OfficeEmployees->monthly_sales_target = $request->input('monthly_sales_target');
            $OfficeEmployees->other_leave = $request->input('other_leave');

            $OfficeEmployees->role_id = $request->input('role_id');
            $OfficeEmployees->manager_id = $request->input('manager_id');
            $OfficeEmployees->password = Hash::make($request->password);

            if ($request->input('shift') == 'Day') {
                $OfficeEmployees->shift_json = json_encode([
                    'shift_type' => $request->input('shift'),
                    'start_time' => '09:00',
                    'end_time' => '19:00',
                ]);
            } else {
                $OfficeEmployees->shift_json = json_encode([
                    'shift_type' => $request->input('shift'),
                    'start_time' => '22:00',
                    'end_time' => '06:00',
                ]);
            }

            $OfficeEmployees->save();

            return redirect('admin/office')->with('success', 'Employee Added Successfully!');
        }
        $departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::with('department')->where('status', '1')->get();
        $managers = OfficeEmployees::whereIn('role_id', [1, 2, 4])->get();

        $roles = Role::active()->get();

        // dd($designations);
        return view('admin.office.create', compact('designations', 'departments', 'roles', 'managers'));
    }

    public function edit_employee($id)
    {
        $departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::where('status', '1')->get();

        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->where('id', $id)->first();


        $managers = OfficeEmployees::with('role')->whereIn('role_id', [1, 2, 4])->get();
        // dd($managers);

        $roles = Role::active()->get();

        return view('admin.office.edit', compact('designations', 'office_employees', 'managers', 'roles', 'departments'));
    }

    public function update_employee(Request $request, $id)
    {


        $OfficeEmployees = OfficeEmployees::find($id);
        $OfficeEmployees->doj =  $request->input('doj');
        $OfficeEmployees->name =  $request->input('name');
        $OfficeEmployees->email  = $request->input('email');
        $OfficeEmployees->gender  = $request->input('gender');
        $OfficeEmployees->mobile_no = $request->input('mobile_no');
        $OfficeEmployees->dob = $request->input('dob');
        $OfficeEmployees->religion = $request->input('religion');
        $OfficeEmployees->marital_status = $request->input('marital_status');
        $OfficeEmployees->children = $request->input('children');
        $OfficeEmployees->father_name = $request->input('father_name');
        $OfficeEmployees->mother_name = $request->input('mother_name');
        $OfficeEmployees->family_contact = $request->input('family_contact');
        $OfficeEmployees->permanent_building_no = $request->input('permanent_building_no');
        $OfficeEmployees->permanent_area = $request->input('permanent_area');
        $OfficeEmployees->permanent_city = $request->input('permanent_city');
        $OfficeEmployees->permanent_country = $request->input('permanent_country');
        $OfficeEmployees->present_building_no = $request->input('present_building_no');
        $OfficeEmployees->present_area = $request->input('present_area');
        $OfficeEmployees->present_city = $request->input('present_city');
        $OfficeEmployees->present_country = $request->input('present_country');
        $OfficeEmployees->ipn_no =  $request->input('ipn_no');
        $OfficeEmployees->uan_no =  $request->input('uan_no');
        $OfficeEmployees->designation_id = $request->input('designation_id');
        $OfficeEmployees->aadhar_no = $request->input('aadhar_no');
        $OfficeEmployees->pan_no = $request->input('pan_no');
        $OfficeEmployees->rent_elec = $request->input('rent_elec');
        $OfficeEmployees->reference = $request->input('reference');
        $OfficeEmployees->total_exp = $request->input('total_exp');
        $OfficeEmployees->about_employee = $request->input('about_employee');
        $OfficeEmployees->bank_name = $request->input('bank_name');
        $OfficeEmployees->branch_location = $request->input('branch_location');
        $OfficeEmployees->ifsc = $request->input('ifsc');
        $OfficeEmployees->account_no = $request->input('account_no');
        $OfficeEmployees->school_year = $request->input('school_year');
        $OfficeEmployees->high_school_year = $request->input('high_school_year');
        $OfficeEmployees->graducation_year = $request->input('graducation_year');
        $OfficeEmployees->masters_year = $request->input('masters_year');
        $OfficeEmployees->role_id = $request->input('role_id');
        $OfficeEmployees->manager_id = $request->input('manager_id');
        $OfficeEmployees->monthly_casual_leave = $request->input('monthly_casual_leave');
        $OfficeEmployees->monthly_paid_leave = $request->input('monthly_paid_leave');
        $OfficeEmployees->monthly_sick_leave = $request->input('monthly_sick_leave');
        $OfficeEmployees->monthly_sales_target = $request->input('monthly_sales_target');
        $OfficeEmployees->other_leave = $request->input('other_leave');
        if ($request->filled('password')) {
            $OfficeEmployees->password = Hash::make($request->password);
        }

        $family_photo = null;
        if ($request->hasFile('family_photo')) {
            $file = $request->file('family_photo');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/family-photo/'), $image);
            $family_photo = 'admin/assets/office/family-photo/' . $image;
            $OfficeEmployees->family_photo = $family_photo;
        }

        $ip_file = null;
        if ($request->hasFile('ip_file')) {
            $file = $request->file('ip_file');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/ip/'), $image);
            $ip_file = 'admin/assets/office/ip/' . $image;
            $OfficeEmployees->ipn_file =  $ip_file;
        }

        $uan_file = null;
        if ($request->hasFile('uan_file')) {
            $file = $request->file('uan_file');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/uan/'), $image);
            $uan_file = 'admin/assets/office/uan/' . $image;
            $OfficeEmployees->uan_file =  $uan_file;
        }

        $aadhar_file = null;
        if ($request->hasFile('aadhar_file')) {
            $file = $request->file('aadhar_file');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/addhar/'), $image);
            $aadhar_file = 'admin/assets/office/addhar/' . $image;
            $OfficeEmployees->aadhar_file =  $aadhar_file;
        }

        $pan_file = null;
        if ($request->hasFile('pan_file')) {
            $file = $request->file('pan_file');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/pan/'), $image);
            $pan_file = 'admin/assets/office/pan/' . $image;
            $OfficeEmployees->pan_file =  $pan_file;
        }

        $rent_elec_file = null;
        if ($request->hasFile('rent_elec_file')) {
            $file = $request->file('rent_elec_file');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/rent-elec/'), $image);
            $rent_elec_file = 'admin/assets/office/rent-elec/' . $image;
            $OfficeEmployees->rent_elec_file =  $rent_elec_file;
        }

        $profileImage = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/profile/'), $image);
            $profileImage = 'admin/assets/office/profile/' . $image;
            $OfficeEmployees->profile_image = $profileImage;
        }

        $cvUpload = null;
        if ($request->hasFile('cvupload')) {
            $cvFile = $request->file('cvupload');
            $cvName = str()->random(20) . '.' . $cvFile->getClientOriginalExtension();
            $cvFile->move(public_path('admin/assets/office/cv/'), $cvName);
            $cvUpload = 'admin/assets/office/cv/' . $cvName;
            $OfficeEmployees->cvupload = $cvUpload;
        }

        $police_verification = null;
        if ($request->hasFile('police_verification')) {
            $file = $request->file('police_verification');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/police-verification/'), $image);
            $police_verification = 'admin/assets/office/police-verification/' . $image;
            $OfficeEmployees->police_verification = $police_verification;
        }
        $school_document = null;
        if ($request->hasFile('school_document')) {
            $file = $request->file('school_document');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/education/'), $image);
            $school_document = 'admin/assets/office/education/' . $image;
            $OfficeEmployees->school_document = $school_document;
        }
        $high_school_document = null;
        if ($request->hasFile('high_school_document')) {
            $file = $request->file('high_school_document');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/education/'), $image);
            $high_school_document = 'admin/assets/office/education/' . $image;
            $OfficeEmployees->high_school_document = $high_school_document;
        }
        $graducation_document = null;
        if ($request->hasFile('graducation_document')) {
            $file = $request->file('graducation_document');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/education/'), $image);
            $graducation_document = 'admin/assets/office/education/' . $image;
            $OfficeEmployees->graducation_document = $graducation_document;
        }
        $masters_document = null;
        if ($request->hasFile('masters_document')) {
            $file = $request->file('masters_document');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/education/'), $image);
            $masters_document = 'admin/assets/office/education/' . $image;
            $OfficeEmployees->masters_document = $masters_document;
        }
        $certificate = null;
        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/education/'), $image);
            $certificate = 'admin/assets/office/education/' . $image;
            $OfficeEmployees->certificate = $certificate;
        }
        $other_document = null;
        if ($request->hasFile('other_document')) {
            $file = $request->file('other_document');
            $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/assets/office/other/'), $image);
            $other_document = 'admin/assets/office/other/' . $image;
            $OfficeEmployees->other_document = $other_document;
        }
        $OfficeEmployees->update();
        return redirect('admin/office')->with('success', 'Employee Updated Successfully!');
    }

    public function create_department(Request $request)
    {

        $validated = $request->validate([
            'department_name' => 'required|unique:office_departments',
        ]);

        $create = new OfficeDepartments;
        $create->department_name = $request->input('department_name');
        $create->status = $request->status;
        $create->save();

        return redirect('admin/office?tab=departments')->with('success', 'Department Added Successfully!');
    }

    public function create_designation(Request $request)
    {
        $validated = $request->validate([
            'designation_name' => 'required|unique:office_designations',
        ]);

        $department = [
            'designation_name' => $request->input('designation_name'),
            'department_id' => $request->department_id,
            'status' => $request->status
        ];
        DB::table('office_designations')->insert($department);

        return redirect('admin/office?tab=designations')->with('success', 'Designation Added Successfully!');
    }

    public function change_status(Request $request)
    {
        if ($request->type == "employees") {
            DB::table('office_employees')->where('id', $request->id)->update(['status' => $request->value]);
        } elseif ($request->type == "department") {
            DB::table('office_departments')->where('id', $request->id)->update(['status' => $request->value]);
        } elseif ($request->type == "designation") {
            DB::table('office_designations')->where('id', $request->id)->update(['status' => $request->value]);
        } elseif ($request->type == "teams") {
            DB::table('office_teams')->where('id', $request->id)->update(['status' => $request->value]);
        }
    }

    public function delete_employee($id)
    {
        DB::table('office_employees')->where('id', $id)->delete();
        return redirect('admin/office?tab=employees')->with('success', 'Employee Delete Successfully!');
    }

    public function edit_department($id)
    {

        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $editDepartment = OfficeDepartments::find($id);

        $teams = OfficeTeams::all();
        return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'editDepartment', 'teams'));
    }

    public function update_department(Request $request, $id)
    {
        $editDep = OfficeDepartments::find($id);
        $editDep->department_name = $request->department_name;
        $editDep->status = $request->status;
        $editDep->update();
        return redirect('admin/office?tab=departments')->with('success', 'Department Updated Successfully!');
    }

    public function delete_department($id)
    {
        $isUsed = DB::table('office_designations')
            ->where('department_id', $id)
            ->exists();
        if ($isUsed) {
            return redirect('admin/office?tab=departments')
                ->with('error', 'Department is assigned to a designation and cannot be deleted.');
        }
        DB::table('office_departments')->where('id', $id)->delete();
        return redirect('admin/office?tab=departments')->with('success', 'Department Delete Successfully!');
    }

    public function edit_designation($id)
    {
        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $editDesignation = OfficeDesignations::find($id);
        $teams = OfficeTeams::all();
        return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'editDesignation', 'teams'));
    }

    public function update_designation(Request $request, $id)
    {

        $editDes = OfficeDesignations::find($id);
        $editDes->designation_name = $request->designation_name;
        $editDes->department_id = $request->department_id;
        $editDes->status = $request->status;
        $editDes->update();

        return redirect('admin/office?tab=designations')->with('success', 'Designation Updated Successfully!');
    }

    public function delete_designation($id)
    {
        DB::table('office_designations')->where('id', $id)->delete();
        return redirect('admin/office?tab=designations')->with('success', 'Designation Delete Successfully!');
    }

    public function change_employee_status(Request $request, $statusId)
    {
        if (request()->isMethod('post')) {
            $status = null;

            // dd($request->all());
            $update_status = OfficeEmployees::find($statusId);
            $update_status->status = $request->status;
            $update_status->status_reason = $request->input('status_reason');

            if ($request->hasFile('status_document')) {
                $file = $request->file('status_document');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('admin/assets/office/status/'), $image);
                $status = 'admin/assets/office/status/' . $image;
                $update_status->status_document = $status;
            }

            $update_status->update();
            return redirect('admin/office')->with('success', 'Status Updated Successfully!');
        }

        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $status_employees = OfficeEmployees::find($statusId);
        // dd($status_employees);
        $teams = OfficeTeams::all();
        return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'status_employees', 'teams'));
    }

    public function employee_list($department_id, $designation_id = null)
    {

        if ($designation_id !== null) {

            $office_employees = OfficeEmployees::with(['designation', 'designation.department'])
                ->whereHas('designation.department', function ($query) use ($department_id) {
                    $query->where('id', $department_id);
                })
                ->whereHas('designation', function ($query) use ($designation_id) {
                    $query->where('id', $designation_id);
                })
                ->get();
        } else {
            $office_employees = OfficeDesignations::where('department_id', $department_id)->where('status', '1')->get();
        }

        return response()->json($office_employees);
    }

    public function edit_shift(Request $request, $id)
    {
        if (request()->isMethod('post')) {

            $update_shift = OfficeEmployees::find($id);
            $update_shift->shift_json = json_encode([
                'shift_type' => $request->input('shift_type'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);

            $update_shift->update();
            return redirect('admin/office?tab=employeeShift')->with('success', 'Shift Updated Successfully!');
        }

        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $shift_employees = OfficeEmployees::select('shift_json', 'id')->find($id);
        // dd($status_employees);
        $teams = OfficeTeams::all();
        return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'shift_employees', 'teams'));
    }

    public function create_teams(Request $request)
    {

        $create = new OfficeTeams;
        $create->team_name = $request->input('team_name');
        $create->status = $request->status;
        $create->save();

        return redirect('admin/office?tab=teams')->with('success', 'Team Add Successfully!');
    }

    public function delete_teams($id)
    {
        $create = OfficeTeams::find($id);
        $create->delete();
        return redirect('admin/office?tab=teams')->with('success', 'Team Deleted Successfully!');
    }

    public function edit_teams(Request $request, $id)
    {
        if (request()->isMethod('post')) {

            $create = OfficeTeams::find($id);
            $create->team_name = $request->input('team_name');
            $create->status = $request->status;
            $create->update();
            return redirect('admin/office?tab=teams')->with('success', 'Team Updated Successfully!');
        }

        $departments = OfficeDepartments::withCount('employees')->get();
        $select_departments = OfficeDepartments::where('status', '1')->get();
        $designations = OfficeDesignations::withCount('employees')->with('department')->get();
        $office_employees = OfficeEmployees::with(['designation', 'designation.department'])->get();
        $teams = OfficeTeams::all();
        $editTeams = OfficeTeams::find($id);

        return view('admin.office.create-employee', compact('office_employees', 'departments', 'designations', 'select_departments', 'teams', 'editTeams'));
    }

    public function getDesignations($departmentId)
    {

        return OfficeDesignations::where('department_id', $departmentId)
            ->with('department')
            ->get()
            ->map(function ($d) {
                return [
                    'id' => $d->id,
                    'designation_name' => $d->designation_name,
                    'is_sales' => $d->department->department_name === 'Sales' ? 1 : 0
                ];
            });
    }
}

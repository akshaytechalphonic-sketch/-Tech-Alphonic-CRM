<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\OfficeEmployees;
use App\Models\OfficeLeads;
use App\Models\OfficeLeadsFolders;
use App\Models\OfficeSaleTargets;
use App\Models\OfficeLeadFollowups;
use App\Models\OfficeUserChattings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MyOfficeChatsEmployeeController extends Controller
{
    public function index()
    {
        $login_employee = Auth::guard('office_employees')->user();
        $employee = OfficeEmployees::where('id','!=',$login_employee->id)->get();
       $chattedEMp = DB::select("
            SELECT c1.user_id, e.name, e.email, c2.message, c2.created_at 
            FROM ( 
                SELECT 
                    CASE 
                        WHEN sender_id = {$login_employee->id} THEN receiver_id 
                        ELSE sender_id 
                    END AS user_id, 
                    MAX(id) AS last_message_id 
                FROM office_user_chattings 
                WHERE sender_id = {$login_employee->id} OR receiver_id = {$login_employee->id} 
                GROUP BY user_id 
            ) AS c1 
            JOIN office_user_chattings AS c2 ON c1.last_message_id = c2.id 
            JOIN office_employees AS e ON c1.user_id = e.id
            ORDER BY c2.created_at DESC
        ");
        // dd($messages);
        return view('office.chats.index',compact('employee','login_employee','chattedEMp'));
    }
    public function singleChat(Request $request, $emp_base64)
    {   if ($request->isMethod('post')) {
            $new = new  OfficeUserChattings;
            $new->sender_id = $request->sender_id;
            $new->receiver_id = $request->receiver_id;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $image = str()->random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('office-chats-files/'), $image);
                $new->file = json_encode(['name' => $file->getClientOriginalName(), 'path' => 'office-chats-files/' . $image, 'ext' => $file->getClientOriginalExtension()]);
            }
            $new->message = $request->message;
            $new->save();
            
            if (isset($image)) {
                $new->url = url('public/'.'office-chats-files/' . $image);
            }
            
            return $new;
        }
        $login_employee = Auth::guard('office_employees')->user();
        $chattedEMp = DB::select("
            SELECT c1.user_id, e.name, e.email, c2.message, c2.created_at 
            FROM ( 
                SELECT 
                    CASE 
                        WHEN sender_id = {$login_employee->id} THEN receiver_id 
                        ELSE sender_id 
                    END AS user_id, 
                    MAX(id) AS last_message_id 
                FROM office_user_chattings 
                WHERE sender_id = {$login_employee->id} OR receiver_id = {$login_employee->id} 
                GROUP BY user_id 
            ) AS c1 
            JOIN office_user_chattings AS c2 ON c1.last_message_id = c2.id 
            JOIN office_employees AS e ON c1.user_id = e.id
            ORDER BY c2.created_at DESC
        ");
        $employee = OfficeEmployees::where('id','!=',$login_employee->id)->get();
        $emp = json_decode(base64_decode($emp_base64), true);
        // dd($emp);
        $chat_with = OfficeEmployees::with('designation')->where('id', $emp['id'])->first();
        $messages = OfficeUserChattings::whereIn('sender_id', [$emp['id'],$login_employee->id])->whereIn('receiver_id', [$emp['id'],$login_employee->id])->orderBy('id','DESC')->get();

        return view('office.chats.index',compact('emp_base64','employee','chat_with','login_employee','messages','chattedEMp'));
    }
}

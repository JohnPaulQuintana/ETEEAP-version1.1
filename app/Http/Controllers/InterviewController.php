<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\ForwardToDept;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ScheduleInterviewNotification; // Import ScheduleInterviewNotification
use Illuminate\Support\Facades\Notification;

class InterviewController extends Controller
{
    public function setUpInterview(Request $request){
        // Convert 24-hour time to AM/PM format
        $formattedTime = Carbon::createFromFormat('H:i', $request->input('time'))->format('h:i A');
        
        // Find the user to notify
        $notifyUser = User::where('id', $request->input('user_id'))->first();

        // Create interview record
        Interview::create([
            'user_id' => $request->input('user_id'),
            'interviewer' => 'John Doe',
            'date' => $request->input('date'),
            'time' => $formattedTime,
            'location' => $request->input('address'),
            'what_to_bring' => "Ballpen",
            'interviewed' => 1, // Interview setup success
        ]);

        // Mark document as forwarded
        $markAsForwarded = ForwardToDept::where('document_id', $request->input('document_id'))
            ->where('receiver_id', Auth::user()->id)
            ->where('isForwarded', 0)
            ->first();
        if ($markAsForwarded) {
            $markAsForwarded->update(['isForwarded' => true]);
        }

        // Build the email notification details
        $details = [
            'greetings' => "Dear ms/mr ".$notifyUser->name,
            'body' => "Thank you for your interest in the ETEEAP. Please be advised that in line with your application in the program, you are being asked to report for an interview. Details are as follows:",
            'body1' => "",
            'body2' => "Date: ". $request->input('date'),
            'body3' => "Time: ". $formattedTime,
            'body4' => "Location: ". $request->input('address'),
            'body5' => "",
            'body6' => "Kindly bring hard copies of your requirements as indicated in the information sheet attached in this email.",
            'body7' => "Also, please acknowledge receipt of this email and confirm your attendance accordingly.",
            'body8' => "Do let us know if you have any questions.",
            'actiontext' => 'Check it out',
            'actionurl' => route('user-dashboard'),
            'lastline' => 'Philip Flores',
            'lastline2' => 'Director for International Academic Linkages',
            'lastline3' => 'Director, ETEEAP',
            'lastline4' => 'Arellano University',
            'lastline5' => '+632 8 736 94 50',
        ];

        // Send notification to the user using ScheduleInterviewNotification
        Notification::send($notifyUser, new ScheduleInterviewNotification($details));
        
        return response()->json(['status'=>'success', 'message'=>'You have an interview scheduled on '.$request->input('date'). ' time: '.$formattedTime]);
    }
}

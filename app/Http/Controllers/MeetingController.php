<?php

namespace App\Http\Controllers;

use PDF;
use App\Matter;
use App\Meeting;
use App\Society;
use App\Constants;
use Illuminate\Http\Request;
use App\Http\Requests\MatterRequest;
use App\Http\Requests\MeetingRequest;
use App\Http\Services\MeetingService;

class MeetingController extends Controller
{
    /**
     * Hold Society Instance
     */
    protected $society;

    /**
     * Hold Meeting Service
     */
    protected $meetingService;

    public function __construct(MeetingService $meetingService)
    {
        $this->middleware(function ($request, $next){
            //Resolve Society
            $this->society = Society::find($request->session()->get("society"));
            return $next($request);
        });
        //Resolve Meeting Service
        $this->meetingService = $meetingService;
    }
    /**
     * Get all society meetings
     * @return Response
     */
    public function getMeetings()
    {
        //Get meeting data
        $meetingData = $this->meetingService->getMeetingData($this->society);
        //return
        return view('dashboard.meeting.all-meetings', ['meetingData' => $meetingData[0], 'links' => $meetingData[1]]);
    }

    /**
     * Get Meeting Details
     * @return Response
     */
    public function getMeetingDetails(Meeting $meeting)
    {
        //Get meeting details
        $meetingDetails = $this->meetingService->getMeetingDetails($this->society, $meeting);
        //return
        return view('dashboard.meeting.view-meeting', ['meeting' => $meetingDetails, 'users' => $this->society->users]);
    }

    /**
     * Get Reports
     * @return Response
     */
    public function getSocietyReports()
    {
        //Get Society Reports
        $societyReports = $this->meetingService->getSocietyReports($this->society);
    }

    /**
     * Get Matters
     * @return Response
     */
    public function getSocietyMatters()
    {
        //Get Society Matters
        $societyMatters = $this->meetingService->getSocietyMatters($this->society);
        return view('dashboard.matter.all-matters', [
            'matters' => $societyMatters, 
            'meetings' => $this->society->meetings
            ]);
        
    }

    /**
     * Show matters
     */
    public function displayMatterForm()
    {
        return view('dashboard.matter.create-matter', [
            'statuses' => Constants::MATTERS_STATUS,
            'members' => $this->society->users
            ]);
    }

    /**
     * Get Tasks
     * @return Response
     */
    public function getSocietyTasks()
    {
        //Get Society Tasks
        $societyReports = $this->meetingService->getSocietyReports($this->society);
    }

    /**
     * Get Single Report
     * @return Response
     */
    public function getSingleReport(Report $report)
    {
        //Get Single Report
        $report = $this->meetingService->getSingleReport($this->society, $report);
    }

    /**
     * Get Single Matter
     * @return Response
     */
    public function getSingleMatter(Matter $matter)
    {
        //Get Single Matter
        $matter = $this->meetingService->getSingleMatter($this->society, $matter);
        //return to array
        return view('dashboard.matter.view-matter', ['matter' => $matter]);
    }

    /**
     * Get Single Task
     * @return Response
     */
    public function getSingleTask(Report $task)
    {
        //Get Single Task
        $task = $this->meetingService->getSingleTask($this->society, $task);
        //return to array
    }

    /**
     * Toggle task status
     * @return Response
     */
    public function toggleTaskStatus(Task $task)
    {
        //Toggle Task Status
        $task = $this->meetingService->toggleTaskStatus($this->society, $task);
        //return to array
    }

    /**
     * Toggle matters status
     * @return Response
     */
    public function toggleMatterStatus(Matter $matter)
    {
        //Toggle Matter Status
        $this->meetingService->toggleMatterStatus($this->society, $matter);
        //return to Array
        return \redirect()->back()->with("message", "Status Updated");
    }

    public function addMatterToMeeting(Request $request, Matter $matter)
    {
        $this->meetingService->addMatterToMeeting($this->society, $request->all(), $matter);
        return \redirect()->back()->with("message", "Matter Added To Meetings");
    }

    /**
     * Edit Report
     * @return Response
     */
    public function editReport(Report $report, ReportRequest $request)
    {
        //Edit Report
        $report = $this->meetingService->editReport($this->society, $report, $request->validated());
    }

    /**
     * Edit Task
     * @return Response
     */
    public function editTask(Task $task, TaskRequest $request)
    {
        //Edit Task
        $task = $this->meetingService->editTask($this->society, $task, $request->validated());
    }

    /**
     * Edit Matter
     */
    public function displayEditMatterForm(Matter $matter)
    {
        return view('dashboard.matter.edit-matter', [
            'statuses' => Constants::MATTERS_STATUS,
            'members' => $this->society->users,
            'meetings' => $this->society->meetings,
            'matter' => $matter
            ]);
    }

    /**
     * Edit Matter
     * @return Response
     */
    public function editMatter(Matter $matter, MatterRequest $request)
    {
        //Edit Matter
        $matter = $this->meetingService->editMatter($this->society, $matter, $request->all());
        if($request->session()->has("errors")) return \redirect()->back();
        return \redirect()->route('get-society-matters')->with("message", "Matter Updated Successfully");
    }

    /**
     * Show meeting
     */
    public function displayMeetingForm()
    {
        return view(
            'dashboard.meeting.create-meeting', 
            ['users' => $this->society->users, 
            'types' => Constants::MEETING_TYPES]
        );
    }

    /**
     * Show meeting
     */
    public function displayEditMeetingForm(Meeting $meeting)
    {
        return view(
            'dashboard.meeting.edit-meeting', 
            ['users' => $this->society->users, 
            'types' => Constants::MEETING_TYPES,
            'meeting' => $meeting
            ]
        );
    }

    /**
     * Create Meeting
     * @return Response
     */
    public function createMeeting(MeetingRequest $request)
    {
        //Create Meeting
        $meeting = $this->meetingService->createMeeting($request->validated(), $this->society);
        return redirect()->route('get-meetings')->with("message", "Meeting Created Successfully");

    }

    /**
     * Create Task
     * @return Response
     */
    public function createTask(TaskRequest $request)
    {
        //Create Task
        $task = $this->meetingService->createTask($this->society, $request->validated());
    }

    /**
     * Create Matter
     * @return Response
     */
    public function createMatter(MatterRequest $request)
    {
        //Create Matter
        $matter = $this->meetingService->createMatter($this->society, $request->all());
        return \redirect()->route('get-society-matters')->with("message", "Matter Created Successfully");
    }

    /**
     * Create Report
     * @return Response
     */
    public function createReport(ReportRequest $request)
    {
        //Create Report
        $report = $this->meetingService->createReport($this->society, $request->validated());
    }

    /**
     * Edit Meeting
     * @return Response
     */
    public function editMeeting(Meeting $meeting, MeetingRequest $request)
    {
        //Edit Meeting
        $meeting = $this->meetingService->editMeeting($this->society, $meeting, $request->validated());
        return \redirect()->route('get-meeting-details', ['meeting' => $meeting->id])->with("message", "Meeting Edited Succesfully");
    }

    /**
     * Confirm Meeting Delete
     */
    public function confirmDeleteMeeting(Meeting $meeting, Request $request){
        //Construct message
        $message = "Are you sure you want to delete? ";
        //Add To Message
        $message .= "<a href='".route('delete-meeting', ['meeting' => $meeting->id])."'>Yes</a> ";
        //Add To Message
        $message .= "<a href='".route('get-meetings')."'>No</a>";
        //add flash message on error
        $request->session()->flash('message', $message);
        //Return redirect
        return redirect()->back();
    }

    /**
     * Delete Meeting
     * @return Response
     */
    public function deleteMeeting(Meeting $meeting)
    {
        //Delete Meeting
        $this->meetingService->deleteMeeting($this->society, $meeting);
        return \redirect()->route('get-meetings')->with("message", "Meeting Removed Successfully");
    }

    /**
     * Download Minute
     * @return Response
     */
    public function downloadMinute(Meeting $meeting)
    {
        $pdf = PDF::loadView('pdf.minutes', ['meeting' => $meeting]);
        $pdfName = substr($this->society->name, 0, 3) . "_" . time() . "." . 'pdf';
        return $pdf->stream($pdfName);
    }

    /**
     * Send Minutes Via Email
     */
    public function sendMinutesToAllMembers(Meeting $meeting)
    {
        $this->meetingService->sendMinutesToAllMembers($this->society, $meeting);
        return \redirect()->back()->with("message", "Minutes Sent To All Members Succesfully");
    }

    /**
     * Send Minutes Via Email
     */
    public function sendMinutesToPersons(Meeting $meeting, Request $request)
    {
        $this->meetingService->sendMinutesToPersons($this->society, $meeting, $request->all());
        return \redirect()->back()->with("message", "Minutes Sent Succesfully");
    }

    /**
     * Delete Report
     * @return Response
     */
    public function deleteReport(Report $report)
    {
        //Delete Report
        $this->meetingService->deleteReport($this->society, $report);
    }

    /**
     * Delete Task
     * @return Response
     */
    public function deleteTask(Task $task)
    {
        //Delete Task
        $this->meetingService->deleteTask($this->society, $task);
    }

    /**
     * Confirm Matter Delete
     */
    public function confirmDeleteMatter(Matter $matter, Request $request){
        //Construct message
        $message = "Are you sure you want to delete? ";
        //Add To Message
        $message .= "<a href='".route('delete-matter', ['matter' => $matter->id])."'>Yes</a> ";
        //Add To Message
        $message .= "<a href='".route('get-society-matters')."'>No</a>";
        //add flash message on error
        $request->session()->flash('message', $message);
        //Return redirect
        return redirect()->back();
    }

    /**
     * Delete Matter
     * @return Response
     */
    public function deleteMatter(Matter $matter)
    {
        //Delete Matter
        $this->meetingService->deleteMatter($this->society, $matter);
        return \redirect()->route("get-society-matters")->with("message", "Matter Removed Successfully");
    }
}

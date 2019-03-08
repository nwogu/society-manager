<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function __construct(Request $request, MeetingService $meetingService)
    {
        //Resolve Society
        $this->society = Society::find($request->session->get('society'));
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

    }

    /**
     * Get Meeting Details
     * @return Response
     */
    public function getMeetingDetails(Meeting $meeting)
    {
        //Get meeting details
        $meetingDetails = $this->meetingService->getMeetingDetails($this->society, $meeting);
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
        $societyReports = $this->meetingService->getSocietyMatters($this->society);
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
        $matter = $this->meetingService->toggleMatterStatus($this->society, $matter);
        //return to Array
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
     * @return Response
     */
    public function editMatter(Matter $matter, MatterRequest $request)
    {
        //Edit Matter
        $matter = $this->meetingService->editMatter($this->society, $matter, $request->validated());
    }

    /**
     * Create Meeting
     * @return Response
     */
    public function createMeeting(MeetingRequest $request)
    {
        //Create Meeting
        $mmeting = $this->meetingService->createMeeting($request->validated(), $this->society);

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
        $matter = $this->meetingService->createMatter($this->society, $request->validated());
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
    }

    /**
     * Delete Meeting
     * @return Response
     */
    public function deleteMeeting(Meeting $meeting)
    {
        //Delete Meeting
        $this->meetingService->deleteMeeting($this->society, $meeting);
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
     * Delete Matter
     * @return Response
     */
    public function deleteMatter(Matter $matter)
    {
        //Delete Matter
        $this->meetingService->deleteMatter($this->society, $matter);
    }
}

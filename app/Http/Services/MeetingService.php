<?php

/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */
namespace App\Http\Services;

use PDF;
use App\Meeting;
use App\Society;
use App\Constants;
use App\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MeetingService
{
    /**
     * Hold Limit
     */
    protected $limit = Constants::DEFAULT_LIMIT;

    /**
     * Create Meeting
     * @param array $data
     * @param Society $society
     * 
     * @return Meeting $meeting
     */
    public function createMeeting($data, $society)
    {
        //check attendance
        if ($data['attendance'] == null)
        return new \Exception("Meeting should have at least one member in attendance");
        //add society to meeting
        $data['society_id'] = $society->id;
        $data['meeting_date'] = new \DateTime($data['meeting_date']);
        $data['start_time'] = new \DateTime($data['start_time']);
        $data['end_time'] = new \DateTime($data['end_time']);
        $data['name'] = ucwords($data['type']) . " " . $data['meeting_date']->format('l, d M, Y');
        //create meeting
        $meeting = (new Meeting)->create($data);
        //add attendance
        $meeting->total_attendance = count($data['attendance']);
        $attendances = [];
        foreach($data['attendance'] as $att)
        {
            $attendances[$att] = ['society_id' => $society->id];
        }
        //sync attendance
        $meeting->attendances()->sync($attendances);
        //save meeting
        $meeting->push();
        //return meeting
        return $meeting;
    }

    /**
     * Add Attendance to a meeting
     * @param array $attendances
     * @param Meeting
     * @param Society
     * 
     * @return int $attendanceCount
     */
    public function addAttendance($attendances, Meeting $meeting, Society $society)
    {
        //hold attendance count
        $attendanceCount = 0;
        //loop through each attendance
        foreach($attendances as $member)
        {
            //hold attendance
            $attendance = New Attendance;
            //count attendance
            $attendanceCount++;
            //save data
            $attendance->society_id = $society->id;
            $attendance->meeting_id = $meeting->id;
            $attendance->user_id = $member;
            $attendance->save();
        }
        //return attendance count
        return $attendanceCount;
    }

    /**
     * Get all meeting types
     * 
     * @return array Constans::MEETING_TYPES
     */
    public function getMeetingTypes()
    {
        return Constants::MEETING_TYPES;
    }

    /**
     * Get Meeting Reports
     * @param Society $society
     * @param Meeting $meeting
     * 
     * @return array $reportData
     */
    public function getMeetingReports($society, Meeting $meeting)
    {
        //get meeting reports
        $reports = $society->reports()->where('meeting_id', $meeting->id)->get();
        //hold count
        $reportCount = 0;
        //loop through each reports
        foreach($reports as $report)
        {
            //count reports
            $reportCount++;
        }
        return array('count' => $reportCount, 'reports' => $reports);
    }

    /**
     * Get matters Arising
     * @param Society $society
     * @param Meeting $meeting
     * 
     * @return array $mattersData
     */
    public function getMattersArising($society, Meeting $meeting)
    {
        //get matters arising
        $matters = $society->matters()->where('meeting_id', $meeting->id)->get();
        //hold count
        $mattersCount = 0;
        //loop through each matters
        foreach($matters as $matter)
        {
            //count matters
            $mattersCount++;
        }
        return array('count' => $mattersCount, 'matters' => $matters);
    }

    /**
     * Get Meeting Tasks
     * @param Society $society
     * @param Meeting $meeting
     * 
     * @return array $tasksData
     */
    public function getMeetingTasks($society, $meeting)
    {
        //get tasks
        $tasks = $society->tasks()->where('meeting_id', $meeting->id)->get();
        //hold count
        $tasksCount = 0;
        //loop through each tasks
        foreach($tasks as $task)
        {
            //count tasks
            $tasksCount++;
        }
        return array('count' => $tasksCount, 'tasks' => $tasks);
    }

    /**
     * Create Matters Arising
     * @param Society $society
     * @param array $data
     * 
     * @return Matter $matter
     */
    public function createMatter($society, $data)
    {
        //get society
        $society = Society::find($society);
        //add society to matter
        $data['society_id'] = $society->id;
        //return matter
        return (new Matter)->create($data);
    }

    /**
     * Get Matters Status
     * @return array
     */
    public function getMatterStatus()
    {
        return Constants::MATTERS_STATUS;
    }

    /**
     * Create Tasks
     * @param Society $society
     * @param array $data
     * 
     * @return Task
     */
    public function createTask($society, $data)
    {
        //get society
        $society = Society::find($society);
        //add society to task
        $data['society_id'] = $society->id;
        //create task
        return (new Task)->create($data);
    }

    /**
     * Create Report
     * @param Society $society
     * @param array $data
     * 
     * @return Report
     */
    public function createReport($society, $data)
    {
        //get society
        $society = Society::find($society);
        //add society to report
        $data['society_id'] = $society->id;
        //parse report owner
        switch($data['reporter_type'])
        {
            case Constants::REPORTER_COMMITEE_TYPE:
                $commitee = $cociety->commitees()->where('commitee_id', $data['reporter_id'])->first();
                if($commitee == null) throw new \Exception("Commitee not found for this society");
                return $commitee->reports()->create([
                    $data
                ]);
            case Constants::REPORTER_MEMBER_TYPE:
                $member = $society->users()->where('user_id', $data['reporter_id'])->first();
                if($member == null) throw new \Exception("Member not found for this society");
                return $member->reports()->create([
                    $data
                ]);
        }
    }

    /**
     * Get meetings data
     * @param Society $society
     * @return array $meetingData
     */
    public function getMeetingData(Society $society)
    {
        //hold meetings data
        $meetingData = [];
        //get society meetings
        $meetings = $society->meetings()->orderBy('meeting_date', 'desc')->paginate($this->limit);
        //loop through meeting to get related info
        foreach ($meetings as $meeting)
        {
            $meetingData[] = $this->getMeetingDetails($society, $meeting);
        }
        return [$meetingData, $meetings->links()];
    }

    /**
     * Get meeting details
     * @param Society $society
     * @param Meeting $meeting
     * 
     * @return array $meetingDetails
     */
    public function getMeetingDetails(Society $society, Meeting $meeting)
    {
        //get society meeting
        $societyMeeting = $society->meetings()->where("id", $meeting->id)->first();
        //check society meeting
        if ($societyMeeting == null) throw new \Exception("Meeting not found for this society");
        //return meeting details
        return array(
            'meeting' => $societyMeeting,
            'reports' => $this->getMeetingReports($society, $meeting),
            'matters' => $this->getMattersArising($society, $meeting),
            'tasks' => $this->getMeetingTasks($society, $meeting)
        );
    }

    /**
     * Get Society Reports
     * @param Society $society
     * @return Paginator
     */
    public function getSocietyReports(Society $society)
    {
        return $society->reports()->paginate($this->limit);
    }

    /**
     * Get Society Tasks
     * @param Society $society
     * @param Paginator
     */
    public function getSocietyTasks(Society $society)
    {
        return $society->tasks()->paginate($this->limit);
    }

    /**
     * Get Society Matters
     * @param Society $society
     * @param Paginator
     */
    public function getSocietyMatters(Society $society)
    {
        return $society->matters()->paginate($this->limit);
    }

    /**
     * Get Single Report
     * @param Society $society
     * @param Report $report
     */
    public function getSingleReport(Society $society, Report $report)
    {
        //Get report
        $report = $society->reports()->where('id', $report->id)->first();
        //check report
        if($report == null) throw new \Exception("Report not found in this society.");
        //return response
        return $report;
    }

    /**
     * Get Single Matter
     * @param Society $society
     * @param Matter $matter
     */
    public function getSingleMatter(Society $society, Matter $matter)
    {
        //Get matter
        $matter = $society->matters()->where('id', $matter->id)->first();
        //check matter
        if($matter == null) throw new \Exception("Matter not found in this society.");
        //return response
        return $matter;
    }

    /**
     * Get Single Task
     * @param Society $society
     * @param Task $task
     */
    public function getSingleTask(Society $society, Task $task)
    {
        //Get task
        $task = $society->tasks()->where('id', $task->id)->first();
        //check task
        if($task == null) throw new \Exception("Task not found in this society.");
        //return response
        return $task;
    }

    /**
     * Toggle Task Status
     * @param Society $society
     * @param Task $task
     * 
     * @return Task
     */
    public function toggleTaskStatus(Society $society, Task $task)
    {
        //Get task
        $task = $society->tasks()->where('id', $task->id)->first();
        //check task
        if($task == null) throw new \Exception("Task not found in this society.");
        //update status
        $task->status = $task->status ? false : true;  
        //save
        $task->save();
        //return task
        return $task; 
    }

    /**
     * Toggle Matter Status
     * @param Society $society
     * @param Matter $matter
     * 
     * @return Matter
     */
    public function toggleMatterStatus(Society $society, Matter $matter)
    {
        //Get matter
        $matter = $society->matters()->where('id', $matter->id)->first();
        //check matter
        if($matter == null) throw new \Exception("Matter not found in this society.");
        //hold status
        $status = $matter->status;
        //switch status
        switch($status)
        {
            case Constants::MATTERS_ARISING:
            $status = Constants::MATTERS_TREATING;
            break;
            case Constants::MATTERS_TREATING:
            $status = Constants::MATTERS_RESOLVED;
            break;
            case Constants::MATTERS_RESOLVED:
            $status = Constants::MATTERS_ARISING;
        }
        //save
        $matter->update(['status' => $status]);
        //return matter
        return $matter; 
    }

    /**
     * Edit Report
     * @param Society
     * @param Report
     * @param array $data
     * 
     * @return Report $report
     */
    public function editReport($society, $report, $data)
    {
        //Get Society Report
        $report = $society->reports()->where('id', $report->id)->first();
        //check report
        if ($report == null) throw new \Exception("This report is not found in this society");
        //parse report owner
        switch($data['reporter_type'])
        {
            case Constants::REPORTER_COMMITEE_TYPE:
                $commitee = $cociety->commitees()->where('commitee_id', $data['reporter_id'])->first();
                if($commitee == null) throw new \Exception("Commitee not found for this society");
                $report->reportable()->create($commitee);
                break;
            case Constants::REPORTER_MEMBER_TYPE:
                $member = $society->users()->where('user_id', $data['reporter_id'])->first();
                if($member == null) throw new \Exception("Member not found for this society");
                $report->reportable()->create($member);
        }
        $report->meeting_id = $data['meeting_id'] ?? null;
        $report->report = $data['report'];
        $report->save();
        return $report;
    }

    /**
     * Edit Task
     * @param Society $society
     * @param Task $task
     * @param array $data
     * 
     * @return Task $task
     */
    public function editTask($society, $task, $data)
    {
        //Get Task
        $task = $society->tasks()->where('id', $task->id)->first();
        if ($task == null) throw new \Exception("This task is not found in this soiety");
        //update task
        $task->update($data);
        //return task
        return $task;
    }

    /**
     * Edit Matter
     * @param Society $society
     * @param Matter $matter
     * @param array $data
     * 
     * @return Matter
     */
    public function editMatter($society, $matter, $data)
    {
        //Get Matter
        $matter = $society->matters()->where('id', $matter->id)->first();
        if ($matter == null) throw new \Exception("This matter is not found in this soiety");
        //update matter
        $matter->update($data);
        //return matter
        return $matter;
    }

    /**
     * Edit a meeting
     * @param Society $society
     * @param Meeting $meeting
     * @param array $data
     * 
     * @return Meeting $meeting
     */
    public function editMeeting($society, $meeting, $data)
    {
        //get society meeting
        $meeting = $society->meetings()->where('id', $meeting->id)->first();
        if ($meeting == null) throw new \Exception("Meeting not found in this society");
        //hold attendance
        $attendances = isset($data['attendance']) ? (empty($data['attendance']) ? null : $data['attendance']) : false;
        //check attendance
        if ($attendances === null) 
        {
            //return exception
            return new \Exception("Meeting should have at least one member in attendance");
        }
        //set attendance count
        $data['total_attendance'] = $attendances === false ? $meeting->total_attendance : count($attendances);
        $data['meeting_date'] = !empty($data['meeting_dat']) ? new \DateTime($data['meeting_date']) : $meeting->meeting_date;
        $data['start_time'] = !empty($data['start_time']) ? new \DateTime($data['start_time']) : $meeting->start_time;
        $data['end_time'] = !empty($data['end_time']) ? new \DateTime($data['end_time']): $meeting->end_time;
        //update meeting
        $meeting->update($data);
        if($attendances){
            foreach($attendances as $att)
            {
                $attendanceSync[$att] = ['society_id' => $society->id];
            }
        }
        //sync attendance
        $attendances === false ?:$meeting->attendances()->sync($attendanceSync);
        //return meeting
        return $meeting;
    }

    /**
     * Delete Meeting
     * @param Society $society
     * @param Meeting $meeting
     * 
     * @return bool
     */
    public function deleteMeeting(Society $society, Meeting $meeting)
    {
        $meeting = $society->meetings()->where('id', $meeting->id)->first();
        if ($meeting == null) throw new \Exception("Meting not found for this society");
        return $meeting->delete();
    }

    /**
     * Delete Report
     * @param Society $society
     * @param Report $report
     * 
     * @return bool
     */
    public function deleteReport(Society $society, Report $report)
    {
        $report = $society->reports()->where('id', $report->id)->first();
        if ($report == null) throw new \Exception("Report not found for this society");
        return $report->delete();
    }

    /**
     * Delete Task
     * @param Society $society
     * @param Task $task
     * 
     * @return bool
     */
    public function deleteTask(Society $society, Task $task)
    {
        $task = $society->tasks()->where('id', $task->id)->first();
        if ($task == null) throw new \Exception("Task not found for this society");
        return $task->delete();
    }

    /**
     * Delete Matter
     * @param Society $society
     * @param Matter $matter
     * 
     * @return bool
     */
    public function deleteMatter(Society $society, Matter $matter)
    {
        $matter = $society->matters()->where('id', $matter->id)->first();
        if ($matter == null) throw new \Exception("Matter not found for this society");
        return $matter->delete();
    }

    /**
     * Send Minutes Via Email
     */
    public function sendMinutesToAllMembers(Society $society, $meeting)
    {
        $pdf = PDF::loadView('pdf.minutes', ['meeting' => $meeting]);
        $pdfName = substr($society->name, 0, 3) . "_" . time() . "." . 'pdf';
        $path = storage_path() . "/". $pdfName;
        $pdf->save($path);
        foreach($societ->users as $user)
        {
            if($user->email == null)continue;
            Mail::send('mail.send', ['meeting' => $meeting, 'content' => 'Kindly find attached, the minute of the above dated meeting'], function ($message) use($path, $society, $user)
            {
                $message->subject("Minutes Of Meeting -". $society->name);
                $message->from((Auth::user())->email, (Auth::user())->firstname . " " . (Auth::user())->lastname);
                $message->to($user->email);
                $message->attach($path);
    
            });
        }
        unlink($path);
        return true;
    }
}
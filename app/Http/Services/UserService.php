<?php

/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */
namespace App\Http\Services;

use App\User;
use App\Http\Services\SetUpService;

class UserService
{

    /**
     * SetUp Service
     */
    protected $setUpService;

    public function __construct(SetUpService $setUpService)
    {
        //inject setup service
        $this->setUpService = $setUpService;
    }
    
    /**
     * Add New Member to society
     * @param array $userData
     * @param Society $society
     * 
     * @return User $user
     */
    public function addNewMember($userData, $society)
    {
        //get society
        $society = Society::find($society);
        //create user
        $user = $this->setUpService->createUser($userData);
        //check user
        if ($user instanceof User)
        {
            //add user to society
            $user = $this->setUpService->addUserToSociety($user, $society, $userData['role']);
            //return user
            return $user;
        }
    }

    /**
     * Change User Role
     * @param int $currentRole
     * @param int $newRole
     * @param User $user
     * @param Society $society
     */
    public function changeUserRole($currentRole, $user, $society, $newRole)
    {
        //get current user role
        $currentRole = Role::where('id', $currentRole)->where('society_id', $society)->first();
        if($currentRole == null) throw new \Exception("Role not found for this society");
        //get new role
        $newRole = Role::where('id', $newRole)->where('society_id', $society)->first();
        if($newRole == null) throw new \Exception("Role not found for this society");
        //dettach role
        $user->roles()->detach($currentRole);
        //attach new role
        $user->roles()->attach($newRole);
        //return user
        return $user;
    }

    /**
     * Create Society Role
     * @param Society $society
     * @param array $data
     */
    public function createSocietyRole($society, $data)
    {
        //get society
        $society = Society::find($society);
        //add society to data
        $data['society_id'] = $society->id;
        //create role
        return Role::create($data);
    }

    /**
     * Create Commitee
     * @param Society $society
     * @param data $data
     */
    public function createCommitee($society, $data)
    {
        //check members
        if (!isset($data['members']) )
        {
            return \Exception(" At least One Member is required for this commitee");
        }

        if ($data['members'] == null)
        {
            return \Exception(" At least One Member is required for this commitee");
        }

        //create commitee
        $commitee = Commitee::create(["name" => $data['name'], "society_id" => $society]);
        //add members to commitee
        $commitee->members()->attach($data['members']);
        //return
        return $commitee;
    }

    /**
     * Get Member total meeting attendance
     * @param Society $society
     * @param User $user
     * @param string $meetingType
     * 
     * @return int $attendanceCount
     */
    public function getMemberAttendanceCount($society, $user, $meetingType = null)
    {
        //get society
        $society = Society::find($society);
        //hold attendance count
        $attendanceCount = 0;
        //get society attendances
        $attendances = $society->attendances()->where('user_id', $user->id)->get();
        //check for meeting
        if ($meeting == null)
        {
            //loop through attendances
            foreach($attendances as $attendance)
            {
                //count attendance
                $attendanceCount++;
            }
            return $attendanceCount;
        }
        //check for meeting type
        foreach($attendances as $attendance)
        {
            if ($attendance->meeting->type == $meetingType)
            {
                //count attendance
                $attendanceCount++;
            }
        }
        return $attendanceCount;
    }
}
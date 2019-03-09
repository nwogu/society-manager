<?php

/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */
namespace App\Http\Services;

use App\User;
use App\Society;
use App\Constants;
use App\Http\Services\SetUpService;

class UserService
{

    /**
     * SetUp Service
     */
    protected $setUpService;

    /**
     * Limit
     */
    protected $limit = Constants::DEFAULT_LIMIT;

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

    /**
     * Get all Members
     * @param Society $society
     * 
     * @return Collection
     */
    public function getAllMembers(Society $society)
    {
        //Get Members
        return $society->users()->paginate($this->limit);
    }

    /**
     * Get Executives of society by role
     * @param Society $society
     * 
     * @return Collection
     */
    public function getExecutives(Society $society)
    {
        //Get Executives
        return User::query()
        ->leftJoin('user_role', 'user_role.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('society_id', $society->id)
        ->where('executive', true)
        ->paginate($this->limit);
    }

    /**
     * Get Society Commitees
     * @param Society $society
     * 
     * @return Collection
     */
    public function getCommitees(Society $society)
    {
        //Get Commitees
        return $society->commitees()->paginate($this->limit);
    }

    /**
     * Get floor members of a society
     * @param Society $society
     * 
     * @return Collection
     */
    public function getFloorMembers()
    {
        //Get Floor Members
        return User::query()
        ->leftJoin('user_role', 'user_role.user_id', '=', 'users.id')
        ->leftJoin('roles', 'roles.id', '=', 'user_role.role_id')
        ->where('society_id', $society->id)
        ->where('executive', false)
        ->paginate($this->limit);
    }

    /**
     * Get Society Roles
     * @param Society $society
     * 
     * @return Collection
     */
    public function getSocietyRoles(Society $society)
    {
        return $this->setUpService->getSocietyRoles($society);
    }

    /**
     * Edit Commitee
     * @param Society $society
     * @param array $data
     * @param Commitee $commitee
     * 
     * @return Commitee $commitee
     */
    public function editCommitee(Society $society, $data, Commmitee $commitee)
    {
        //Get Commitee
        $commitee = $society->commitees()->where('id', $commitee->id)->first();
        if($commitee == null) throw new \Exception("Commitee not found for this society");
        $commitee->name = $data['name'] ?? $commitee->name;
        $commitee->save();
        if(isset($data['members'])) $commitee->members()->sync($data['members']);
        return $commitee;

    }

    /**
     * Edit Member
     * @param Society $society
     * @param array $data
     * @param User $member
     * 
     * @return $member
     */
    public function editMember(Society $society, $data, User $user)
    {
        //Get Member
        $member = $society->users()->where('id', $user->id)->first();
        //Get Member
        if($member == null) throw new \Exception("Member not found for this society");
        //Check for role change
        if (isset($data['role']) && $data['role'] != null) 
        {
            //Get current user role
            $currentRole = $member->roles()->where('society_id', $society->id)-first();
            $member = $this->changeUserRole($currentRole->id, $member, $society, $data['role']);
        }
        //hash password
        $data['password'] = !empty($data['password']) ? Hash::make($data['password']) : $member->password;
        return $member->update($data);
    }

    /**
     * Edit Role
     * @param Society $society
     * @param array $data
     * @param Role $role
     * 
     * @return Role $role
     */
    public function editRole(Society $society, $array, Role $role)
    {
        //Get Role
        $role = $society->roles()->where('id', $role->id)->first();
        if ($role == null) throw new \Exception("Role not found for this society");
        return $role->update($data);
    }

    /**
     * Remove User From Society
     * @param Society $society
     * @param User $member
     */
    public function removeMember(Society $society, User $member)
    {
        return $society->users()->dettach($member);
    }

    /**
     * Remove Role
     * @param Society $society
     * @param Role $role
     */
    public function removeRole(Society $society, Role $role)
    {
        //get role
        $role = $society->roles()->where('id', $role->id)->first();
        if ($role == null) throw new \Exception("Role not found for this society");
        return $role->delete();
    }

    /**
     * Remove Commitee
     * @param Society $society
     * @param Commitee $commitee
     */
    public function removeCommitee(Society $society, Commitee $commitee)
    {
        //Get Commitee
        $commitee = $society->commitees()->where('id', $commitee->id)->first();
        if ($commitee == null) throw new \Exception("Commitee not found for this society");
        return $commitee->delete();
    }

    /**
     * Get Single Member
     * @param Society $society
     * @param User $member
     * 
     * @return User $member
     */
    public function getSingleMember(Society $society, User $member)
    {
        //Get member
        $member = $society->users()->where('id', $member->id)->first();
        if ($member == null)  throw new \Exception("Member not found in this society");
        return $member;
    }

    /**
     * Get Single Commitee
     * @param Society $society
     * @param Commitee $commitee
     * 
     * @return Commitee $commitee
     */
    public function getSingleCommitee(Society $society, Commitee $commitee)
    {
        //Get Commitee
        $commitee = $society->commitees()->where('id', $commitee->id)->first();
        if ($commitee == null)  throw new \Exception("Commitee not found in this society");
        return $commitee;
    }
}
<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Commitee;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Services\UserService;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\CommiteeRequest;

class MemberController extends Controller
{
    /**
     * User Service
     */
    protected $userService;

    /**
     * Society
     */
    protected $society;

    public function __construct(UserService $userService, Request $request)
    {
        //Inject User Service
        $this->userService = $userService;
        //Resolve Society
        $this->society = Society::find($request->session->get('society'));
    }

    /**
     * Get All Members
     * @return Response
     */
    public function getAllMembers()
    {
        //Get Members
        $members = $this->userService->getAllMembers($this->society);

    }

    /**
     * Get Executives
     * @return Response
     */
    public function getExecutives()
    {
        //Get Executives
        $executivies = $this->userService->getExecutives($this->society);
    }

    /**
     * Get Commitees
     * @return Response
     */
    public function getCommitees()
    {
        //Get Commitees
        $commitees = $this->userService->getCommitees($this->society);
    }

    /**
     * Get Floor Members 
     * @return Response
     */
    public function getFloorMembers()
    {
        //Get Floor members
        $floorMembers = $this->userService->getFloorMembers($this->society);
    }

    /**
     * Get Roles
     * @return Response
     */
    public function getSocietyRoles()
    {
        //Get Roles
        $roles = $this->userService->getSocietyRoles($this->society);
    }

    /**
     * Add a new Member
     * @return Response
     */
    public function addNewMember(MemberRequest $request)
    {
        //Add new member
        $member = $this->userService->addNewMember($this->society, $request->validated());
    }

    /**
     * Create a new user role
     * @param Response
     */
    public function createRole(RoleRequest $request)
    {
        //Create Role
        $role = $this->userService->createSocietyRole($this->society, $request->validated());
    }

    /**
     * Create a commitee
     * @return Response
     */
    public function createCommitee(CommiteeRequest $request)
    {
        //Create Commitee
        $commitee = $this->userService->createCommitee($this->society, $request->validated());
    }

    /**
     * Edit Commitee
     * @return Response
     */
    public function editCommitee(CommiteeRequest $request, Commitee $commitee)
    {
        //Edit Commitee
        $commitee = $this->userService->editCommitee($this->society, $request->validated(), $commitee);
    }

     /**
     * Edit Member
     * @return Response
     */
    public function editMember(MemberRequest $request, User $member)
    {
        //Edit User
        $member = $this->userService->editMember($this->society, $request->validated(), $member);
    }

    /**
     * Edit Role
     * @return Response
     */
    public function editRole(RoleRequest $request, Role $role)
    {
        //Edit Role
        $role = $this->userService->editRole($this->society, $request->validated(), $role);
    }

    /**
     * Remove Member
     * @return Response
     */
    public function removeMember(User $user)
    {
        //Remove member
        $this->userService->removeMember($this->society, $user);
    }

    /**
     * Remove Commitee
     * @return Response
     */
    public function removeCommitee(Commitee $commitee)
    {
        //Remove Commitee
        $this->userService->removeCommitee($this->society, $commitee);
    }

    /**
     * Remove Role
     */
    public function removeRole(Role $role)
    {
        //Remove Role
        $this->userService->removeRole($this->society, $role);
    }

    /**
     * Get Single Member
     * @return Response
     */
    public function getSingleMember(User $member)
    {
        //Get Member
        $member = $this->userService->getSingleMember($this->society, $member);
    }

    /**
     * Get Single Commitee
     * @return Response
     */
    public function getSingleCommitee(Commitee $commitee)
    {
        //Get Commitee
        $commitee = $this->userService->getSingleCommitee($this->society, $commitee);
    }

}

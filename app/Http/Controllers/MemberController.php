<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Constants;
use App\Society;
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

    public function __construct(UserService $userService)
    {
        $this->middleware(function ($request, $next){
            //Resolve Society
            $this->society = Society::find($request->session()->get("society"));
            return $next($request);
        });
        //Inject User Service
        $this->userService = $userService;
    }

    /**
     * Get All Members
     * @return Response
     */
    public function getAllMembers()
    {
        //Get Members
        $members = $this->userService->getAllMembers($this->society);
        return view('dashboard.member.all-members', ['members' => $members]);

    }

    /**
     * Get Executives
     * @return Response
     */
    public function getExecutives()
    {
        //Get Executives
        $executivies = $this->userService->getExecutives($this->society);
        return view('dashboard.member.executives', ['executives' => $executivies]);
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
        return view('dashboard.role.all-roles', ['roles' => $roles]);
    }

    /**
     * Show add member form
     */
    public function displayAddMemberForm()
    {
        return view(
            'dashboard.member.add-member', 
            ['roles' => $this->society->roles, 
            'sexes' => Constants::SEXES
            ]
        );
    }

    /**
     * Add a new Member
     * @return Response
     */
    public function addNewMember(MemberRequest $request)
    {
        //Add new member
        $member = $this->userService->addNewMember($this->society, $request->all());
        return \redirect()->route('members')->with("message", "Member Added Successfully");
    }

    /**
     * Show add member form
     */
    public function displayCreateRoleForm()
    {
        return view('dashboard.role.create-role');
    }

    /**
     * Create a new user role
     * @param Response
     */
    public function createRole(RoleRequest $request)
    {
        //Create Role
        $role = $this->userService->createSocietyRole($this->society->id, $request->validated());
        return \redirect()->route('roles')->with("message", "Role Created Successfully");
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
     * Show meeting
     */
    public function displayEditMemberForm(User $member)
    {
        return view(
            'dashboard.member.edit-member', 
            ['roles' => $this->society->roles, 
            'sexes' => Constants::SEXES,
            'user' => $this->society->users()->where('user_id', $member->id)->first()
            ]
        );
    }

     /**
     * Edit Member
     * @return Response
     */
    public function editMember(MemberRequest $request, User $member)
    {
        //Edit User
        $member = $this->userService->editMember($this->society, $request->all(), $member);
        if($request->session()->has('errors')) return \redirect()->back();
        return \redirect()->route('members')->with("message", "Member Details Updated Successfully");
    }

    /**
     * Show add member form
     */
    public function displayEditRoleForm(Role $role)
    {
        return view('dashboard.role.edit-role', ['role' => $role]);
    }

    /**
     * Edit Role
     * @return Response
     */
    public function editRole(RoleRequest $request, Role $role)
    {
        //Edit Role
        $role = $this->userService->editRole($this->society, $request->validated(), $role);
        return \redirect()->route('roles')->with("message", "Role Updated Successfully");
    }

    /**
     * Confirm Member Delete
     */
    public function confirmRemoveMember(User $member, Request $request){
        //Construct message
        $message = "Are you sure you want to remove? ";
        //Add To Message
        $message .= "<a href='".route('remove-member', ['member' => $member->id])."'>Yes</a> ";
        //Add To Message
        $message .= "<a href='".route('members')."'>No</a>";
        //add flash message on error
        $request->session()->flash('message', $message);
        //Return redirect
        return redirect()->back();
    }

    /**
     * Remove Member
     * @return Response
     */
    public function removeMember(User $user)
    {
        //Remove member
        $this->userService->removeMember($this->society, $user);
        if($request->session()->has('errors')) return \redirect()->back();
        return \redirect()->route('members')->with("message", "Member Removed Successfully");
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
     * Confirm Role Delete
     */
    public function confirmRemoveRole(Role $role, Request $request){
        //Construct message
        $message = "Are you sure you want to remove? ";
        //Add To Message
        $message .= "<a href='".route('remove-role', ['role' => $role->id])."'>Yes</a> ";
        //Add To Message
        $message .= "<a href='".route('roles')."'>No</a>";
        //add flash message on error
        $request->session()->flash('message', $message);
        //Return redirect
        return redirect()->back();
    }

    /**
     * Remove Role
     */
    public function removeRole(Role $role, Request $request)
    {
        //Remove Role
        $this->userService->removeRole($this->society, $role);
        if($request->session()->has('errors')) return \redirect()->back();
        return \redirect()->route('roles')->with("message", "Role Removed Successfully");
    }

    /**
     * Get Single Member
     * @return Response
     */
    public function getSingleMember(User $member)
    {
        //Get Member
        $member = $this->userService->getSingleMember($this->society, $member);
        return view('dashboard.member.view-member', ['member' => $member]);
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

<?php
/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */
namespace App\Http\Services;

use App\Role;
use App\Constants;
use App\Society;

class SetUpService
{
    /**
     * Creates a society
     * @param Array $data
     * 
     * @return Society $society
     */
    public function createSociety(array $data): Society
    {
        //parse data
        $data['domain'] = isset($data['domain']) ? str_replace(' ', '', trim(strtolower($data['domain']))) : null;
        $data['name'] = ucwords($data['name']);
        //try create society
        try
        {
            //create society
            $society = Society::create($data);
            //create societal roles
            return $this->seedDefaultSocietalRoles($society);
        }
        catch(\Exception $e)
        {
            return $e->message();
        }
    }

    /**
     * Creates a User
     * @param Array $data
     * 
     * @return User $user
     */
    public function createUser(array $data): User
    {
        //set password
        $data['password'] = $data['password'] ?? Constants::DEFAULT_PASSWORD;
        //hash password
        $data['password'] = Hash::make($data['password']);
        //construct full name
        $data['fullname'] = $data['firstname'] . " " . $data['lastname'];
        //create user
        return User::create($data);
    }

    /**
     * Creates default roles for a society
     * @param Socitey $society
     * 
     * @return Society $society
     */
    public function seedDefaultSocietalRoles(Society $society): Society
    {
        //check if society has roles
        if ($society->roles()->isEmpty())
        {
            //define default roles
            $defaultRoles = array(
                "Floor Member" => false,
                "President" => true,
                "Secretary" => true,
                "PRO" => true,
                "Vice President" => true,
                "Treasurer" => true
            );
            //walk through default roles
            foreach($defaultRoles as $role => $executive)
            {

                $defaultRole = new Role;
                $defaultRole->role = $role;
                $defaultRole->society_id = $society->id;
                $defaultRole->executive = $executive;
                $defaultRole->save();
            }

        }

        //return society
        return $society;
    }

    /**
     * Setup Society account
     * @param array $data
     * 
     * @return User $user
     */
    public function setupAccount($data)
    {
        //check for registered user from request data
        $user = User::where('email', $data['email'])
        ->orWhere('phone', $data['phone'])->first();

        //check user
        if($user)
        {
            //create society
            $society = $this->createSociety($data);
            //check if society was created
            if($society instanceof Society)
            {
                //initialize session data
                session(["society", $society->id]);
                //add user to society
                return $this->addUserToSociety($user, $society, $data['role']);
            }
        }

        //create new user account
        $user = $this->createUser($data);
        //set up account
        $this->setupAccount($data);
    }

    /**
     * adds a user to society
     * @param User $user
     * @param Society $society
     * @param Role $role
     * 
     * @return User $user
     */
    public function addUserToSociety(User $user, Society $society, $role = null)
    {
        //seed default roles
        $society = $this->seedDefaultSocietalRoles($society);
        //check if user belongs to society
        if($society->users()->where('user_id', $user->id)->exists())
        {
            //return exception
            return new \Exception($user->firstname . " already belongs to this society");
        }
        //get role
        $role = $society->roles()->where('role_id', $role)->first() ?? $society->roles()->where('role', Constants::DEFAULT_ROLE)->first();
        //attach user role
        $user->roles()->attach($role);
        //attach user society
        $society->users()->attach($user);
        //return user
        return $user;
    }

    /**
     * Resolve Society Domain
     * @param Request $request
     * @param User $user
     * 
     * @return bool
     */
    public function resolveDomain($request, $user)
    {
        //parse request
        $domain = $request->has('domain') ? $request->domain : $request->name;
        //get society
        $society = Society::where('name', $domain)
        ->orWhere('domain', $domain)->first();
        //check society
        if ($society !== null)
        {
            //check if user belongs to the society
            if ($society->users()->where('user_id', $user->id)->exits())
            {
                //initialize session data
                $request->session()->put('society', $society->id);
                //return true
                return true;
            }
        }

        //return false
        return false;
    }

    /**
     * Get society roles
     * @param Society $society
     * 
     * @return Role $roles
     */
    public function getSocietyRoles($society)
    {
        //get roles
        $roles = Society::find($society)->roles;
        //check roles
        if ($roles->isEmpty())
        {
            //seed default roles
            $roles = $this->seedDefaultSocietalRoles($society)->roles;
        }

        return $roles;
    }

}
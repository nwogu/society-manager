<?php
/**
 * @author Gabriel Nwogu <nwogugabriel@gmail.com>
 */
namespace App\Http\Services;

use App\Role;
use App\User;
use App\Society;
use App\Constants;
use Illuminate\Support\Facades\Hash;

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
        //create society
        $society = Society::create($data);
        //create societal roles
        return $this->seedDefaultSocietalRoles($society);
        
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
        //check dob
        if(isset($data['dob']) && $data['dob'] !== null) $data['dob'] = new \DateTime($data['dob']);
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
        if ($society->roles()->get()->isEmpty())
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
        if(!$user) $user = $this->createUser($data);
        //create society
        $society = $this->createSociety($data);
        //check if society was created
        if($society instanceof Society)
        {
            //initialize session data
            session(["society" => $society->id]);
            //add user to society
            $this->addUserToSociety($user, $society, $data['role']);
        }

        return $user;
    }

    /**
     * adds a user to society
     * @param User $user
     * @param Society $society
     * @param Role $role
     * 
     * @return User $user
     */
    public function addUserToSociety(User $user, Society $society, $role = Constants::DEFAULT_ROLE, $joined = null)
    {
        //seed default roles
        $society = $this->seedDefaultSocietalRoles($society);
        //check if user belongs to society
        if($society->users()->where('user_id', $user->id)->exists())
        {
            //return exception
            throw new \Exception($user->firstname . " already belongs to this society");
        }
        //get role
        $role = $society->roles()->where('id', $role)->orWhere('role', $role)->first();
        //attach user role
        $user->roles()->attach($role);
        //attach user society
        if($joined)
        {
            $user = [$user->id => ['joined' => (new \DateTime($joined))]];
        }
        $society->users()->attach($user);
        //return user
        return User::find($user);
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
        $domain = $request->has('domain') ? $request->domain : $request->society;
        //get society
        $society = Society::where('id', $domain)
        ->orWhere('domain', $domain)->first();
        //check society
        if ($society !== null)
        {
            //check if user belongs to the society
            if ($society->users()->where('user_id', $user->id)->exists())
            {
                //initialize session data
                session(['society' => $society->id]);
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

    /**
     * Load Dashboad Header Cards
     * @param Society $society
     * 
     * @return array
     */
    public static function loadGeneralData(Society $society)
    {
        //set Society Name
        $data['name'] = $society->name;
        //set society id
        $data['id'] = $society->id;
        //Get Total Members
        $data['members'] = $society->users()->count() ?? 0;
        //Get Total Collections
        // $data['collections'] = $society->collections()->sum('received') ?? 0;
        //Get Pending Tasks
        $data['tasks'] = $society->tasks()->where('status', false)->get()->count() ?? 0;
        //Get Pending Matters Arisng
        $data['matters'] = $society->matters()->where('status', Constants::MATTERS_ARISING)->get()->count() ?? 0;

        return $data;
    }

}
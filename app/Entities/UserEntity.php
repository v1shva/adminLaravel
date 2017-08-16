<?php
/**
 * Created by PhpStorm.
 * User: inova
 * Date: 8/16/2017
 * Time: 12:13 PM
 */

namespace App\Entities;
use App\Http\AuthTraits\OwnsRecord;
use App\Traits\HasModelTrait;
use Illuminate\Notifications\Notifiable;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Auth\Authenticatable;
use \Doctrine\Common\Persistence\PersistentObject;
use \Doctrine\ORM\EntityManager;
use App\Http\Requests\UserRequest;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class UserEntity extends PersistentObject implements Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;
    use Notifiable, OwnsRecord, HasModelTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $is_subscribed;

    /**
     * @ORM\Column(type="string")
     */
    private $is_admin;

    /**
     * @ORM\Column(type="string")
     */
    private $status_id;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $remember_token;


    /**
     * @ORM\OneToMany(targetEntity="WidgetEntity", mappedBy="userId")
     * @ORM\JoinColumn(name="id", referencedColumnName="userId")
     */
    private $widgets;

    /**
     * @ORM\OneToMany(targetEntity="SocialProviderEntity", mappedBy="userId")
     * @ORM\JoinColumn(name="id", referencedColumnName="userId")
     */
    private $socialProviders;

    /**
     * @ORM\OneToOne(targetEntity="ProfileEntity", mappedBy="userId")
     * @ORM\JoinColumn(name="id", referencedColumnName="userId")
     */
    private $profile;

    /**
     * @ORM\OneToMany(targetEntity="MessageEntity", mappedBy="userId")
     * @ORM\JoinColumn(name="id", referencedColumnName="userId")
     */
    private $messages;

    public function __construct($name, $email, $password)
    {
        $this->widgets = new ArrayCollection();
        $this->socialProviders = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->name = $name;
        $this->email = $email;
        $this->password= $password;

    }

    public function updateUser(EntityManager $em,UserEntity $user, UserRequest $request)
    {
        $user->setName($request->name);
        $user->setEmail($request->email);
        $user->setIsSubscribed($request->is_subscribed);
        $user->setIsAdmin($request->is_admin);
        $user->setStatusId($request->status_id);
        $em->merge($user);
        $em->flush();
        return  $user;
    }

    public function showAdminStatusOf(UserEntity $user)
    {

        return $user->getisAdmin() ? 'Yes' : 'No';

    }

    public function showNewsletterStatusOf(UserEntity $user)
    {
        return $user->getisSubscribed() == 1 ? 'Yes' : 'No';
    }

    public function isAdmin()
    {
        return Auth::user()->getisAdmin() == 1;
    }

    public function isActiveStatus()
    {

        return Auth::user()->getStatusId() == 10;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisSubscribed()
    {
        return $this->is_subscribed;
    }

    /**
     * @param mixed $is_subscribed
     */
    public function setIsSubscribed($is_subscribed)
    {
        $this->is_subscribed = $is_subscribed;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $is_admin
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param mixed $status_id
     */
    public function setStatusId($status_id)
    {
        $this->status_id = $status_id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @param mixed $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
    }

    /**
     * @return mixed
     */
    public function getSocialProviders()
    {
        return $this->socialProviders;
    }

    /**
     * @param mixed $socialProviders
     */
    public function setSocialProviders($socialProviders)
    {
        $this->socialProviders = $socialProviders;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param mixed $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return mixed
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param mixed $remember_token
     */
    public function setRememberToken($remember_token)
    {
        $this->remember_token = $remember_token;
    }

}
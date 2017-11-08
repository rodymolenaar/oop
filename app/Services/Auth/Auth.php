<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Database;
use App\Services\Session\Session;
use const PASSWORD_BCRYPT;
use PDO;
use Throwable;

class Auth
{
    /**
     * @var mixed|null
     */
    protected $database;

    protected $session;

    protected $repository;

    protected $user;

    protected $table = 'users';

    protected $usernameField = 'username';

    protected $passwordField = 'password';

    protected $passwordAlgorithm = PASSWORD_BCRYPT;

    /**
     * Auth constructor. Resolve necessary services from the container.
     */
    public function __construct()
    {
        $this->database = app()->resolve('db');
        $this->session = app()->resolve('session');
        $this->repository = app()->resolve(UserRepository::class);
    }

    /**
     * Check if the user is logged in.
     * @return bool
     */
    public function check(): bool
    {
        return $this->user() instanceof User;
    }

    /**
     * Authenticate the user by username and password and sign in if successful.
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function authenticate(string $username, string $password)
    {
        $user = $this->repository->findBy($this->usernameField, $username);

        if (empty($user)) {
            return false;
        }

        if ($this->verify($user, $password)) {
            $this->setUser($user);
        }

        return $this->user;
    }

    /**
     * Verify a user's password.
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function verify(User $user, string $password): bool
    {
        if (password_verify($password, $user->password)) {
            return true;
        }

        return false;
    }

    /**
     * Set the given user to be remembered in Session.
     * @param $user
     */
    public function setUser($user): void
    {
        if ($user instanceof User) {
            $this->user = $user;
        } else {
            $this->user = $this->repository->find($user);
        }

        $this->session->set('auth/id', $this->user->id);
    }

    /**
     * Retrieve the saved user or retrieve the user from the database.
     * @return User
     */
    public function user()
    {
        if ($this->user instanceof User) {
            return $this->user;
        }

        $this->user = $this->repository->find($this->session->get('auth/id'));

        return $this->user;
    }

    /**
     * Reset the authentication service.
     */
    public function reset()
    {
        $this->session->remove('auth/id');
        $this->user = null;
    }
}
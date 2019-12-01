<?php

/**
 * Class WebSession
 * Session manager
 */
class WebSession
{
    private $timeout = 30 * 60;     // 30 minutes in seconds

    /**
     * WebSession constructor.
     * Starts the session
     */
    public function __construct()
    {
        // If session already exists, we will not create a new one, which would result in an error
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        // We will check for timeout -> if session start date exists
        if (isset($_SESSION['time']))
        {
            $duration = time() - (int)$_SESSION['time'];
            if ($duration > $this -> timeout)
            {
                session_destroy();
                session_start();
            }
        }
    }

    /**
     * Add session
     * @param $name string name
     * @param $value mixed value
     */
    public function addSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Returns info about session
     * @param $name string name
     * @return mixed|null
     */
    public function getSession($name)
    {
        if ($this -> isSessionSet($name))
        {
            return $_SESSION[$name];
        }
        else
            {
                return null;
            }
    }

    /**
     * Returns whether session with specific name exists or not
     * Resets the session timeout to 30 minutes
     * @param $name string name
     * @return bool session exists
     */
    public function isSessionSet($name)
    {
        $_SESSION['time'] = time();
        return isset($_SESSION[$name]);
    }

    /**
     * Removes session
     * @param $name string removed session name
     */
    public function removeSession($name)
    {
        unset($_SESSION[$name]);
    }
}

?>
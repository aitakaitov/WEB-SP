<?php

/**
 * Class WebSession
 * Session manager
 */
class WebSession
{
    /**
     * WebSession constructor.
     * Starts the session
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Add session
     * @param $name Session name
     * @param $value Session value
     */
    public function addSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Returns info about session
     * @param $name Session name
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
     * @param $name Session name
     * @return bool session exists
     */
    public function isSessionSet($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Removes session
     * @param $name removed session name
     */
    public function removeSession($name)
    {
        unset($_SESSION[$name]);
    }
}

?>
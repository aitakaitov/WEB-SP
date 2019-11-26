<?php

/**
 * Interface IController
 */
interface IController
{
    /**
     * Returns the page contents
     * @return string page contents
     */
    public function show($title):string;
}

?>
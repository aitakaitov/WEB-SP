<?php

/**
 * Returns page keys for pages with specific privilege
 * @param $privilege
 * @return array keys
 */
function getPageKeys($privilege)
{
    $pageKeys = [];

    foreach (WEB_PAGES as $page)
    {
        if ($page['access'] == $privilege)
        {
            array_push($pageKeys, $page['key']);
        }
    }

    return $pageKeys;
}


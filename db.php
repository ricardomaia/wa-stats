<?php

/**
 * Do not change thif file.
 */
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open("db.sqlite");
    }
}

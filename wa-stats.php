<?php

/**
 * wa-stats.php
 * 
 * Quick and dirty Whatsapp statistics.
 * 
 * @author      Ricardo Maia
 * @copyright   2020 Ricardo Maia
 * @link        https://github.com/ricardomaia/wa-stats.git
 * @license     https://www.gnu.org/licenses/gpl-3.0.en.html
 * @version     0.1.0
 * @todo        Parse emoji characters.
 */

include("stop_words.php");
include("db.php");

$files = glob('chats/*.{txt}', GLOB_BRACE);
$id_chat = 1;

$db = new MyDB('db.sqlite');

$db->query("CREATE TABLE IF NOT EXISTS \"stats\" (
	\"id\"	INTEGER NOT NULL,
	\"date\"	TEXT NOT NULL,
	\"time\"	TEXT NOT NULL,
	\"user\"	TEXT,
	\"id_chat\"	INTEGER,
	\"word\"	TEXT,
	PRIMARY KEY(\"id\" AUTOINCREMENT)
)");

foreach ($files as $file) {

    $re = '/(^(?<date>\d{1,2}\/\d{1,2}\/\d{1,2}),\s(?<time>\d{1,2}:\d{1,2})\s-\s(?<user>.*?):)|(?<word>[a-zA-Zà-úÀ-Ú0-9]+)/';
    $handle = fopen($file, "r");


    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $match = preg_match_all($re, $line, $matches);
            if ($match) {

                $date = date_create($matches['date'][0]);
                $formatedDate = date_format($date, "Y-m-d");

                $time = date_create($matches['time'][0]);
                $formatedTime = date_format($time, "H:i:s");

                $tokens = $matches["word"];
                foreach ($tokens as $word) {
                    $user = $matches["user"][0];
                    if (!empty($user) and !empty($word) and !in_array($word, $stop_words)) {
                        $word = trim(strtolower($word));
                        $sql = "INSERT INTO stats ('id_chat', 'date','time','user','word') VALUES ({$id_chat}, \"{$formatedDate}\", \"{$formatedTime}\", \"{$user}\", \"{$word}\") ";
                        echo $sql . PHP_EOL;
                        $db->query($sql);
                    }
                }
            }
        }
        $id_chat++;
        fclose($handle);
    } else {
        echo ("Error error opening the database file.");
    }
}

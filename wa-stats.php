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
 * @version     0.1.4
 * 
 */

/**
 * Required files.
 */
include("stop_words.php");
include("db.php");

/**
 * @link https://www.php.net/manual/en/pcre.configuration.php
 */
ini_set("pcre.backtrack_limit", "100000000");
ini_set("pcre.recursion_limit", "100000000");
mb_internal_encoding('UTF8');
mb_regex_encoding('UTF8');
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Set chat history directory.
 */
$files = glob('chats/*.{txt}', GLOB_BRACE);

/**
 * Set id_chat number for first chat file.
 */
$id_chat = 1;

/**
 * Delete previous database file.
 */
$dbfile = './db.sqlite';
if (file_exists($dbfile)) unlink($dbfile);

/**
 * Open database file for writing.
 */
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

    $re = '/(^(?<date>\d{1,2}\/\d{1,2}\/\d{1,2}),\s(?<time>\d{1,2}:\d{1,2})\s-\s(?<user>.*?):\s)|(?<word>\w+(?:\'\w+)?|[^\'~"!@#$%*()_+-=¹²³£¢¬§ªº`^{}[\]<>,.;:?\/\\\\\\\\\|\n\r\t\s])/u';
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
                    $word = trim(strtolower($word));

                    if (!empty($user) and !empty($word) and !in_array($word, $stop_words)) {
                        $sql = "INSERT INTO stats ('id_chat', 'date','time','user','word') VALUES ({$id_chat}, \"{$formatedDate}\", \"{$formatedTime}\", \"{$user}\", \"{$word}\") ";
                        $db->query($sql);
                        echo "{$sql}\n";
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

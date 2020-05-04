# wa-stats

![GitHub issues](https://img.shields.io/github/issues/ricardomaia/wa-stats)
![GitHub](https://img.shields.io/github/license/ricardomaia/wa-stats)
![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/ricardomaia/wa-stats?include_prereleases)

![alt text](https://raw.githubusercontent.com/ricardomaia/wa-stats/master/screenshot.png?raw=true)

## Export Whatsapp chats

1. Go to "Settings" > "Chats" > "Chat history" > "Export chat".
2. Select desired contact.
3. Into message box, select "Without media".
4. Send chat to destination... Google Drive, e-mail etc.
5. Put chat history files into "chats" directory of this app.

https://faq.whatsapp.com/en/android/23756533

## Importing chats

1. Via terminal or browser, execute the "wa-stats.php" file. Await until the importation finish.

## Run web server

1. Go to project directory and run PHP built in server.

```
$ cd /path/to/project/
php -S localhost:8000
PHP 7.1.32 Development Server started at Sun May  3 21:25:55 2020
Listening on http://localhost:8000
Document root is /path/to/project/wa-stats
Press Ctrl-C to quit.
```

2. Open your browser at http://localhost:8000/

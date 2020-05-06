# wa-stats

[![GitHub issues](https://img.shields.io/github/issues/ricardomaia/wa-stats)](https://github.com/ricardomaia/wa-stats/issues) ![GitHub](https://img.shields.io/github/license/ricardomaia/wa-stats) ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/ricardomaia/wa-stats?include_prereleases) ![GitHub milestones](https://img.shields.io/github/milestones/open/ricardomaia/wa-stats) ![GitHub commit activity](https://img.shields.io/github/commit-activity/w/ricardomaia/wa-stats)

![alt text](https://raw.githubusercontent.com/ricardomaia/wa-stats/develop/screenshot.png)

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
PHP 7.1.32 Development Server started at Sun May 3 21:25:55 2020
Listening on http://localhost:8000
Document root is /path/to/project/wa-stats
Press Ctrl-C to quit.
```

2. Open your browser at http://localhost:8000/

Viewing emojis depends on the TTF fonts available on your operating system. In Windows 10, this feature is provided by the Segoe UI Emoji font.
https://docs.microsoft.com/en-us/typography/font-list/segoe-ui-emoji

# 3rd party sources
- https://getbootstrap.com/
- https://www.amcharts.com/
- https://github.com/BlackrockDigital/startbootstrap-sb-admin
- https://datatables.net/

  
# WhatsApp message patterns

## System messages


    {date}, {time} - Messages to this group are now secured with end-to-end encryption. Tap for more info.
    {date}, {time} - Messages to this chat and calls are now secured with end-to-end encryption. Tap for more info.
    {date}, {time} - {user} changed this group's settings to allow only admins to edit this group's info
    {date}, {time} - {user} changed this group's icon
    {date}, {time} - {user} changed the subject from {group_name} to {group_name}
    {date}, {time} - {user} changed the group description
    {date}, {time} - {user}'s security code changed. Tap for more info.
    {date}, {time} - {user} joined using this group's invite link
    {date}, {time} - {user} added you
    {date}, {time} - {user} added {another-user}
    {date}, {time} - {another-user} was added
    {date}, {time} - {user} added {+1 22 9999-9999}
    {date}, {time} - {user} removed {another-user}
    {date}, {time} - {user} left
    {date}, {time} - {user} changed to {user}
    {date}, {time} - {user} This message was deleted
    {date}, {time} - You deleted this message

## User messages

    {date}, {time} - {user}: {message}
    {date}, {time} - {user}: {message} @{another-user}
    {date}, {time} - {user}: {message} @{12299999999}
    {date}, {time} - {user}: live location shared
    {date}, {time} - {user}: location: https://maps.google.com/?q=-{lat},{long}

 
### Media "WITHOUT MEDIA"


    {date}, {time} - {user}: <Media omitted>
    {date}, {time} - {user}: {contact-name}.vcf (file attached)

### Media "INCLUDE MEDIA"


    {date}, {time} - {user}: {image-file-name.(jpg|png)} (file attached)
    {date}, {time} - {user}: {video-file-name}.mp4 (file attached)
    {date}, {time} - {user}: {audio-file-name}.opus (file attached)
    {date}, {time} - {user}: {sticker-name}.webp (file attached) 


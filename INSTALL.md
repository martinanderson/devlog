# INSTALL STEPS

[TOC]

**Using devLog is pretty straightforward:** Simply follow the steps in this Guide and after that also take a look at the **[User Guide & Examples](USER_GUIDE.md)** file and you will be boosting up your debugging tasks in no time.

Let's get started:

## 1. Download or git pull the source code

Click the "`Code`" button on the right-upper side of this Github page and there you see "`Download ZIP`" link. 

Click there to download devLog source code package. 

If you want to use Git pull then you probably know what to do. Do it.


## 🡇

## 2. Extract the files

The best way to do it is from your hosting server's command line. That way requiered files will already have the right access permissions and you can skip some of the installation steps. Use this command:

```bash
tar -xblaablaa devlog.zip
```
But you can also use your compression utility to extract the files and later copy them to your Webserver and set the permissions there.

You now have a folder named "`devlog`" that contains everything you need.


## 🡇

## 3. Set path for the logfile
All the debugging data will be stored in a "`dev.log`" plain-text logfile. This filename is hard-coded within the devLog scripts, but yo can choose the location of the logfile. The path here is used by all devLog scripts, both PHP debugging and monitoring scripts in other languages. 

This is a single-line textfile. No variables or expressions, no filename, simply a folder path and that's it. It's important you get this correct.

Open the "`dev.log.path`" file with your favorite text editor or IDE and set the location of the log file in your Webserver:

```text
/server/path/to/devlog/
```
or on Windows Web Server:

```text
c:\server\path\to\devlog\
```

## 🡇

## 4. Copy the files to your Web server

Now simply copy all of that to your Websites hosting server's public Document Root. This is the easy way. 

But it is also possible to keep devLog hidden from the world and set it up in some other location in your system. In that case you need to be sure that your webserver software has access to them. That approach is recommended if you want to keep devLog in a running production server. 


## 🡇

## 5. Apply EXECUTE permission for the Bash monitoring script

Bash shell script `dev.log.monitor.sh` needs to have EXECUTE permissions, so that you can run it in your terminal. 

```shell
chmod 774 ./dev.log.monitor.sh
```

Now run that script in your shell and monitoring is live.

PS! You need to do the same on your Windows server, if you ae using it on Windows. Take the neccessary steps, this guide will not cover them in any more lenght.


## 🡇

## 6. Make sure the log file has READ + WRITE permissions

The Website server software needs to access this file, so make sure you have set the correct permissions. The log file must be accessible for both READ and WRITE operations. If monitoring script failed to create that file then run:

```shell
chmod 666 ./dev.log
```

Again, if you are on Windows, you should know how to do that.


## 🡇

## 7. Include devLog to your PHP script/project 

```php
@include_once('devlog/dev.log.inc.php');
```


## 🡇

## 7. Make Git ignore the devLog() installation

If you are using devLog() with your project then you probably want Git to ignore it's existence. Simply add it to your .gitignore file.

Use your text editor or simply run in your project folder a command: 

```
echo "devlog" >> .gitignore
```

## 👍

## That's it, you're done! 


I'm sure you probably didn't need so detailed guide, easy-breazy for a heavyweight developer like yourself :) But the word is spreading and newbies might miss some steps. Better to avoid the hassle of replying to all of those thousands and perhaps millions of support questions from the devLog's growing Fan Army.

If got some use out of devLog yourself, perhaps you don't mind dropping a kind word with the github link on your socials too.

You're ready for action.  
Happy debugging!


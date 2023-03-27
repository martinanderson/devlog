# DevLog()  — a PHP debugging tool
## Advanced JS console.log substitute for PHP developers

PHP devLog() is lightweight, easy to implement and a joy to use JavaScript's console.log() command substitute for PHP Developers. Delivering an efficency boost for your daily development and debugging tasks.

* Very simple and fast to integrate into your PHP project.
* Debug messages are generated with a simple <code>devLog('message');</code>  
or with a more detailed <code>devLog('message', $dump);</code>  
or with formatting filters <code>devLog('message', $dump, 2);</code>
* Includes live monitoring scripts (in Bash, Python and even Windows  
Shell) for real-time monitoring of your messages and debug data. 
* Everything is also saved in a <code>/your/website/path/**dev.log**</code> logfile for later analysis.
* Logfile is on plain text, all the messages are cleraly marked and timestamped. 

### USAGE TIP

1. Run the monitoring script in a separate terminal window.
2. Set the window to "Stay On Top" to keep it always visible.
3. Move it to your second monitor and just leave it there.

You now have a Live PHP Debugging Terminal running!

### IDE INTEGRATION

1. Open the terminal Tab in your IDE.
2. If you are using VS Code, try splittying your terminal (ctrl+shift+5).
3. Run the devLog monitoring script and voila! You now  
have Live PHP Debugging Monitor inside your IDE.


I think we can all agree, that's pretty awesome :)

devLog most definetly is NOT a replacement for a your Xdebug or some other professional PHP debugging tool. But often it takes too much effort to dig out some specific detail that you need to monitor, detect or capture. When you want to get somethng fast and with least effort. That's where devLog comes in. 

**You can think of devLog as an debugging sniper.** Picking off your enemies from the crowd one-by-one, laying low patiently, waiting for it's chance to take the perfect shot :)   

### PRODUCTION SERVER USE

It is also possible to use devLog as kind of a live Production Server Live Monitor, that is recording events that you can back-trace when there are some technical issues. To keep it 'off' by default, but activate devLog from the settings when you need to. Perform some live monitoring on what's going on under the hood, to get some useful data and find a solution wihout taking down a running Production Server.

### DOCUMENTATION 

* Take a look at the [Install & Configuration Guide](INSTALL.md) documentation 
* and the [User Guide & Examples](USER_GUIDE.md) for more information.
* Check out the [Production Server Debugging Guide](PRODUCTION_HOWTO.md) for additional tips.



### OPEN SOURCE SOFTWARE
This Code is free to use in any of your projects. Just drop me a note here if it has helped you.
Released under Open Source GPL3 licence.

Ps. I drink a lot of coffee and accept btc :)

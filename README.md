# DevLog()  — a PHP debugging tool
## Advanced JS console.log substitute for PHP developers

PHP devLog() is advanced and easy to use JavaScript's console.log() command substitute for PHP Developers, that offers an efficency boost for your development and debugging tasks.

* Very simple and fast to integrate into your PHP project.
* Includes monitoring script (Bash), to monitor your devLog() messages.
* Real time monitoring of your messages and debug data. 
* Everything is also saved in a logfile for later analysis. 
* Debug message is generated with a simple devLog('message');
* or with a more detailed devLog('message', $dump);
* or with formatting options devLog('message', $dump, 1);

Built-in formatting options:
* 0 — default
* 1 — human-readable information about a variable / array / json
* 2 — structured information about expressions that includes its type and value
* 3 — json encoded pretty print (only data)
* Commits to add more formating options are always welcome.

Command alias included! You can use the short \_d() instead of devLog() function. Save time typing and work faster. Or rename the function in to what ever you prefer.

Example. Both commands give the same result:
* devLog('failed query', $sql);
* \_d('failed query', $sql);

USAGE TIP: Run the monitoring script in a separate terminal window, set it to always on top, move it to your second monitor and just leave it there. Now use devLog() in your PHP code and you have a live terminal running for your debugging messges :)

Free to use in any of your projects. Just drop me a note here if it has helped you.
Released under MIT licence as Open Source.

Ps. I drink a lot of coffee and accept btc :)

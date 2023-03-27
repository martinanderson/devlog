# USER GUIDE

## Built-in formatting and filter options:

devLog() messages can be simple strings, variables or complex data dumps with some nice formatting and filtering.

Simplest usage:

```php
* devLog('Make a beep here!');
```

Or pass some data, exeecuted SQL queries for example:

```php
* devLog('Executed query'.$query);
* devLog('Executed query', $query);
* devLog('Executed query', $query, 0);
```
These debug commands give pretty much similar results. Use it in a way that makes you comfortable :)

But there's more.


## Built-in formatting and filter options:

* 0 — default
* 1 — human-readable information about a variable / array / json
* 2 — structured information about expressions that includes it's type and value
* 3 — json encoded pretty print (only data)
* 4 — pretty print for SQL queries

Git commits to add more formating options are always welcome. 


## PRO TIP:

Command shortcut alias included! Both of these functions give you the same result:

```php
devLog('latest query', $sql);
_dl('latest query', $sql);
```
You can use the short <code>\_dl()</code> alias instead of <code>devLog()</code> function. This simply saves your typing time, allowing you to work faster. Or rename the shortcut function to what ever you prefer. For example, if the <code>_dl()</code> function name is already used in your codebase, then simply rename it to what ever you like. Take a look at the [Source Code](dev.log.inc.php).


### More Examples:

```php
devLog('message');
devLog($dump);
devLog('message', $dump);
devLog('message', $sql, 4);

// Or in short:

_dl('message');
_dl($dump);
_dl('message', $dump);
_dl('message', $sql, 4);

// Or if you customize debugging command alias to "x":

x('message');
x($dump);
x('message', $dump);
x('message', $sql, 4);
x('This makes me happy :)')
```


# Live monitoring with shell script

This if where PHP developers get excited. You don't need to keep refreshing the logfile to see your debugging results. devLog() has Live Debug Monitoring scripts included.

Run it in your terminal, throw the terminal window to your other monitor (for example) and just leave it there for the reminder of your working session. All your debugging information will start appearing there live in real time, as you are working and testing your code in the Web Browser. 

Or you can run it straigh inside your IDE, like in VSCode's integrated terminal for example.


# Debugging examples

Do you have a nice screenshot or video about your devLog() debugging session?  
Send it to me and I'll be happy to include it here for the World to see :)

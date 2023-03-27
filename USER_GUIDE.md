




## Built-in formatting and filter options:

* 0 — default
* 1 — human-readable information about a variable / array / json
* 2 — structured information about expressions that includes its type and value
* 3 — json encoded pretty print (only data)

Git commits to add more formating options are always welcome.

### PRO TIP:

Command alias included! Both of these functions give you the same result:

```php
* devLog('latest query', $sql);
* _dl('latest query', $sql);
```
You can use the short <code>\_dl()</code> alias instead of <code>devLog()</code> function. This simply saves your typing time, allowing you to work faster. Or rename the shortcut function to what ever you prefer. For example, if the <code>_dl()</code> function name is already used in your codebase, then simply rename it to what ever you like. Take a look at the [Source Code](dev.log.inc.php).

### More Examples:

```php
devLog('message');
devLog('message', $dump);
devLog('message', $dump, 1);

// Or in short:

_dl('message');
_dl('message', $dump);
_dl('message', $dump, 1);
```


# Live monitoring with shell script




# Debugging examples


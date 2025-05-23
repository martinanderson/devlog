# DevLog()  — a PHP debugging tool
## Advanced JS console.log substitute for PHP developers

PHP devLog() is lightweight, easy to implement and a joy to use JavaScript's console.log() command substitute for PHP Developers. Delivering an efficency boost for your daily development and debugging tasks.

* Very simple and fast to integrate into your PHP project.
* Debug messages are generated with a simple `devLog('message');`
* Dump variables or arrays with `devLog('message', $dump);`
* Utilize **data formatting filters** for clearer output of arrays, objects, JSON, and SQL queries using `devLog('message', $dump, filter_number);`
* Includes live monitoring scripts (in Bash, Python and even Windows Shell) for real-time monitoring of your messages and debug data.
* Everything is also saved in a logfile (by default `dev.log` inside the directory specified in `dev.log.path`) for later analysis.
* Logfile is plain text, all messages are clearly marked and timestamped.
* Errors during logging (e.g., file permission issues) now trigger PHP warnings (`E_USER_WARNING`) instead of halting script execution with `die()`.

### USAGE TIP

1. Run the monitoring script in a separate terminal window.
2. Set the window to "Stay On Top" to keep it always visible.
3. Move it to your second monitor and just leave it there.

You now have a Live PHP Debugging Terminal running!

### IDE INTEGRATION

1. Open the terminal Tab in your IDE.
2. If you are using VS Code, try splittying your terminal (ctrl+shift+5).
3. Run the devLog monitoring script and voila! You now have Live PHP Debugging Monitor inside your IDE.

I think we can all agree, that's pretty awesome :)

devLog most definetly is NOT a replacement for a your Xdebug or some other professional PHP debugging tool. But often it takes too much effort to dig out some specific detail that you need to monitor, detect or capture. When you want to get somethng fast and with least effort. That's where devLog comes in.

**You can think of devLog as an debugging sniper.** Picking off your enemies from the crowd one-by-one, laying low patiently, waiting for it's chance to take the perfect shot :)

### CONFIGURING THE LOG FILE PATH (`dev.log.path`)

The location of the `dev.log` file is determined by the content of a special file named `dev.log.path`. This `dev.log.path` file should contain a single line: the absolute or relative path to the **directory** where you want `dev.log` to be created and written.

`devLog` searches for the `dev.log.path` file in the following order:

1.  **Environment Variable:** Checks for an environment variable named `DEVLOG_PATH_FILE_LOCATION`. If this variable is set and points to a valid `dev.log.path` file, that file is used. This is the most flexible method for configuration, especially in complex environments or containers.
    Example: `DEVLOG_PATH_FILE_LOCATION=/etc/myapp/dev.log.path`
2.  **`DIR_ROOT/dev.log.path`:** If the environment variable is not found, `devLog` looks for `dev.log.path` in a directory defined by the `DIR_ROOT` constant.
    *   `DIR_ROOT` is a constant that you can define in your application's bootstrap (e.g., your project's root directory).
    *   If `DIR_ROOT` is not defined by your application, it defaults to the directory where `dev.log.inc.php` itself resides.
3.  **`<devlog_script_dir>/dev.log.path`:** If `DIR_ROOT` is not defined (or if `dev.log.path` is not found there), `devLog` looks for `dev.log.path` in the same directory where `dev.log.inc.php` is located (i.e., `__DIR__ . '/dev.log.path'`).

**Example `dev.log.path` content:**
`/var/logs/my_application_logs/`
(This means `dev.log` will be created as `/var/logs/my_application_logs/dev.log`)

### SECURITY CONSIDERATIONS

*   **`dev.log.path` File Security:**
    *   The `dev.log.path` file's content dictates the log directory. It's crucial to secure this file.
    *   Restrict write permissions to `dev.log.path` after initial setup to prevent unauthorized changes to the log location.
*   **Log Directory Permissions:**
    *   The directory specified *inside* `dev.log.path` (where `dev.log` will be written) should be dedicated to logs.
    *   Avoid using critical system directories (e.g., `/tmp` if shared, or system binary paths).
    *   Ensure this directory is not web-accessible if logs might contain sensitive information, as `dev.log` is a plain text file.
*   **Sensitive Data Logging:**
    *   Be extremely cautious about logging sensitive information (passwords, API keys, personal data). The logs are plain text and can be a security risk if not handled properly. This is especially important if using `devLog` in any capacity on production-like or shared environments.
*   **`dev.log` File Permissions:**
    *   The `dev.log` file itself will be created with the web server's default file permissions. Review these permissions if the log data is sensitive. You might need to adjust them manually or configure your web server's umask.
*   **Production Server Use:**
    *   While `devLog` can be used on production for targeted, temporary debugging, it's generally recommended to disable or remove it for normal production operation unless specific security measures for log access and content are in place. Consider using the environment variable method to point to a secure, non-web-accessible path if used in production.

### DOCUMENTATION

*   Take a look at the [Install & Configuration Guide](INSTALL.md) documentation.
*   And the [User Guide & Examples](USER_GUIDE.md) for more information.
*   Check out the `dev.log.kichensink.php` file for a playground of examples.

### OPEN SOURCE SOFTWARE
This Code is free to use in any of your projects. Just drop me a note here if it has helped you.
Released under Open Source GPL3 licence.

Ps. I drink a lot of coffee and accept btc :)

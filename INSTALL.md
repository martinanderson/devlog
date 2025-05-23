# INSTALL STEPS

**Using devLog is pretty straightforward:** Simply follow the steps in this Guide and after that also take a look at the **[User Guide & Examples](USER_GUIDE.md)** file and you will be boosting up your debugging tasks in no time.

Let's get started:

## 1. Download or git pull the source code

Click the "`Code`" button on the right-upper side of this Github page and there you see "`Download ZIP`" link.

Click there to download devLog source code package.

If you want to use Git pull then you probably know what to do. Do it.


## 🡇

## 2. Extract the files

The best way to do it is from your hosting server's command line. That way requiered files will already have the right access permissions and you can skip some of the installation steps. Use this command (adjust filename if needed):

```bash
unzip devlog-main.zip -d devlog
# or tar -xzf devlog.tar.gz
```
Then navigate into the created directory, e.g., `cd devlog`.

But you can also use your compression utility to extract the files and later copy them to your Webserver and set the permissions there.

You now have a folder (e.g., "`devlog`" or "`devlog-main`") that contains all necessary files. For simplicity, we'll refer to the directory containing `dev.log.inc.php` as your "devlog directory".


## 🡇

## 3. Configure the Log File Path and Location

All debugging data will be stored in a `dev.log` plain-text logfile. The **location of this `dev.log` file** is determined by a configuration file named `dev.log.path`.

The `dev.log.path` file should contain a **single line of text**: the absolute or relative path to the **directory** where you want the `dev.log` file to be created and written.

**Example content for `dev.log.path`:**
`/var/log/my_app_debug/`
*(This will result in logs being written to `/var/log/my_app_debug/dev.log`)*

or on Windows:
`C:\inetpub\logs\debug\`

**How `devLog` finds `dev.log.path`:**

`devLog` searches for this `dev.log.path` configuration file in the following order of precedence:

1.  **`DEVLOG_PATH_FILE_LOCATION` Environment Variable (Recommended for Flexibility):**
    *   You can set an environment variable named `DEVLOG_PATH_FILE_LOCATION` that points to the **full path of your `dev.log.path` file**.
    *   Example: If `DEVLOG_PATH_FILE_LOCATION` is set to `/etc/my_app/conf/dev.log.path`, then `devLog` will read this specific file.
    *   This method is highly recommended for production or complex setups as it decouples the configuration from the codebase.

2.  **`DIR_ROOT/dev.log.path`:**
    *   If the environment variable is not set or the file it points to doesn't exist, `devLog` looks for `dev.log.path` inside a directory defined by a PHP constant `DIR_ROOT`.
    *   You can define `DIR_ROOT` in your application's bootstrap script (e.g., `define('DIR_ROOT', '/var/www/my_project');`). `devLog` will then look for `/var/www/my_project/dev.log.path`.
    *   If `DIR_ROOT` is not defined by your application, it defaults to the directory where the `dev.log.inc.php` script itself resides.

3.  **`<devlog_script_dir>/dev.log.path`:**
    *   If the above methods don't yield a `dev.log.path` file, `devLog` will look for it in the same directory as `dev.log.inc.php` (i.e., `__DIR__ . '/dev.log.path'` from within the `dev.log.inc.php` script). This means you can simply place your `dev.log.path` file alongside `dev.log.inc.php`.

**To set up:**
*   Create a file named `dev.log.path`.
*   Inside this file, write the path to your desired **log directory**.
*   Place this `dev.log.path` file in one of the locations described above (e.g., alongside `dev.log.inc.php` for a simple setup, or configure via environment variable for more control).

**Security Note for `dev.log.path` and the Log Directory:**
*   **Secure `dev.log.path`:** Restrict write access to your `dev.log.path` file after setup. Its content determines where logs are written.
*   **Choose a Safe Log Directory:** The directory path you specify *inside* `dev.log.path` should be:
    *   Writable by the web server user.
    *   **Not web-accessible** if logs might contain sensitive information.
    *   Not a critical system directory.
    *   Dedicated to logs if possible.

## 🡇

## 4. Copy the devLog files to your Web server

Copy the devlog directory (containing `dev.log.inc.php`, `dev.log.monitor.sh`, etc.) to your project. This could be a subdirectory within your project or a shared library location.

Example: `my_project/libs/devlog/`

If you choose to keep the devLog files outside the web-accessible document root for security, ensure your PHP scripts can still include `dev.log.inc.php` via its path.

## 🡇

## 5. Apply EXECUTE permission for the Bash monitoring script

The Bash shell script `dev.log.monitor.sh` needs EXECUTE permissions to run in your terminal.

Navigate to your devlog directory and run:
```shell
chmod +x ./dev.log.monitor.sh
```
Now you can run `./dev.log.monitor.sh` in your shell, and live monitoring will start.

(Similar steps might be needed for other monitoring scripts if you use them, depending on your OS.)

## 🡇

## 6. Ensure Log File / Directory has READ + WRITE permissions

The web server software (e.g., Apache, Nginx user like `www-data`) needs permission to create and write to the `dev.log` file within the directory you specified in `dev.log.path`.

*   If `devLog` cannot create or write to `dev.log`, it will trigger a PHP warning (`E_USER_WARNING`).
*   Ensure the chosen log directory exists and is writable by the web server user.
    ```shell
    # Example: If your log directory is /var/log/my_app_debug
    sudo mkdir -p /var/log/my_app_debug
    sudo chown www-data:www-data /var/log/my_app_debug # Or appropriate user/group
    sudo chmod 755 /var/log/my_app_debug 
    ```
    The `dev.log` file itself will be created by PHP with default permissions, usually allowing the web server user to write to it.

## 🡇

## 7. Include devLog in your PHP script/project

In your PHP scripts (e.g., a common bootstrap file, or directly in scripts you're debugging), add:

```php
@include_once('path/to/your/devlog/dev.log.inc.php');
```
Adjust the path according to where you placed the devlog directory.

## 🡇

## 8. (Optional) Make Git ignore the devLog files and logs

If you're using devLog within a Git-managed project, you'll likely want Git to ignore the devLog installation files (if you copied them directly into your project) and especially the `dev.log` file itself, as well as `dev.log.path` if it's stored within the repo.

Add these to your `.gitignore` file:

```
# devLog files
devlog/
dev.log
dev.log.path 
# Or more specific paths if you placed them elsewhere:
# path/to/your/devlog/
# path/to/your/logs/dev.log
# path/to/your/config/dev.log.path
```

## 👍

## That's it, you're done!

You're ready for action. Check the **[User Guide & Examples](USER_GUIDE.md)** and the `dev.log.kichensink.php` file for how to use `devLog()` and its features. Happy debugging!

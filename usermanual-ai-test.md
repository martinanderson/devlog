# User Manual

This is a user manual for devLog().

## Introduction

devLog() is a PHP debugging tool that serves as a substitute for JavaScript's `console.log()` functionality, specifically tailored for PHP developers. It is designed to be lightweight, easy to implement, and enjoyable to use, with the primary purpose of boosting efficiency in daily development and debugging workflows.

## Installation and Configuration

Here's how to install and configure devLog():

1.  **Get the Source Code:**
    *   Download the ZIP file from the GitHub repository (click "Code" then "Download ZIP").
    *   Alternatively, use `git pull` if you prefer.

2.  **Extract the Files:**
    *   The recommended way is to extract the archive directly on your hosting server using a command like `tar -xblaablaa devlog.zip` (replace `devlog.zip` with the actual archive name if different). This helps in setting correct file permissions.
    *   You can also extract the files locally and then copy them to your web server.
    *   This will create a folder named `devlog`.

3.  **Set the Logfile Path:**
    *   All debug data is stored in `dev.log`. The path to this file is configured in `dev.log.path`.
    *   Open `devlog/dev.log.path` in a text editor.
    *   Enter the absolute folder path where `dev.log` will be stored (e.g., `/server/path/to/devlog/` or `c:\server\path\to\devlog\` on Windows). This file should contain only the path.

4.  **Copy Files to Web Server:**
    *   Copy the entire `devlog` folder to your website's public document root.
    *   For production servers, it's recommended to place the `devlog` folder outside the public root and ensure your web server software has read access to it.

5.  **Set Execute Permissions for Monitoring Script:**
    *   The Bash monitoring script `devlog/dev.log.monitor.sh` needs execute permissions.
    *   Run `chmod 774 ./dev.log.monitor.sh` (adjust path if you are not in the `devlog` directory).
    *   Similar steps are needed on Windows if using the Windows shell script.

6.  **Ensure Read/Write Permissions for Log File:**
    *   The web server needs read and write access to `dev.log`.
    *   If the monitoring script doesn't create it, or if there are permission issues, run `chmod 666 ./dev.log` (adjust path if you are not in the `devlog` directory where `dev.log` is located).
    *   Ensure appropriate permissions are set on Windows.

7.  **Include devLog in PHP Project:**
    *   Add the following line to your PHP script(s):
        ```php
        @include_once('devlog/dev.log.inc.php'); 
        ```
        (Adjust the path if `devlog` folder is not in the same directory as your script).

8.  **Make Git Ignore devLog (Optional):**
    *   To prevent committing devLog files to your project's repository, add `devlog` to your `.gitignore` file.
    *   You can do this by running `echo "devlog" >> .gitignore` in your project's root directory.

## Basic Usage

Once devLog() is included in your PHP project, you can start logging messages and data.

### Logging Simple Messages

To log a simple text message, use the `devLog()` function:

```php
devLog('This is a debug message.');
```

You can also use the shorter alias `_dl()`:

```php
_dl('Another debug message.');
```

### Logging Data (Variables, Queries, etc.)

`devLog()` is very useful for inspecting the content of variables, arrays, objects, or even SQL queries. To log data, pass it as the second argument to the function:

```php
$myVariable = "Hello, World!";
devLog('Value of myVariable:', $myVariable);

$user = ['id' => 1, 'name' => 'John Doe'];
_dl('User data:', $user);

$sqlQuery = "SELECT * FROM users WHERE status = 'active'";
devLog('Last SQL Query:', $sqlQuery);
```

Both `devLog()` and its alias `_dl()` can be used interchangeably for logging messages and data. The first argument is typically a descriptive message (string), and the second argument is the data you want to inspect.

The `USER_GUIDE.md` also mentions formatting options for the output, which allow you to control how the logged data is displayed.

## Formatting and Filter Options

`devLog()` provides several built-in options to format the output of the logged data. These are specified by providing a third integer argument to the `devLog()` or `_dl()` function, like `devLog('message', $data, $option);`.

Here are the available options:

*   **`0` — Default:**
    *   This is the default behavior if no formatting option is specified. It provides a basic output of the data.
    *   Example: `devLog('User data (default):', $user);` or `devLog('User data (explicit default):', $user, 0);`

*   **`1` — Human-Readable Information:**
    *   Displays human-readable information about a variable, array, or JSON object. This is often similar to using `print_r()` in PHP.
    *   Example: `devLog('User data (human-readable):', $user, 1);`

*   **`2` — Structured Information (Type and Value):**
    *   Provides structured information about expressions, including their data type and value. This is useful for understanding the exact nature of a variable.
    *   Example: `devLog('User data (structured):', $user, 2);`

*   **`3` — JSON Encoded Pretty Print (Data Only):**
    *   Outputs the data as a JSON encoded string, with pretty printing for readability. This option focuses on the data itself.
    *   Example: `devLog('User data (JSON pretty print):', $user, 3);`

*   **`4` — Pretty Print for SQL Queries:**
    *   Specifically formats SQL queries for better readability, often adding line breaks and indentation.
    *   Example: `devLog('SQL Query (pretty print):', $sqlQuery, 4);`

Choosing the appropriate formatting option can make it easier to inspect and understand the data you are logging.

## Live Monitoring

One of the powerful features of devLog() is its ability to provide live monitoring of your debug output. This means you don't have to manually refresh a log file to see the latest messages or data dumps. devLog() includes monitoring scripts for various shells (Bash, Python, and Windows Shell).

### How it Works

You run a monitoring script in a terminal window. As your PHP application executes `devLog()` or `_dl()` commands, the output is instantly displayed in this terminal. This allows you to see debug information in real-time as you interact with your web application or run your PHP scripts.

### Running the Monitoring Script

The primary script for Unix-like systems is `dev.log.monitor.sh`, located in the `devlog` directory.

1.  **Ensure it's executable:** If you haven't already during installation, make it executable:
    ```bash
    chmod +x devlog/dev.log.monitor.sh
    ```
2.  **Run the script:**
    ```bash
    ./devlog/dev.log.monitor.sh
    ```
    (Adjust the path if you are not in the parent directory of `devlog`).

Now, any calls to `devLog()` in your PHP code will output to this terminal.

### Usage Tips for Live Monitoring

*   **Separate Terminal Window:** Run the monitoring script in a dedicated terminal window.
*   **"Stay On Top":** If your terminal application supports it, set the monitoring window to "Stay On Top" to keep it always visible.
*   **Second Monitor:** If you have a multi-monitor setup, move the monitoring terminal to your second screen.
*   **IDE Integration:** You can also run the script in your IDE's integrated terminal (e.g., in VS Code, you can open a terminal and even split it for a dedicated view).

This live feedback loop significantly speeds up the debugging process, allowing you to quickly identify issues and understand the flow of your application.

## IDE Integration

In addition to using a separate terminal window, you can seamlessly integrate the live monitoring script into your Integrated Development Environment (IDE). Most modern IDEs include a built-in terminal feature.

### Steps for IDE Integration:

1.  **Open your IDE's Terminal:** Locate and open the terminal panel or tab within your IDE.
2.  **Run the Monitoring Script:** Navigate to the appropriate directory and execute the live monitoring script (e.g., `./devlog/dev.log.monitor.sh`) just as you would in a standalone terminal.

This setup allows you to have your code editor and the live debug output visible in the same window, streamlining your workflow.

### Example: Visual Studio Code (VS Code)

VS Code, a popular IDE, offers excellent terminal integration:

*   You can open the integrated terminal (usually by pressing `` Ctrl+` `` or via the "View" > "Terminal" menu).
*   Run the `dev.log.monitor.sh` script there.
*   VS Code also allows you to **split the terminal** (often using `Ctrl+Shift+5` or by right-clicking the terminal tab). This is particularly useful as you can have one terminal pane for the devLog monitor and another for other commands (like Git operations or running your development server).

By running the live monitor directly within your IDE, you create a compact and efficient debugging environment.

## Advanced Usage and Tips

Here are a couple of advanced tips for using devLog():

### Using devLog on a Production Server

While primarily a development tool, devLog() can be cautiously used on a production server for live monitoring and diagnosing elusive issues. Here's how it's typically approached:

*   **Live Event Monitoring:** Use it to record specific events or data points that can help back-trace technical problems.
*   **Keep 'Off' by Default:** It's crucial that devLog() is not actively logging or exposing debug information by default on a live server. The `dev.log.inc.php` script itself or your application's configuration should control whether devLog is active.
*   **Activate When Needed:** Implement a mechanism (e.g., a configuration setting in your application's admin panel or a temporary configuration change) to enable devLog() when you need to investigate an issue.
*   **Diagnose Without Downtime:** This approach allows you to gather live data from the production environment to understand what's happening under the hood, potentially finding a solution without needing to take the server offline or replicate complex production scenarios in a development environment.
*   **Security Note:** Be extremely cautious about what data you log on a production server and ensure the log file (`dev.log`) and the `devlog` directory are not publicly accessible via the web. The recommendation to place the `devlog` folder outside the public root (mentioned in "Installation and Configuration") is especially important here.

Refer to the `PRODUCTION_HOWTO.md` for more detailed guidance on this topic.

### Command Shortcut Alias: `_dl()`

For convenience and faster typing, devLog() includes a shorter command alias:

```php
_dl('This is a quick log message.', $someData);
```

This `_dl()` function is identical in functionality to `devLog()`.

**Customizing the Alias:**

If the `_dl()` function name conflicts with an existing function in your codebase, you can easily rename it.
1.  Open the `devlog/dev.log.inc.php` file.
2.  Find the line where `_dl()` is defined (it will look something like `function _dl($message, $dump = '', $filter = 0) { ... }`).
3.  Rename the function `_dl` to your preferred alias (e.g., `my_debug_log`, `xlog`, etc.).
4.  Ensure you also update any alias definition if present (e.g. `if (!function_exists('_dl')) { function _dl... }` or similar).

This flexibility allows you to integrate devLog smoothly into any project.

## Usage

To run the tests, you can use the following command:

```bash
python -m unittest discover
```

## Contributing

Contributions are welcome! Please see the CONTRIBUTING.md file for more information.

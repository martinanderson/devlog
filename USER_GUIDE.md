# USER GUIDE

devLog() allows you to quickly output debug messages and variable dumps. It's designed to be simple to use and integrate.

## Basic Usage

The primary function is `devLog()`, and its convenient alias is `_dl()`.

You can pass:
- Just a message: `devLog('Script reached this point.');`
- A message and a variable to dump: `devLog('User data:', $userData);`
- Only a variable to dump (the variable itself will be used as the message context): `devLog($complexObject);`
- A message, a variable, and a filter number: `devLog('SQL Query:', $sqlQuery, 4);`

## Built-in Formatting and Filter Options:

`devLog()` messages can be simple strings, variables, or complex data dumps with formatting and filtering applied via the third argument.

```php
devLog(string $message, mixed $dataToLog, int $filter);
_dl(string $message, mixed $dataToLog, int $filter);
```

Here are the available filters:

---

### Filter `0` — Default Formatting
*   **Description:** This is the default behavior if no filter is specified or if `0` is passed.
    *   If `$dataToLog` is a string, it's logged as is.
    *   If `$dataToLog` is an array or an object, it's formatted using `print_r()`.
    *   Other scalar types (boolean, integer, float, null) are formatted using `var_export()`.
*   **Example:**
    ```php
    $myArray = ['alpha' => 1, 'beta' => 2];
    _dl('Default log of an array:', $myArray); // No filter, defaults to 0
    
    $myString = "Just a simple string.";
    _dl('Default log of a string:', $myString, 0);

    _dl('Default log of a boolean:', true, 0);
    ```
*   **Output for array will be similar to:**
    ```
    Array
    (
        [alpha] => 1
        [beta] => 2
    )
    ```

---

### Filter `1` — `print_r` Output
*   **Description:** Explicitly uses `print_r($dataToLog, true)` to format arrays and objects. Useful for a human-readable representation. For strings and other types, it will behave similarly to `print_r`.
*   **Example:**
    ```php
    $userObject = new stdClass();
    $userObject->id = 101;
    $userObject->name = 'Alice';
    $userObject->tags = ['active', 'php'];
    _dl('User Object (print_r):', $userObject, 1);
    ```
*   **Output will be similar to:**
    ```
    stdClass Object
    (
        [id] => 101
        [name] => Alice
        [tags] => Array
            (
                [0] => active
                [1] => php
            )
    )
    ```

---

### Filter `2` — `var_export` Output
*   **Description:** Uses `var_export($dataToLog, true)` to output a PHP-parsable string representation of the variable. This is useful if you want to see the exact structure and type, or if you want to copy-paste the output back into PHP code.
*   **Example:**
    ```php
    $configOptions = [
        'debug_mode' => true,
        'port' => 3000,
        'features' => null
    ];
    _dl('Config Options (var_export):', $configOptions, 2);
    ```
*   **Output will be similar to:**
    ```
    array (
      'debug_mode' => true,
      'port' => 3000,
      'features' => NULL,
    )
    ```

---

### Filter `3` — JSON Output (`json_encode`)
*   **Description:** Formats `$dataToLog` using `json_encode($dataToLog, JSON_PRETTY_PRINT)`. Ideal for inspecting arrays or objects that should represent JSON structures.
*   **Fallback:** If `json_encode` fails (e.g., due to non-UTF8 characters or recursion depth), `devLog` will note the error and fall back to using `print_r()` for the output.
*   **Example:**
    ```php
    $apiResponse = ['status' => 'success', 'data' => ['id' => 123, 'value' => 'Test Data']];
    _dl('API Response (JSON):', $apiResponse, 3);

    // Example of data that might cause json_encode to fail (e.g., invalid UTF-8)
    // $problematicData = ["message" => "\xB1\x31"]; 
    // _dl('Problematic JSON data:', $problematicData, 3);
    ```
*   **Output for successful JSON will be similar to:**
    ```
    {
        "status": "success",
        "data": {
            "id": 123,
            "value": "Test Data"
        }
    }
    ```

---

### Filter `4` — Basic SQL Formatting
*   **Description:** Provides basic formatting for SQL query strings to improve readability.
    *   Converts the SQL string to uppercase.
    *   Adds newlines before common SQL keywords (e.g., `SELECT`, `FROM`, `WHERE`, `INSERT INTO`, `UPDATE`, `JOIN`, etc.).
    *   Attempts to provide some indentation for common clauses.
    *   This is a simple formatter; it may not perfectly handle all complex SQL syntax or dialect-specific features.
*   **Fallback:** If `$dataToLog` is not a string, it falls back to `print_r()` with a notification.
*   **Example:**
    ```php
    $sqlQuery = "select id, name, email from users where status = 'active' and deleted_at is null order by created_at desc limit 10;";
    _dl('Formatted SQL Query:', $sqlQuery, 4);
    ```
*   **Output will be similar to:**
    ```
    SELECT
        ID,
        NAME,
        EMAIL
    FROM
        USERS
    WHERE
        STATUS = 'ACTIVE'
        AND DELETED_AT IS NULL
    ORDER BY
        CREATED_AT DESC
    LIMIT
        10;
    ```

---

## PRO TIP: Command Shortcut Alias `_dl()`

To save typing time and work faster, you can use the short `_dl()` alias instead of the full `devLog()` function name. Both functions are identical in functionality:

```php
devLog('Latest query details:', $sqlQuery, 4);
// is the same as:
_dl('Latest query details:', $sqlQuery, 4);
```
If the `_dl()` function name is already used in your codebase, you can simply rename it within the `dev.log.inc.php` file.

### More Examples:

```php
devLog('A simple message, no data.');
_dl($someVariable); // Dumps $someVariable using default filter 0
_dl('User details:', $userArray, 1); // Dumps $userArray using print_r
_dl('API Request as JSON:', $apiRequestData, 3); // Dumps as pretty JSON
```

# Live monitoring with shell script

This is where PHP developers get excited. You don't need to keep refreshing the logfile to see your debugging results. devLog() has Live Debug Monitoring scripts included.

Run it in your terminal, throw the terminal window to your other monitor (for example) and just leave it there for the reminder of your working session. All your debugging information will start appearing there live in real time, as you are working and testing your code in the Web Browser.

Or you can run it straight inside your IDE, like in VSCode's integrated terminal for example.

# Debugging examples

Do you have a nice screenshot or video about your devLog() debugging session?
Send it to me and I'll be happy to include it here for the World to see :)

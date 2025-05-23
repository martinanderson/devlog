<?php

/**
 * devLog()  —  Advanced JS console.log substitute for PHP developers.
 *
 * ´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´
 *                       —:: https://github.com/martinanderson/devlog ::—
 *                        —::  Open Source. Feel free to contribute  ::—
 *                                        Version 0.9
 */

// >>>>>>>>>>>>>  Take a look at the "dev.log.kitchensink.php" file for examples! <<<<<<<<<<<<
//                                    ~~~~~~~~~~~~~~~~~~~~~~~
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
// THIS IS WHERE THE MAGIC HAPPENS:
// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

/**
 * Rules:
 *
 * 1. The full path to the logfile is written in the "dev.log.path" file.
 * 2. This file is shared by all scripts (both PHP and Shell), as a logfile location path record.
 * 3. We assume that path record file is "somewhere" under under DIR_ROOT (constant) folder.
 * 4. If DIR_ROOT is not set, set it as __DIR__.
 *
 * The goal of this approach is easy and fast deployment for developers and a possibility for
 * custom deployments to Production servers too, if you should want to include it for that.
 *
 * All you need to do is to:
 * A) Download and extract the devlog scripts
 * B) Set the logfile path in that record file
 * C) include the @include_once('devlog/dev.log.inc.php'); in you PHP code
 * and start debugging with devLog('debugmessage') or _dl($dump) etc calls.
 */

/**
 * Shortcut for devLog() function.
 *
 * @param mixed ...$args Arguments to pass to devLog.
 */
function _dl(...$args): void
{
    devLog(...$args);
}

/**
 * Logs a message and optional data to a specified log file.
 *
 * Searches for a 'dev.log.path' file to determine the log file location.
 * If found and writable, it appends the formatted message and data.
 *
 * @param string $message The primary message to log. Defaults to 'beep'.
 * @param mixed $dataToLog Optional data to dump into the log. Defaults to ''.
 * @param int $filter Optional filter to apply to the dataToLog. Defaults to 0 (no filter).
 *                     1: Human-readable output (print_r)
 *                     2: PHP parsable output (var_export)
 *                     3: JSON encoded output (json_encode)
 *                     4: Serialized output (serialize)
 */
function devLog(string $message = 'beep', $dataToLog = '', int $filter = 0): void
{
    if (!defined('DIR_ROOT')) {
        define('DIR_ROOT', __DIR__); // Default DIR_ROOT to the current script's directory if not defined
    }

    $logPathFileName = 'dev.log.path';
    $pathToDevLogPathFile = null;

    // 1. Prioritize Environment Variable
    $envPath = getenv('DEVLOG_PATH_FILE_LOCATION');
    if ($envPath !== false && file_exists($envPath)) {
        $pathToDevLogPathFile = $envPath;
    }

    // 2. Primary Fallback Location: DIR_ROOT
    if ($pathToDevLogPathFile === null) {
        $potentialPath = DIR_ROOT . '/' . $logPathFileName;
        if (file_exists($potentialPath)) {
            $pathToDevLogPathFile = $potentialPath;
        }
    }

    // 3. Secondary Fallback Location: __DIR__ (directory of this dev.log.inc.php file)
    if ($pathToDevLogPathFile === null) {
        $potentialPath = __DIR__ . '/' . $logPathFileName;
        if (file_exists($potentialPath)) {
            $pathToDevLogPathFile = $potentialPath;
        }
    }

    $logFilePath = null;

    if ($pathToDevLogPathFile !== null) {
        $logPathFileContent = file_get_contents($pathToDevLogPathFile);
        if ($logPathFileContent !== false) {
            $logDir = trim($logPathFileContent);
            if (!empty($logDir)) {
                // Ensure the directory path from the file does not end with a slash, then add /dev.log
                $logFilePath = rtrim($logDir, '/\\') . '/dev.log';
            } else {
                trigger_error('dev.log.path file is empty: ' . $pathToDevLogPathFile, E_USER_WARNING);
            }
        } else {
            trigger_error('Could not read dev.log.path file: ' . $pathToDevLogPathFile, E_USER_WARNING);
        }
    } else {
        // 4. Clear Warning if dev.log.path is not found
        trigger_error(
            'dev.log.path file not found. Looked in DEVLOG_PATH_FILE_LOCATION environment variable, ' .
            DIR_ROOT . '/' . $logPathFileName . ', and ' .
            __DIR__ . '/' . $logPathFileName,
            E_USER_WARNING
        );
    }

    // At this point, $logFilePath is either set to a potential log file path, or it is null.
    // $pathToDevLogPathFile being null means dev.log.path was not found, and a warning was already triggered.

    if ($logFilePath === null) {
        // If $logFilePath is null, it means dev.log.path was not found or was empty/unreadable.
        // A specific warning for this case should have already been triggered.
        // We ensure a generic message if it somehow wasn't specific enough or for an unexpected null path.
        if ($pathToDevLogPathFile === null) {
             // This warning is already triggered if $pathToDevLogPathFile is null by the path searching logic.
             // Adding a return here to make sure no further processing happens.
             return;
        }
        // If $pathToDevLogPathFile was found but $logFilePath is null (e.g. dev.log.path was empty)
        trigger_error('devLog(): Log file path could not be determined (e.g., dev.log.path was empty or unreadable).', E_USER_WARNING);
        return;
    }

    $logDir = dirname($logFilePath);

    // Check if the log directory exists, if not try to create it.
    if (!is_dir($logDir)) {
        // Attempt to create the directory recursively
        if (!mkdir($logDir, 0755, true) && !is_dir($logDir)) { // Check is_dir again in case of race condition
            trigger_error('devLog(): Log directory does not exist and could not be created: ' . $logDir, E_USER_WARNING);
            return; // Stop execution if directory cannot be created
        }
    }

    // Now, the directory should exist. Check writability.
    $canWrite = false;
    if (file_exists($logFilePath)) {
        // File exists, check if it's a directory (error) or if it's writable
        if (is_dir($logFilePath)) {
            trigger_error('devLog(): Log file path points to a directory: ' . $logFilePath, E_USER_WARNING);
            return;
        }
        if (is_writable($logFilePath)) {
            $canWrite = true;
        }
    } else {
        // File doesn't exist, check if the directory is writable for file creation.
        // is_writable on a non-existent file path checks the parent directory.
        if (is_writable($logFilePath)) { // This effectively checks is_writable(dirname($logFilePath))
            $canWrite = true;
        }
    }

    if (!$canWrite) {
        trigger_error('devLog(): No write permissions for log file or its directory: ' . $logFilePath, E_USER_WARNING);
        return;
    }

    // Logfile path is determined, directory exists, and is writable. Let's begin logging.
    $logEntry = "\n[devLog: " . $message . " @ " . date("Y-m-d H:i:s") . "]\n";

    // Add dump data
    if ($dataToLog || $dataToLog === 0 || $dataToLog === 0.0 || $dataToLog === false || $dataToLog === '') { // Ensure that 0, false, empty string are also logged if passed
        $formattedData = '';
        switch ($filter) {
            case 1: // print_r
                $formattedData = print_r($dataToLog, true);
                break;
            case 2: // var_export
                $formattedData = var_export($dataToLog, true);
                break;
            case 3: // json_encode
                $jsonData = json_encode($dataToLog, JSON_PRETTY_PRINT);
                if ($jsonData === false) {
                    $formattedData = "JSON Encode Error: " . json_last_error_msg() . "\nFallback to print_r:\n" . print_r($dataToLog, true);
                } else {
                    $formattedData = $jsonData;
                }
                break;
            case 4: // Basic SQL Formatting
                if (is_string($dataToLog)) {
                    $sql = strtoupper($dataToLog);
                    // Keywords to add newlines before
                    $keywords = [
                        'SELECT', 'FROM', 'WHERE', 'INSERT INTO', 'UPDATE', 'DELETE FROM',
                        'ORDER BY', 'GROUP BY', 'LIMIT', 'VALUES', 'SET',
                        'JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'INNER JOIN', 'ON',
                        'AND', 'OR', 'HAVING', 'UNION', 'CREATE TABLE', 'ALTER TABLE', 'DROP TABLE'
                    ];
                    // Add newlines before keywords, ensuring they are standalone words (not part of other words)
                    // and attempting to respect keywords in potential string literals or comments (basic attempt)
                    // This regex tries to find keywords that are not preceded by a single quote or a double quote
                    // and are not part of an identifier (e.g. MY_SELECT_TABLE)
                    foreach ($keywords as $keyword) {
                        // \b for word boundary, (?<!['"]) for not preceded by ' or "
                        // This is a simplified approach and might not cover all edge cases for SQL comments or complex strings.
                        $sql = preg_replace('/\b(' . preg_quote($keyword, '/') . ')\b(?![^"]*"(?:[^"]*"[^"]*")*[^"]*$)(?![^\']*\'(?:[^\']*\'[^\']*\')*[^\']*$)/', "\n$1", $sql);
                    }
                    // Specific handling for clauses that often start on a new line and are indented.
                    $sql = preg_replace('/(FROM|WHERE|SET|VALUES|ORDER BY|GROUP BY|HAVING|LEFT JOIN|RIGHT JOIN|INNER JOIN|JOIN)\s/', "\n    $1 ", $sql);
                    $sql = preg_replace('/(AND|OR)\s/', "\n        $1 ", $sql);


                    $formattedData = trim($sql); // Trim initial newline if any
                } else {
                    $formattedData = "SQL Filter: Input was not a string. Fallback to print_r:\n" . print_r($dataToLog, true);
                }
                break;
            case 0: // Default: string as is, array/object with print_r
            default:
                if (is_string($dataToLog)) {
                    $formattedData = $dataToLog;
                } elseif (is_array($dataToLog) || is_object($dataToLog)) {
                    $formattedData = print_r($dataToLog, true);
                } else {
                    // For other scalar types like int, bool, float - convert to string
                    $formattedData = var_export($dataToLog, true);
                }
                break;
        }
        $logEntry .= $formattedData . "\n";
        $logEntry .= "[/devLog]\n";
    }

    // Commit to log
        if (file_put_contents($logFilePath, $logEntry, FILE_APPEND | LOCK_EX) === false) {
            // It's often better to trigger an error than to die, especially in a library.
            trigger_error('Can\'t write to the devLog() logfile: ' . $logFilePath, E_USER_WARNING);
        }
    } else {
        // It's often better to trigger an error than to die.
        trigger_error('devLog() has no write permissions to the logfile or logfile path not found: ' . ($logFilePath ?? 'Path not determined'), E_USER_WARNING);
    }
}

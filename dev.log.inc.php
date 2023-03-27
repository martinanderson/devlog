<?php

/**
 

             devLog()  —  Advanced JS console.log substitute for PHP developers.

 ´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´
                      —:: https://github.com/martinanderson/devlog ::—
                       —::  Open Source. Feel free to contribute  ::—
                                       Version 0.9

*/ 



# >>>>>>>>>>>>>  Take a look at the "dev.log.kitchensink.php" file for examples! <<<<<<<<<<<< #
#                                    ~~~~~~~~~~~~~~~~~~~~~~~                                  #
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = #
# THIS IS WHERE THE MAGIC HAPPENS:                                                            #
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = #

/**
	Rules:

	1. The full path to the logfile is written in the "dev.log.path" file.  
	2. This file is shared by all scripts (both PHP and Shell), as a logfile location path record. 
	3. We assume that path record file is "somewhere" under under DIR_ROOT (constant) folder. 
	4. If DIR_ROOT is not set, set it as __DIR__.

	The goal of this approach is easy and fast deployment for developers and a possibility for
	custom deployments to Production servers too, if you should want to include it for that. 
	
	All you need to do is to: 
	A) Download and extract the devlog scripts
	B) Set the logfile path in that record file
	C) include the @include_once('devlog/dev.log.inc.php'); in you PHP code 
	and start debugging with devLog('debugmessage') or _dl($dump) etc calls.

*/

# Shortcut for devLog()
function _dl(...$args) {
	devLog($args);
}

# devLog Main Function
function devLog($message = 'beep', $dump = '', $filter = 0) {
	$devlog_Paths = [];
	$logfile_PathRecordFile = 'dev.log.path';
	$logfile_FullPath = NULL;

	if (null !== DIR_ROOT) {
		define('DIR_ROOT', __DIR__);
	}

	if (DIR_ROOT) {
		$devlog_Paths[] = DIR_ROOT.'/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/devlog/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/web/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/web/devlog/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/www/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/www/devlog/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/html/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/html/devlog/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/public_html/'.$logfile_PathRecordFile;
		$devlog_Paths[] = DIR_ROOT.'/public_html/devlog/'.$logfile_PathRecordFile;
	
	}
	
	# Let's try to find the path record file, first hit will count
	foreach ($devlog_Paths as $value) {
		$logfile_FullPath = trim(file_get_contents(trim($value)));
		if (file_exists(($logfile_FullPath))) {
			break;
		}
	}

	if (touch($logfile_FullPath)) {
		# Logfile has write access, let's begin logging
			
		$message = "\n[devLog: ".$message." @ ".date("Y-m-d H:i:s")."]\n";

		# Add dump data
		if ($dump) {

			# Apply filters 
			switch ($filter) {
				case 1:
					# Desc...
					$message .= $dump."\n";
				break;
				
				case 2:
					# Desc...
					$message .= $dump."\n";
				break;
				
				case 3:
					# Desc...
					$message .= $dump."\n";
				break;
				
				case 4:
					# Desc...
					$message .= $dump."\n";
				break;
				
				default:
					# No filter defined
					$message .= $dump."\n";
				break;
			}
			$message .= "</devLog>\n";
			
		}

		# Commit to log
		if (!file_put_contents($logfile_FullPath, $message, FILE_APPEND | LOCK_EX)) {
			die('Can\'t write to the devLog() logfile:'.$logfile_FullPath);
		}
	
	} else {
		die('devLog() has no write permissions to the logfile:'.$logfile_FullPath);
	}
}


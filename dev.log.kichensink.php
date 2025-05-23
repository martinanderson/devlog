<?php

/**
\____________________________________________________________________________________________
 |:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::|
 |:: devLog() KITCHEN SINK.       EXAMPLES & AWESOME FUNCTIONALITY PLAYGROUND OF KNOWLEDGE ::|
 |:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::|
 |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|
 | Function usage examles. Feel free to play around here and try out devLog's different      |
 | use cases. This file does NOT affect the work of the main function in any way, shape      |
 | or form. Hence the graffiti. Happy debugging, oh my master lord of Code :)                |
 |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|
 | DISCLAIMER: Do not take your job lightly. Today's hour spent debugging may prevent a      |
 | horrrrific and expencive disaster tomorrow. And a fact of life: Lazy people have bugs.    |
 |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~|
 ´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´´
                      —:: https://github.com/martinanderson/devlog ::—
                       —::  Open Source. Feel free to contribute  ::—
 
                                Remember: devLog() === _dl()
*/ 


# GETTING STARTED
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	@include_once('./dev.log.inc.php');
	
# And you're done! 


# EXAMPLE 1  —  Simple
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	# Just a message
	devLog('Hello Bug');

	# Only a variable (using $_REQUEST as $_SERVER can be very large)
	devLog('Request Data:', $_REQUEST);

	# Message and variable
	devLog('I debug REQUEST', $_REQUEST);

	# Two variables (Note: $http_response_header might not always be set)
	# For a more reliable second variable, let's use another global or a simple array
	$mySimpleArray = ['key1' => 'value1', 'key2' => 'value2'];
	devLog($_REQUEST, $mySimpleArray);



# EXAMPLE 2  —  Faster shortcut command, same possibilities
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	# Only message
	_dl('Hello tiny Bug (using _dl)');

	# Only a variable (using a simple string for this example)
	$myString = "This is a test string.";
	_dl('A debug message with a string: ', $myString);

	# Message and variable
	_dl('I dump a _SESSION value (if session started)', isset($_SESSION) ? $_SESSION : "Session not started");

	# Two variables (Note: $http_response_header might not always be set)
	_dl($myString, $mySimpleArray);



# EXAMPLE 3  —  Filter Examples
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	# Filter 0 (Default): string as is, array/object with print_r
	_dl('Filter 0: Default string message (no filter specified)');
	_dl('Filter 0: Default array output (no filter specified)', ['a' => 1, 'b' => 2]);
    $exampleObjectForFilter0 = new stdClass();
    $exampleObjectForFilter0->property = "value";
    $exampleObjectForFilter0->nested = ['x' => 10, 'y' => 20];
	_dl('Filter 0: Default object output', $exampleObjectForFilter0);
	_dl('Filter 0: Default boolean true', true);
	_dl('Filter 0: Default boolean false', false);
	_dl('Filter 0: Default integer 0', 0);
	_dl('Filter 0: Default float 0.0', 0.0);
	_dl('Filter 0: Default empty string', '');


	# Filter 1 (print_r): Human-readable output using print_r
	_dl('Filter 1: print_r output for an array', ['name' => 'DevLog', 'version' => 0.9, 'features' => ['logging', 'filters']], 1);
	$exampleObjectForFilter1 = new stdClass();
	$exampleObjectForFilter1->user = "Test User";
	$exampleObjectForFilter1->id = 12345;
	_dl('Filter 1: print_r output for an object', $exampleObjectForFilter1, 1);


	# Filter 2 (var_export): PHP parsable output using var_export
	$exampleVarForFilter2 = (object)['type' => 'example', 'value' => 42, 'nestedArray' => [1, 2, "test"]];
	_dl('Filter 2: var_export output for an object', $exampleVarForFilter2, 2);
    _dl('Filter 2: var_export output for an array', ['item1', 'item2', 3 => 'item3'], 2);


	# Filter 3 (JSON): JSON encoded output using json_encode (with JSON_PRETTY_PRINT)
	$jsonDataForFilter3 = ['user' => ['id' => 123, 'name' => 'John Doe'], 'status' => 'active', 'roles' => ['editor', 'viewer']];
	_dl('Filter 3: JSON output for an array', $jsonDataForFilter3, 3);
    $jsonObjectForFilter3 = new stdClass();
    $jsonObjectForFilter3->productName = "Awesome Gadget";
    $jsonObjectForFilter3->price = 99.99;
    $jsonObjectForFilter3->tags = ["tech", "gadget", "cool"];
	_dl('Filter 3: JSON output for an object', $jsonObjectForFilter3, 3);
	// Example for json_encode failure fallback (e.g., with non-UTF8 data)
	// Note: PHP might handle some invalid UTF-8 gracefully or produce null depending on version/settings.
	// This specific string is intended to cause a json_encode error.
	if (function_exists('iconv')) {
		_dl('Filter 3: JSON fallback due to invalid UTF-8', iconv('UTF-8', 'ISO-8859-1//IGNORE', "Euro sign: € then invalid \xB1\x31"), 3);
	} else {
		_dl('Filter 3: JSON fallback test skipped - iconv not available to create invalid UTF-8 string.');
	}


	# Filter 4 (SQL Formatting): Basic SQL query formatting
	$sqlQueryForFilter4 = "SELECT id, name, email FROM users WHERE status = 'active' AND age > 30 ORDER BY created_at DESC LIMIT 10;";
	_dl('Filter 4: SQL output (SELECT query)', $sqlQueryForFilter4, 4);
	
	$anotherSqlForFilter4 = "update tasks set status='done', modified_by=1, description='Completed task with sub-clauses like AND and OR for testing' where id=5 AND user_id=10 OR project_id=2;";
	_dl('Filter 4: Another SQL output (UPDATE query)', $anotherSqlForFilter4, 4);

    $insertSql = "INSERT INTO logs (level, message, context) VALUES ('info', 'User logged in', '{\"user_id\": 123, \"ip\": \"192.168.1.1\"}');";
    _dl('Filter 4: SQL output (INSERT query with JSON)', $insertSql, 4);

    $complexSelect = "SELECT u.id, u.name, p.title FROM users u INNER JOIN posts p ON u.id = p.user_id WHERE u.status = 'active' AND p.published_date > '2023-01-01' GROUP BY u.id HAVING count(p.id) > 5 ORDER BY u.name ASC;";
    _dl('Filter 4: SQL output (Complex SELECT query)', $complexSelect, 4);


# Old "More advanced options" - these will just beep or log default message
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
	devLog('Default beep (no arguments)'); // Actually logs "beep"
	_dl('Another default beep (_dl with one arg)'); // Logs "Another default beep (_dl with one arg)"
	_dl(); // Logs "beep"

# DONE
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

print 'Don\'t see any errors or messages on this page? That\'s normal! Check the log the file (dev.log by default) or live terminal if you are using dev.log.monitor.sh. ';
print 'You should have many debug messages from devLog() there waiting if you are reading this :) ';
print 'Check out the "dev.log.kichensink.php" source code for usage examples.';

?>

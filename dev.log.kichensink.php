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

	# Only a variable
	devLog($_SERVER);

	# Message and variable
	devLog('I debug', $_SERVER);

	# Two variables
	devLog($SERVER, $http_response_header);



# EXAMPLE 2  —  Faster shortcut command, same possibilities
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

	# Only message
	_dl('Hello tiny Bug');

	# Only a variable
	_dl('A debug message: '.$_SERVER.' -- combined in any way you like it');

	# Message and variable
	_dl('I dump a _SESSION value', $_SESSION);

	# Two variables
	_dl($SERVER, $http_response_header);



# EXAMPLE 3  —  More advanceed options
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


# EXAMPLE with 
devLog();

# EXAMPLE with 
devLog();

# EXAMPLE with 
devLog();







# DONE
# = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

print 'Don\'t see any errors or messages? Check the log the file or live terminal. ';
print 'You have 10+ debug messages from devLog() there waiting if you are reading this :) ';
print 'Check out the "dev.log.kichensink.php" source code for usage examples.';


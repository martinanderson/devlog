#!/bin/bash
#
# DevLog logfile monitoring from your Linux terminal/shell. 
# For real-time debugging of your custom PHP events at development time.
# =============================================================================
# PS! Make sure that A) this file is executable: 
# and B) the log file is writable by the web server: 
# $ chmod 774 dev.log.monitor.sh && chmod 666 dev.log
# 
# How to use?
# 1. Create events in PHP you want to monitor with DevLog($message, $dump);
# 2. For live monitoring simply run this script in your terminal:
# $ ./dev.log.monitor.sh
#
# Or just view the dev.log file with your favorite editor/IDE.
# =============================================================================
# More info @ https://github.com/martinanderson/devlog

clear

DEVLOG_PATH=$(<./dev.log.path)
DEVLOG_PATH+="dev.log"

if [ ! -e $DEVLOG_PATH ]; then
   echo "Creating empty dev.log file."
   touch $DEVLOG_PATH
   chmod 666 $DEVLOG_PATH
fi

echo "reading $DEVLOG_PATH"
echo "dev.log monitoring is live, waiting for events..."
echo "(ctr+c to exit)"
echo
echo
tail -f -n300 $DEVLOG_PATH

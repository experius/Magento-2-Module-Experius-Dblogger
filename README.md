# Experius Database logger

Stores logs to database instead of files and a custom grid to see this data.

Log() function requires 4 parameters
- $module - the name of the module
- $action - the name of the function/action that triggers the log
- $message - the message that needs to be logged to the database
- $type - Success, Error, Notice, Exception, Warning

## TODO

Support to take over PSR Logger.


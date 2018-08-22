# Experius Database logger

Stores logs to database instead of files and a custom grid to see this data.

Log() function requires 4 parameters
- $module - the name of the module
- $action - the name of the function/action that triggers the log
- $message - the message that needs to be logged to the database
- $type - Success, Error, Notice, Exception, Warning

## TODO

Support to take over PSR Logger.

## Change log

Version 1.1.0 - August 22, 2018 | Lewis Voncken & Casper Frericks

- FEATURE: Updated the Log Grid View and added a Log View

Version 1.0.3 - September 01, 2017 | Rene Schep

- BUGFIX: Old logs are now actually removed by cron

Version 1.0.2 - May 15, 2017 | Rene Schep

- BUGFIX: Fix cleanlog task so it actually runs 

Version 1.0.1 - April 25, 2017 | Rene Schep

- Changed how date is displayed in log grid

Version 1.0.0 - March 21, 2017 | Rene Schep

- Initial Module

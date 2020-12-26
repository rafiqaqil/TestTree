
<p align="center">

</p>

## Project Code name TestTree

Hierarchical Tree Bases Bonus System 

- Sponsor Rules 4 Levels = 10 2 2 1

- M5 - Rules 1 OR 6 Owners
- M3  - Rules Grown After M5 Reaches 5 Descendants 

--------------------------------------------------------------------------------

## Addition System Setup Notes

### Laravel Scheculer 
Midnight Pooling Credit every Midnight
Calculate Balance all Trees every Hour, cronZZ.log is where the log for errors will be if anything happends check there.
#### CPANEL
CRON Job must run task schedule:work
/usr/local/bin/ea-php73 /home/edmuk/EDM5/artisan schedule:run >> /home/edmuk/EDM5/setup.cronZZ.log

### PHP Top-Layer System
Public User -> Maintenance redirection
Using If Statements to redirect users during closing hours
Can be set on the index.php on Public HTML

Admin User -> Maintenance Override
Using Session PHP Code AccessKey Will by pass if Statement on Public Maintenance Portal
ACCESS KEY is FIXED ON the php file if statement, maybe later can use the app key instead access from env. for more uniform setting control
https://www.e-dm5.uk/Members/index.php?accessKey=6df845seda65f4ewr98vbg4s65d4fvc89ewr4gv65ew4rv4er65v48e9r4rv4er6v4e6r5v4e65r4v89e

## Setup Daily Backup
Using mysql dump command save databse to file in server 
#### CPANEL
CRON JOB 
date=`date -I`; mysqldump -u edmuk_admin -pAmirul12 edmuk_2 >> /home/edmuk/backup/EDM5-Backup-$date.sql



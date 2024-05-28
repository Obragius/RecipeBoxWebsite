# Recipe Box Website
As part of my Kingston University course, I have been tasked with building a PHP website hosted on kunet. 
- The website theme was set as recipe boxes which can be ordered through the website. 
- The administrator of the website would need to add and edit recipes.
- The website would need to consider security through addressing XSS and SQL injection attacks.
- The website also uses AJAX to ensure that less redundant data is transferred.

## The Website
The website used sessions to ensure that data can be saved in a session, such as user data. 
This has been used to dynamically change the user experience and allow logged-in users and admins to use additional functionality.
### User view
- Home page
- Single Recipe page
- Login page/ Create Account page
- Cart page
- Checkout page
### Admin view
- Edit Food page
- Edit Recipe page
The orders could be seen using views added in the Phpmyadmin extension, to allow the admin to fulfil the order.

## The Showcase Journey
### Background
I already have bought a server and installed Apache to serve a website with this stack,
however, I had to remove this website, as I had to develop a new website, and could not host both
due to project requirements. The new goal was to allow for a local showcase of this website, so easy,
anybody can run it with a few clicks. (Using PHP DEVSERVER and USB Server would cheating).
### Goals
- Apache Local Host
- PHP integrated
- Mysql with access through Phpmyadmin
- Setup and run with a few clicks
### Journey
First I would like to say thank you to *rrich360* for the great tutorial which aided me in the journey (Available at [GitHub Tutorial](https://github.com/rrich360/Apache2.4-PHP7-MySQL-phpMyAdmin-manual-configuration))
#### Apache24
The goal was to allow showcase for Windows machines, therefore I have downloaded Apache24 as the server to host the files.
Apache24 requires the settings of the server to be edited in the conf/httpd.conf. There all the relevant modules have uncommented,
however, the real challenge was to set all the paths relatively to allow for a portable setup. 
All the paths have been set using this style
- Define SRVROOT "../"
- DocumentRoot "${SRVROOT}/Apache24/htdocs"
- PHPIniDir "../Apache24/php"
#### PHP
I have downloaded php and extracted it into the Apache24 folder so that it can be found in the same package.
The settings for the PHP are in the php folder found in the php.ini file.
All the required extensions have been uncommented and paths set relatively
- extension_dir = "ext"

It was found that the application does not work if PHP is not set as an environmental variable.
This is done by the setup.bat file which adds the php folder to the system environment variables.
Httpd.exe also needs c++ Redistributable 2019 to work, so vcruntime140.dll has been added to the php folder
so that they can be accessed from anywhere, however, this has not been confirmed to fix the dependency, so installation of VCredist might be required.
#### Phpmyadmin
This extension has just been added to the docs to allow users to log in to the DB.
#### MySQL
This has also been added to the Apache24 folder.
my.ini file has been altered to contain a relative path to the data folder called DataFolder in Apache24.
launchSQL.bat launches mysqld.exe with my.ini file as the main configuration.
#### Data
The website-hosted data such as all the PHP files have been modified to contain relative paths instead of web URL paths from the assignment.
These are located in the Apache24/htdocs.
The DB data has been copied from the DB used in the assignment. This was first imported, and then copied from the data folder into the Apache24/DataFolder
The access to the database for showcase can be gained using (root root)
#### Finish
To allow running the website, a launch.bat file has been added to the top-level folder, which runs the httpd.exe file and launchSQL.bat to allow the pages to be served
and access the database for any persistent information. After the server is running, the bat file opens url file which leads to localhost/Controller/home.php which is
the homepage of the website. To terminate, close the new tab, and press enter key in the first command prompt which will close both servers.

## Release
The release of this website can be found as the latest release for this repository with the relevant install and run instructions.

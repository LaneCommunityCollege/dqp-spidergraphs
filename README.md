DQP-Spidergraphs
================

This is the repository for the DQP in Oregon Spidergraphs.  The Degree Qualifications Profile in Oregin is part of the national
Degree Qualification Profile project through The Lumina Foundation.

The Spidergraphs are designed to allow individual institutions to input their institution, program and course
outcomes and view them in a graphical way.
  
## Server Config ##
The application was written using PHP (5.x) and MySQL (5.x) on a Linux server.  PHP and MySQL are used conservatively, so you should be able to install this on any server with current versions of PHP/MySQL and have it up and running within a few minutes.

## Install ##
1. Download the lastest version
2. Unzip the archive
3. Rename settings.inc-SAMPLE.php to settings.inc.php and edit to match your database server
4. Upload the files to a folder on your server
5. Visit [your_server_address]/[folder_name]/install.php (example: http://oregondqp.org/spidergraphs/install.php)
6. Follow the instructions
7. DELETE install.php so that your database doesn't get overwritten by accident later.

## Use ##
For details on using the spidergraphs, please download https://www.oregondqp.org/documents/Spidergraph/SPIDERGRAPH%20How%20To.pdf

## Question/Comments? ##
Matt Danskine  
Oregon DQP Web Application Developer  
danskinem@lanecc.edu  
www.oregondqp.org

## License ##
In the spirit of openness, the DQP project has always had a goal of sharing any materials we develop over the course of the DQP grant. 

In keeping with that spirit, at the October, 2012 conference at Lane, we decided to release our materials under the MIT License.  

For more information, please visit http://opensource.org/licenses/MIT

## Changes ##
v1.0 - 6/24/2013 - Initial release of PHP/MySQL based (non-Django) version of the spidergraph.
v1.01 - 1/7/2014 - Added SESSION var to update and delete lines so you can only update/delete items from your own institution.

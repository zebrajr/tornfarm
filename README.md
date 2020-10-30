# tornfarm
To Deploy:
- Clone or make the files deploy.sh.sample and docker-compose.yml
- Rename deploy.sh.sample to deploy.sh and edit to your own information
- Set the deploy.sh to executable (sudo chmod +x deploy.sh) and run it (./deploy.sh)
- Start the container with docker-compose (docker-compose up OR docker-compose up -d)
- Stop the container and edit the newly created settings.conf
- Start the container again

To Build:
- Move to Current (cd Current)
- docker build --tag <your-tag:your-version> .

#IMPORTANT!!!  
Only Relevant to the "Legacy" Edition <br />
This Version is Deprecated and will no longer be updated or maintained.<br />

A python script that scraps the TORN Text-Based MMORPG Player Database and indexes it, and a front and backoffice in PHP / MySQL to use that information


If you are deploying this do as following:

- 1) Have Python

(3.8.1) is what I'm using and check the import on the torn_farm_cloud.py.

Ps.: Sorry I forgot to write down which modules I installed with pip, but feel free to open an issue / discussion
and tell me which modules you had to install. It should easy to debug because the import is basically the first
result of the pip repository.


- 2) Have Apache, MySQL and PHPMyAdmin


installed or similar and deploy the database. I Recommenx XAMPP / LAMPP depending
on your OS if you are starting stuff like this.


- 3) Search for [:DEPLOY]


you will find everything that you have to configure to your own lab to have it running.

- File Description

[:TODO] This should be moved to each individually file description.


- config.php						Configuration File for the MySQL on the PHP Side

- functions.php					Functions and Procedures used in the PHP Files

- functions_header.php			Functions and Procedures used in the PHP Headers

- index.php						Main PHP File

- mysql_create_tables				SQL Syntax to create the required database tables

- start_torn_farm_cloud_py		Starts the main scrap and sends the ProcessID to a file so you can kill it if needed

- torn_farm_cloud.py				Python Script that Scraps the Torn Player Database for Public Information



Ps.: Feel free to improve :)

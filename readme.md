# pre requirment 
- composer
- git
- xampp
- php
# Setup 
- clone the project in xampp htdocs folder
> git clone https://github.com/SoumenITMO/php-helms.git
- make a copy of .env.example file in root to .env and place database connection, 
- also assign APP_KEY= base64:APzCKCSKi7zYSrciNUY43D4mML3ee4y6no3+TLNqt8w=
- create database "helms_task" in MySQL and use this database name in .env file
- Import "helms_task.sql" located in "DB" folder of this project in MySQL using phpMyadmin, or other way.
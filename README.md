This is a simple blog application.

## Setup
You need PHP 5, mySQL and some kind of sever software (Apache was used for development) to run it. XAMPP is recommended as it comes with all three.

Once you have installed the above software, clone the repository or download the .zip. Create a folder in your server's root directory and extract the files to that location.

Once you have done so, set up the database. Create a database for the blog. Set up the tables using the commands in `schema.sql`. Create a custom user with `Select`, `Insert`, `Update` and `Delete` privileges. Then, modify the details in `config.php` (in the folder includes) to reflect your setup.

Start the server and access the blog through a browser. The address used to access `index.php` is `localhost/[blog directory name]/index.php`. 

## Features
* User accounts
* Post creation, edition and deletion
* Filter by author
* Styled with Bootstrap

## Tech Stack
* mySQL
* PHP 5
* jQuery 2.1
* Bootstrap 3

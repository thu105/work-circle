# WorkCircle
A social networking app for internal employees.

## Stack
The app will primarily be using PHP, Apache, and MySQL with some CSS and JS.

## Setup
1. Install [XAMPP](https://www.apachefriends.org/) or [MAMP](https://www.mamp.info/en/downloads/) and run the web server. Make sure both Apache and MySQL are running and configured. For profile images, you need to enable the GD extension in XAMPP as shown in this [guide](https://www.geeksforgeeks.org/how-to-install-php-gd-in-xampp/).
2. Locate the `htdocs` folder that your Apache server is referencing. Either edit the `index.php` file in that folder to point to the repo or paste the source PHP files into the folder.
3. Make sure you update the database credentials in `funcions.php` to point to your MySQL server.
4. Run `setup.php` to create tables used by this app.

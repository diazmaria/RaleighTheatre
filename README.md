## Raleigh Theatre Booking System

This ticketing system is a an assignment which I did for the Advanced Databases and the Web module I took at Kingston University London (2014-2015).

### Business requirements outline
1. Users can browse and search for productions in various categories.
2. Users have the ability to browse and create a basket of items, without necessarily logging-in.
3. Users can order items from their shopping basket (although handling payment is not required in this prototype).
4. Users are informed when their order is accepted (they will recibe an email with the purchase details).
5. Theatre staff (“administrators”) can create, update and delete production and performance entries.
6. Users can gather automatic updates to the online catalogue by accesing to “latest productions on the homepage” .



### Technologies
- **PHP**
- **HTML**, **CSS**, Bootstrap, jQuery, SQL, MySQL and Apache HTTP Server



### License
This project is licensed under the [Apache 2 License](http://www.apache.org/licenses/LICENSE-2.0). 



### Run the Web App Locally
Below there is an explanation of how to run the web app locally using WAMP or XAMPP (you can also separately install and configure Apache and a SGBD if you would prefer).

1. Clone the repository or download the zip file.
2. Place the project folder or extract the zip file into the **htdocs** folder (XAMPP) or **www** folder (WAMP).
3. Create a new database and import the .sql file attached into it (you can use phpMyAdmin for this duty).
4. Modify your database connection values (username, password and database name) in the file RaleighTheatre/includes/**database.php**.
5. Run XAMPP or WAMP and go to: http://localhost/RaleighTheatre/index.php



### Demo
<center>
	![demo](http://i1030.photobucket.com/albums/y369/MariaPhotoB/RaleighTheatre_zpsc3jn81s4.gif)
</center>
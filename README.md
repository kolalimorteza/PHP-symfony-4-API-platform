# Testing task
Description

Database product (product.sql) stores information about products . 
Write a small API that uses a database backend. 
A REST API should use HTTP as it was originally envisioned. This means the use of GET, POST, PUT and DELETE. To lookup data our REST API needs to use GET. For creation we use POST, for mutation of our data we use PUT and last but not least we use DELETE for deletion. Yes, creating a Restful application is making full use of HTTP.
Write a small API that uses a database backend. 
The main data entity in your API is a "product". A product must have the following fields/properties: 
●  ID (integer, assigned automatically) 
●  Name (alphanumeric, at most 100 characters) 
●  Price (decimal, with 2 decimal places) 

1. Implement API calls for creating, updating and deleting these records. 
2. Implement API calls for retrieving a list of products, and for searching a product by name. 
3. Ensure that the API calls have proper error handling, and output sensible error messages. 
4. Document the API: explain the proper way to use it. Assume that the reader is not familiar with the API, and will be using it as a service (having no access to the source code). 
Write the application in PHP. Use a MySQL database. 
Please submit: 
●  API source code (including a README file with deployment instructions); 
●  SQL schema description; 
●  Documentation. 

### PHP Symfony API framework
Now we are ready. We defined that all our REST actions are on /api. And we will be using the JSON format.
## How to run

* Create db product
```sql
CREATE DATABASE product CHARACTER SET utf8 COLLATION utf8_general_ci;
```
* Import data to database. run product.sql in MySQL.
* Use command `php bin/console debug:router` list of all API.
* Run php symfony by use this `php -S 127.0.0.1:8080 -t public/`.
* At the moment you can run Postman app for test API.
* All our Rest calls should be prefixed by /api
* 1. We use POST to create a resource. 
* You can test this by executing the following request:
 `POST /api/add (http://127.0.0.1:8080/api/add)`
 ### Preview
  <img src="https://i.imgur.com/4QcJoJY.jpg" width="400">
* 2. The next on the list is GET list of products.and for searching a product by name and id.
* You can test this by executing the following request:
```sql
`GET /api/{page} (http://127.0.0.1:8080/api/{})`;
```
 1. `GET /api/{page} (http://127.0.0.1:8080/api/{})`
 2. `GET /api/product/{id} (http://127.0.0.1:8080/api/product/{2})`
 3. `GET /api/product/{Name} (http://127.0.0.1:8080/api/product/post!)`
* 3. The next on the list is PUT updating of product by id.
* You can test this by executing the following request:
 `PUT /api/update/{id} (http://127.0.0.1:8080/api/update/2)`
 * 4. The next on the list is DELETE deleteing of product by id.
* You can test this by executing the following request:
 `DELETE /api/product/{id} (http://127.0.0.1:8080/api/product/2)`

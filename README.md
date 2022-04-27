# Web system for managing the sale of natural medicines

Web system developed to facilitate the administration of a natural medicine sales business. This system is made up of two parts:

* **Administration panel**: Its purpose is to facilitate the administration of the business, allowing:
    * **C**reate, **R**ead, **U**pdate and **D**elete products
    * **C**reate, **R**ead, **U**pdate and **D**elete customers
    * **C**reate, **R**ead, **U**pdate and **D**elete sales
    * Get statistical data on sales and products
  
  <br>

* **Website**: Its purpose is to provide customers with information on existing products, both their price and availability, likewise, it allows you to add a comment and/or like the products; Additionally, it allows you to search for products by name or filter them by category.

## Visuals

Coming soon


## Requeriments

 - [Nodejs (npm)](https://nodejs.org/en/)
 - [Composer](https://getcomposer.org/download/)


## Installation
### Write permissions:
```bash
sudo chmod -R 777 storage
sudo chmod -R 777 bootstrap/cache    
```

### Install dependencies:
```bash
composer install
npm install
```
    

### Generate configuration file
In the root of the folder rename the file `.env.example` to `.env` or use 
```bash
cp .env.example .env
```
    

### Generate API Key
```bash 
php artisan key:generate
```
    

### Migrations.
  * Create a database using phpmyadmin or the mysql console.
  * Open the .env file from Generate Configuration File.
  * They are placed in the MySQL section (line 11 approx.)
  * There you edit the value of the DB_DATABASE field, placing the name of the database you created. The result is DB_DATABASE=databaseName.
  * Then just run the migrations with
    ```bash
    php artisan migrate --seed
    ```
    **Generates migrations and populates the DB with default data**

  * Utilities  
    This deletes all the tables from the database
    ```bash
    php artisan db:wipe
    ```

    This deletes all the tables from the database and recreates all the tables. The --seed option populates the DB with default data
    ```bash
    php artisan migrate:refresh --seed
    ```

    
 ### Starting a local development server
 ```bash
php artisan server
```

---

<div align="center">
    <img src="https://user-images.githubusercontent.com/56330832/165605109-fbb781e5-6ee2-4ff9-afdf-f0be80ced013.svg" width="15%">
<div>
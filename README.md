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

### Dashboard
https://user-images.githubusercontent.com/99099658/176796400-b12562cf-5f78-4f6f-a34d-03fa5e71ed49.mp4

### Products
https://user-images.githubusercontent.com/99099658/176798487-48edfce1-1d2a-4660-9c34-e701c2f19354.mp4

https://user-images.githubusercontent.com/99099658/176796966-9dfc4fe2-1464-4128-86d6-ea245c2a9764.mp4

https://user-images.githubusercontent.com/99099658/176797134-94b3e8c3-a9cf-4db0-a172-a3d23918b359.mp4

https://user-images.githubusercontent.com/99099658/176797242-f3a1fb26-1b24-4629-b133-324b8b413d8c.mp4

https://user-images.githubusercontent.com/99099658/176797307-995089a2-5dab-40a8-bfce-e861fa8a18e8.mp4

### Customers
https://user-images.githubusercontent.com/99099658/176797509-0f74e03a-d4f6-4f9d-aaf1-1e65acd4d813.mp4

https://user-images.githubusercontent.com/99099658/176797556-a38326d3-3980-4391-82a1-75da471172f0.mp4

https://user-images.githubusercontent.com/99099658/176797625-f8f5b131-1784-4ad7-b091-2f7a06889373.mp4

https://user-images.githubusercontent.com/99099658/176797683-df3412ea-801f-4292-84f2-6a4ed47098e0.mp4

https://user-images.githubusercontent.com/99099658/176797709-4eef31ca-4f51-417d-8d1f-428164854d39.mp4

### Sales
https://user-images.githubusercontent.com/99099658/176797776-7fa13570-e049-497d-ae62-79689058d84a.mp4

https://user-images.githubusercontent.com/99099658/176797931-18b2589d-f040-4137-a944-1e284a8e172d.mp4

https://user-images.githubusercontent.com/99099658/176797985-c5604902-dd8c-414a-b281-acb535f5303a.mp4

https://user-images.githubusercontent.com/99099658/176798036-7a7f33f0-3232-4a71-b1d7-0b359bf18a3f.mp4






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

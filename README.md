# i4tech_test

## This project includes 3 docker containers 
    1. Database > db_i4t
    2. Nginx > nginx_i4t
    3. Php > php_i4t
## Run the project 

   ##  Clone the project and  run command 
      `docker compose up -d`
   ## Change the .env file database credentials 
          DB_CONNECTION=mysql
          DB_HOST=db_i4t
          DB_PORT=3318
          DB_DATABASE=i4t
          DB_USERNAME=root
          DB_PASSWORD=test     
   
   ## Once Container is getting up run the following commands 
      `docker exec -it php_i4t composer install;`
      `docker exec -it php_i4t php artisan passport:install;`
      `docker exec -it php_i4t php artisan migrate;
       docker exec -it php_i4t php artisan db:seed;

   ## Please import postman environment and collection and execute the API (collection located root folder )    
      
     
      

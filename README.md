# Quizrun
## Educational site
#### It is a site to display and add courses by the teacher.

# Built with
For our frontend design, we have used the following frameworks:
* Bootstrap v.5
* Blade Templates

For the backend:
* Laravel v.8

# Key Features
 * add a teacher
 * add student
 * add a course
 * Add a section
 * add category
 * add group
 * Add a new role with permissions


# Getting Started 
This is an example of how you may give instructions on setting up your project locally. To get a local copy up and running follow these simple example steps.

# Prerequisites
PHP and Composer should be installed:
This is how to install it if you're using Windows:
```
php composer-setup.php --install-dir=bin --filename=composer
```

# How To Use
To clone and run this application, follow the follwing instructions:
* Clone the project from this GitHub repository
* Download the project through this command of Laravel Composer
```
composer create-project laravel/laravel project
```
* Now, create a new folder in the laravel project you have just created, namely, vendor. And take the content of this folder from the project repo. Then, create a file named .env and also paste the content of this file from the project repo.
* Then you need to create a new database. Put the connection details (host, username, password) in the .env file you have already created.
* Now, you need to install the Fortify, and laravel-to-uml packages using these commands:
 ```
composer require laravel/fortify
composer require andyabih/laravel-to-uml --dev
```

     
* Now, in order to let the reset password feature to run, create an account on Mailtrap, select the Laravel environment, go to .env file and paste the instructions from Mailtrap in there. Do not forget to pass any dummy email in the MAIL_FROM_ADDRESS. eg, team@test.com
* Finally, to run the project in your IDE:
 ```
php artisan migrate
php artisan db:seed
php artisan serve
```
Now you are ready to go and enjoy Quizrun on your browser :)!

# Implementation
#### Laravel is based on MVC (Model View Controller) Design Pattern. We have also used two other design patterns:
#### The first one, is, factory design pattern. We use this design pattern in importing a database, exporting, and the version control. This will increase the system scalability, in case a new type of files is required to be added. The factory design pattern allows us to handle any other types of files without the need of editing on the source code.
#### The second design pattern we have used, is, singleton. We have implemented it in the connection profile. Singleton design pattern allows the client to create only one instance, and so this will prevent different types of users to edit on the same file program at the same time.

### Below is the logic of our work:

#### 1. add a teacher 
#### Adding a teacher The teacher logs in and sends his certificate to verify his identity until he is approved.


#### 2. add student
#### Students can register on the site. 


#### 3. add a course
#### The teacher can add courses that contain sections within a group

#### 4. add category
#### The teacher chooses the type of course according to the list that the site admin added.


#### 5. Add a section
#### The teacher can add it to any course he created. 

#### 5. Add a group
#### The teacher can create his own group and then add courses that contain sections. 

#### 6. Add a new role with permissions
#### Using the models, we were able to apply a many-to-many relationship between the roles and permissions. Using the seeder feature, we were able to define all users permissions that would be in the system.
#### In the same seeder, we were also able to define the main four roles in our system: Super-Admin, Admin, Staff, and Reader. We assigned the permissions for each role. 
#### In the Role Controller, we have handled the edit-permission functionality. 

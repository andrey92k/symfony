## Description
This project is a movie browser, using data from the Movie DB OMDb API, also the ability to work with CRUD movies.

The application includes the following features: 
- Search and detail view movies, using OMDb API
- List movies (CRUD) 
- List actors (CRUD) 
- Categories (CRUD) for movies 
- Comments users on movies 
- Authorization and authentication

## Stack
- Symfony 6 
- Mysql 8 
- PHP 8.1 
- Redis
- Unit Testing

## Goal
Skill Up:
- Libraries and Frameworks
- Object-Oriented Design
- Databases (Design and Development)
- Unit Testing

## Project initial setup
```
git clone https://github.com/andrey92k/symfony.git
composer install
php bin/console doctrine:migrations:migrate
symfony server:start
```

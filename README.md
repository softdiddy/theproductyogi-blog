# TheProductYogi Blog

This is a simple blog application built with Laravel. The application allows users to create, edit, and delete posts. Admin users have additional privileges such as deleting any post.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Running Tests](#running-tests)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0
- Composer
- MySQL
- Node.js and npm (for front-end assets)

## Installation

1. **Clone the repository**

   git clone https://github.com/softdiddy/theproductyogi-blog.git
   cd theproductyogi-blog
   
2. **Install dependencies**
   composer install,
    npm install,
    npm run dev

## Environment Setup
1. Copy the example environment file and configure the environment variables
   cp .env.example .env
   
2. Generate an application key
   php artisan key:generate
   
4. Run seeders
   php artisan db:seed

   This will create two users:

    *Admin User
    Name: Mohammed Lawal Abubakar
    Email: softdiddy@gmail.com
    Password: 12345678
    Role: admin
   
    *Regular User
    Name: Amina Abubakar
    Email: tata@gmail.com
    Password: 12345678
    Role: user

   You can login with any of the above user or create a new user

   Running the Application
   1. Start the local development server
      php artisan serve
      
      Your application should now be running on http://localhost:8000.

   Running Tests
       php artisan test


    Additional Information
        User Roles
        Admin: Admin users can create post, edit post, and delete his/her own post, admin can also delete any post created by any user
        User: Regular users can create posts and edit/delete only their own posts.
   
        Middleware
        The application uses middleware to check user roles and permissions. Refer to the app/Http/Middleware directory for custom middleware implementations.
        
        Security
        Passwords are hashed using Laravel's built-in hashing mechanisms.
        CSRF protection is enabled for all routes by default.
        Frontend
        The frontend is built using Blade templates.


## About Mini Campaign App

The Mini Campaign App is a web-based application designed to simplify the process of creating and managing email marketing campaigns. It allows users to easily create personalized email campaigns by uploading a CSV file containing contact details and automatically sending emails using a predefined HTML template. This app is built with a focus on efficiency, scalability, and maintainability, following SOLID design principles.

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Key Features:
User Authentication:

Secure login and registration system.
Only authenticated users can create and manage campaigns.
Frontend Interface:

Built with Vue.js, offering a responsive and user-friendly interface.
Users can create campaigns, upload CSV files, and track campaign progress.
CSV File Upload and Validation:

Users upload a CSV file containing recipient details (name and email).
The system validates the CSV file to ensure all fields are correctly formatted.
Email Campaign Creation:

Campaigns are created with a name and associated CSV file.
A predefined HTML email template is used, with dynamic placeholders for recipient names.
Campaign Processing:

Campaigns are processed in chunks using Laravel's queue system to handle large numbers of emails efficiently.
The system tracks the progress of each campaign, ensuring scalability and preventing server overload.
Notifications:

Users receive email notifications once their campaign has been processed successfully.
Deployment and Documentation:

The app is deployable to any cloud platform with a clear and comprehensive documentation.
A video demonstration and GitHub repository are provided to showcase the functionality.
Testing:

Comprehensive unit tests are written using PEST to ensure that all critical functionalities, like CSV validation and email sending, work as expected.

## Technical Stack:
- Backend: Laravel (PHP) (version 11)
- Frontend: Vue.js (version 3) (JavaScript/TypeScript)
- Database: sqlite
- Testing: PEST

## Use Cases:
- Small Businesses: Easily manage email marketing campaigns without needing complex software.
- Marketing Teams: Automate the process of sending personalized emails to large lists of recipients.
- Developers: An example of a scalable, maintainable web application built with modern web technologies.

## How to run it
- Clone the Repository - https://github.com/sanbangarh309/mini-campaign-app.git
- Configure Environment Variables, Copy the .env.example file to .env and then change accordingly i.e queue connection to database or redis oe whatever queue you want to use.
- Install Backend Dependencies `composer install`
- Run Database Migrations `php artisan migrate`
- Install Frontend Dependencies `yarn install --frozen-lockfile`
- Start the Laravel Backend, If you're using Laravel Valet, your application will be available automatically on the forked folder. Otherwise, you can start the server with `php artisan serve`
- Compile Frontend Assets , run `yarn dev`
- If you need a production build, use `yarn build`



The Mini Campaign App is ideal for users who need to manage email campaigns efficiently, with a focus on personalization and ease of use. Whether you are a small business owner, a marketer, or a developer, this app offers a streamlined solution for your email marketing needs.
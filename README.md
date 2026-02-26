Hotel Booking Web Application

Overview

This project is a hotel booking web application built using **Laravel** and **MySQL**.  
It allows users to view available rooms, make bookings, and read reviews. Admin users have additional privileges to manage rooms, users, bookings, and reviews.

Features

- Homepage displaying a booking form and recent reviews.
- CRUD operations for Users, Rooms, Bookings, and Reviews.
- Validation using Laravel FormRequests.
- Exception handling for invalid actions (e.g., `RoomNotAvailableException`, `BookingException`).
- Role-based access control with Policies and Middleware.
- Observer pattern to send email notifications on new bookings.
- Price calculation using the Strategy design pattern (`StandardPriceStrategy`, `SeasonalDiscountStrategy`) with a Factory (`PriceStrategyFactory`).
- Caching implemented for frequently accessed data.
- Modular architecture using Services, Repositories, Controllers, and Models.
- Unit tests for main services: Booking, Users, and Rooms.
- Responsive frontend with semantic HTML (`header`, `nav`, `main`, `footer`) and reusable partials.

Technical Details

- Backend: Laravel 11, PHP 8.3
- Database: MySQL with migrations, seeders, and factories
- Testing: PHPUnit with unit tests for services
- Frontend: Blade templates, CSS responsive design

Structure

- `app/Models` – Eloquent models
- `app/Repositories` – Repository classes for database interactions
- `app/Http/Services` – Business logic separated from controllers
- `app/Http/Controllers` – Controllers for HTTP requests
- `app/Http/Requests` – FormRequest classes for validation
- `app/Observers` – Observers for events like booking creation
- `app/Strategies` – Strategy pattern classes for dynamic pricing
- `app/Providers` – Service providers for dependency injection
- `resources/views` – Blade templates for frontend
- `tests/Unit` – Unit tests for main services

Installation

1. Clone the repository:

git clone <your-repo-url>

2. Install dependencies:

composer install

3. Copy .env.example to .env and configure your database:

cp .env.example .env

4. Run migrations and seeders:

php artisan migrate --seed

5. Serve the application:

php artisan serve
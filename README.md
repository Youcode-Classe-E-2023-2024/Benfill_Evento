# Event Management Platform

## Description

This Laravel-based project serves as an Event Management Platform, enabling users to register, organize, and attend
various events. The application offers a range of features for users, organizers, and administrators, enhancing the
overall event experience.

## Features

### User

- **Registration and Authentication:**
    - Users can sign up on the platform by providing their name, email, and password.
    - Authentication allows users to log in using their credentials.

- **Password Management:**
    - Users can reset their passwords through a password reset email.

- **Event Discovery:**
    - Browse a paginated list of events available on the platform.
    - Filter events by category or search for specific titles.

- **Event Details:**
    - View detailed information about an event, including description, date, venue, and available seats.

- **Reservation:**
    - Reserve a seat for an event.

- **Ticket Generation:**
    - Generate a ticket once the reservation is confirmed.

- **Bonus Features:**
    - Filter events by date or location.
    - Login using Google or Facebook accounts.
    - Receive a confirmation email containing the user's ticket.
    - Generate the ticket in PDF format after reservation confirmation.

### Organizer

- **Event Creation:**
    - Create a new event by specifying title, description, date, venue, category, and available seats.

- **Reservation Statistics:**
    - Access statistics on reservations for hosted events.

- **Reservation Management:**
    - Choose between automatic acceptance or manual validation of reservations.

### Administrator

- **User Management:**
    - Manage user accounts by restricting access.

- **Category Management:**
    - Add, modify, or delete event categories.

- **Event Validation:**
    - Validate events created by organizers before publication.

- **Statistics Dashboard:**
    - Access comprehensive statistics on platform usage.

## Bonus Features (Developer)

- **Payment Integration:**
    - Integrate a payment system for event reservations.

## Getting Started

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/event-management-platform-laravel.git
   cd event-management-platform-laravel

# Install dependencies
   ```bash
    composer install
   ```  
# Set up environment variables and configure the database
    cp .env.example .env
    php artisan key:generate
# Database Migration and Seeding:
    php artisan migrate --seed
# Run the Application:
    php artisan serve

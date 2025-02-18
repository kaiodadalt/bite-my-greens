# Bite My Greens (Backend)

**Bite My Greens** will be a healthy challenge app built with [Laravel](https://laravel.com) that empowers users to create healthy challenges, invite friends, and compete by posting meal photos. The app will analyze each image to detect fruits and vegetables, assigns points based on the detected produce, and ranks participants in a friendly competition.

> **Note:** This repository contains the **backend** code only. The frontend and AI image detection components will be maintained in separate repositories, linked here once available.

## Features

- **Challenge Management:** Create and join healthy challenges.
- **User Engagement:** Invite friends to participate and compete.
- **Automated Scoring:** Processes meal photos to award points based on detected fruits and vegetables.
- **Ranking System:** Dynamically ranks users based on their performance in challenges.
- **Clean Architecture:** The codebase is organized following Clean Architecture principles, ensuring separation of concerns and high maintainability.
- **Docker-Ready:** Supports containerized development with Docker and Laravel Sail.

## Getting Started

Follow these instructions to set up the backend on your local machine for development and testing purposes.

### Prerequisites

- **PHP:** Version 8.0 or higher.
- **Composer:** Dependency management for PHP.
- **Docker:**  For containerized development using Docker Compose and Laravel Sail.

### Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/kaiodadalt/bite-my-greens.git
   cd bite-my-greens
   ```
2. **Install Dependencies and Set Up Laravel Sail:**

    Install PHP dependencies using Composer:
   ```bash
   composer install
   ```
   
    Copy the example environment file and generate an application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
   ```
   
    Start Laravel Sail:
    ```bash
    sail up
    ```

### License
Bite My Greens is open-sourced software licensed under the [MIT License](https://opensource.org/license/MIT).

<a href="https://www.buymeacoffee.com/kaiodadalt" target="_blank">
<img data-lazyloaded="1" src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" decoding="async" data-src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me a Coffee" style="height: 35px; text-align:center;" data-ll-status="loaded" class="entered litespeed-loaded">
</a>

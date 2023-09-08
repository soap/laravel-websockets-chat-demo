# Laravel-websockets-chat-demo
Laravel 10 chat application using Laravel-Websockets as Pusher's replacement.

## Packages used in the application
+ Laravel Jetstream with Inertia and VueJS 3.0 and as well, Tailwind CSS.
+ Laravel Echo.
+ Laravel-Websockets.

## Features
+ Real time chat with self hosted websockets server using Laravel-Websockets (pure PHP, no NodeJS).
+ Multiple chat rooms.
+ Send message to every one or someone in the chat room (TODO).

## Notes
+ I use Laravel-Inertia to share authenticated user using Inertia middleware.

## Installation and Configuration
+ Clone this repository.
+ Copy .env.example to .env
+ Install packages using
  ```
  composer update
  ```
+ Create database and update in the .env file.
+ Edit these parameters in the .env file. PUSHER_APP_SECRET can be any characters.
  ```
  PUSHER_APP_ID=LaravelDemo
  PUSHER_APP_KEY=LaravelDemo
  PUSHER_APP_SECRET=1212121212
  ```


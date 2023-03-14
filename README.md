# GPF - Game Pal Finder

## Introducition
The goal of this project is to create a social networking website for computer gamers. This website provides a single platform where gaming enthusiasts can find like-minded individuals to connect with.

Users can create an account on the website to access a variety of computer games. Upon selecting a game, users can enter chat rooms that are associated with the game and connect with other users who are also interested in playing. Users can join existing chat rooms or create their own chat rooms.

Once there are at least two people in a chat room, they can communicate with each other through live messaging and start playing together.

This project is developed using Laravel 9 framework.

## Features

The website provides a simple registration process that requires users to create an account and validate it through email before logging in. Once logged in, users can edit their profiles to add gaming platform usernames, making it easier for others to find them. Users can search for games based on category and view the number of active rooms for each game to determine which games are currently popular.

Upon selecting a game, users can enter chat rooms that are associated with the game and connect with other users who are also interested in playing. Users can join existing chat rooms or create their own chat rooms. Whoever creates a room can also moderate it by kicking users, locking the room so others cannot join anymore. Rooms have an active user count that updates live and displays the room status. In the room itself, users can send images and use emojis to express themselves. Once there are at least two people in a chat room, they can communicate with each other through live messaging and start playing together.

## Technologies

- [**Laravel Echo**](https://github.com/laravel/echo) and [**Pusher**](https://pusher.com/): These technologies are used to create a real-time communication API, which allows users to see live updates to the chat rooms and events happening on the website. This is essential for creating a seamless and engaging user experience, as it ensures that users are always up-to-date with what's happening on the site.

- [**Laravel Livewire**](https://laravel-livewire.com/), [**AJAX**](http://api.jquery.com/jquery.ajax/), and [**jQuery**](https://api.jquery.com/): These technologies are used to create a responsive website that adapts to user interactions. Livewire is a PHP framework that enables developers to create reactive interfaces, while AJAX and jQuery are JavaScript libraries used to make asynchronous requests to the server. By leveraging these technologies, the website is able to provide users with a fast and interactive experience.

- [**IGDB API**](https://www.igdb.com/api): The IGDB API is used to retrieve data on multiplayer video games. This allows the website to display accurate and up-to-date information on the games that users are interested in playing. By providing users with detailed information on the games available, the website is able to help users find games they enjoy and connect with other players who share their interests.

## License
GPF is licensed under the [Apache License 2.0](https://github.com/z1lvis/GPF/blob/main/LICENSE.md).

# Checkout 51

[Heroku](https://www.heroku.com/) deployment: https://shrouded-harbor-16023.herokuapp.com/

![screenshot](public/images/screenshot.png)

## Overview

This project was built in [PHP](https://www.php.net/) and [React](https://reactjs.org/) using [Symfony](https://symfony.com/) and [Webpack Encore](https://www.npmjs.com/package/@symfony/webpack-encore), with a [PostgreSQL](https://www.postgresql.org/) database and deployment to [Heroku](https://www.heroku.com/).

The app uses [material-table](https://material-table.com/) to display the data with the following features:

- Sorting rows by column in ascending or descending order (ID, Name, Cash Back)
- Searching and filtering results by text
- Pagination (10, 25, 50, or 100 rows per page)
- Reordering columns by drag-and-drop

Data from [c51.json](c51.json) is populated in the database by the Doctrine fixture: [src/DataFixtures/AppFixtures.php](src/DataFixtures/AppFixtures.php), and fetched by an API call that traces through:

- [src/Controller/OffersApiController.php](src/Controller/OffersApiController.php)
- [src/Service/OffersService.php](src/Service/OffersService.php)
- [src/Repository/BatchRepository.php](src/Repository/BatchRepository.php)

To get the most recent batch of offers and package them in [Models](src/Model/) that serve as data transfer objects (DTO's) to be serialized in the API response.

Note that the Doctrine fixture is also used to populate the Heroku database on deployment during the `release` phase as specified in the [Procfile](Procfile) via the `doctrine:fixtures:load` command.

**Stack:**

- [PostgreSQL](https://www.postgresql.org/)
- [PHP](https://www.php.net/) ([Symfony](https://symfony.com/))
- [React](https://reactjs.org/) ([Webpack Encore](https://www.npmjs.com/package/@symfony/webpack-encore))

## Getting Started

To install dependencies, setup the database, and start the web server all in one command, run [start.sh](start.sh):

```bash
./start.sh
```

**Dependencies:**

- [docker](https://docs.docker.com/get-docker/)
- [brew](https://brew.sh/)
- [yarn](https://classic.yarnpkg.com/en/docs/install/#mac-stable)
- [composer](https://getcomposer.org/download/)
- [symfony](https://symfony.com/download)

To install the frontend packages defined in [package.json](package.json) under `node_modules`, run:

```bash
yarn install
```

To build the frontend [assets](assets) under `public/build`, run:

```bash
yarn encore dev
```

To build the frontend and watch for file changes, run:

```bash
yarn encore dev --watch
```

To install the backend packages defined in [composer.json](composer.json) under `vendor`, run:

```bash
composer install
```

To start up the local database, run:

```bash
docker-compose up
```

To populate the database, run:

```bash
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
```

To start up the local web server, run:

```bash
symfony serve
```

To view the app, go to: https://localhost:8000/

To shut down the database, run:

```bash
docker-compose down
```

To stop the server, run:

```bash
symfony server:stop
```

To start the database and server in the background, run the commands with the `-d`:

```bash
docker-compose up -d
symfony serve -d
```

## Running Tests

To run all backend tests, run:

```bash
symfony php bin/phpunit
```

To run a specific test, append the relative file path:

```bash
symfony php bin/phpunit tests/Controller/OffersApiControllerTest.php
```

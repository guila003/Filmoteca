# Path to the docker-compose file
DOCKER_COMPOSE_FILEPATH=.docker/docker-compose.yaml
DOCKER_PHP_CONTAINER=filmoteca_php

# Start the containers in the background
up:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) up -d

# Stop the containers
down:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) down

# Recreate the containers (useful after modifying the Dockerfile)
build:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) up --build -d

# View the logs of the containers
logs:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) logs -f

# View the status of the containers
status:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) ps

# Remove the containers, networks, volumes, and images created by up
clean:
	docker compose -f $(DOCKER_COMPOSE_FILEPATH) down --volumes --remove-orphans

# Restart the containers
restart: down up

# Connect to the PHP container
start:
	docker exec -it $(DOCKER_PHP_CONTAINER) /bin/bash

# Run composer install
composer-install:
	docker exec $(DOCKER_PHP_CONTAINER) composer install

# Regénérer l'autoloading de Composer
dump-autoload:
	docker exec $(DOCKER_PHP_CONTAINER) composer dump-autoload

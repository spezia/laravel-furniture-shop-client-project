#!/usr/bin/env bash

docker-compose down

 # remove all stopped containers, all networks not used by at least one container, all dangling images, all build cache
docker system prune -f

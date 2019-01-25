#!/bin/bash

function current_path () {
    local script_path="`dirname \"$0\"`"
    script_path="`( cd \"$script_path\" && pwd )`"

    echo $script_path
}

PROJECT_NAME=${PWD##*/}
path=$(current_path)
project_dir="$path/build/"

cd "$path/build" \
&& docker-compose -p $PROJECT_NAME up -d

CONTAINER=$(docker ps -aqf "name=${PROJECT_NAME}_app")

#docker exec $CONTAINER php bin/console doctrine:migrations:migrate
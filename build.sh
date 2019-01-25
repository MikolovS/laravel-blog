#!/bin/bash

PROJECT_NAME=${PWD##*/}

function current_path () {
    local script_path="`dirname \"$0\"`"
    script_path="`( cd \"$script_path\" && pwd )`"

    echo $script_path
}

path=$(current_path)
project_dir="$path"

if [ -f "$project_dir/.env" ] ;
	then
		rm "$project_dir/.env"
fi

cp "$path/build/.dev.env" "$project_dir/.env"

printf "PROJECT_DIR=$project_dir" > "$path/build/.env"

cd "$path/build" && docker-compose -p $PROJECT_NAME build



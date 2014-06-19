#!/bin/bash
project="default";

if [ -z $2]
then
	echo "Project was no specified, will be 'default'";
else
	project=$2;
fi

version=""
if [ -z $3]
then
	echo "";
else
        version=$3;
fi


if [ -z $1 ]
then
	echo '===========================';
	echo './migration.sh <command> <project> <version>';
	echo '===========================';
	php cli.php
	exit;
else
	command=$1;
	if [ "$command" = "refresh" ] 
	then
		php cli.php migration:migrate --project $project --environment dev --configuration config/$project/migration/configuration.yml 0
		php cli.php migration:migrate --project $project --environment dev --configuration config/$project/migration/configuration.yml
	else
		php cli.php migration:$1 --project $project --environment dev --configuration config/$project/migration/configuration.yml $version	
	fi
fi




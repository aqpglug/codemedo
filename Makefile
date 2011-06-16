# Makefile
#
#

shell:
	phpsh app/shell.php

mysql:
	mysql -u root -p jamear

cc:
	php app/console cache:clear --env=dev
	php app/console cache:clear --env=prod

deletelogs:
	rm app/logs/apache.log app/logs/access.log
	touch app/logs/apache.log app/logs/access.log

database:
	php app/console doctrine:database:drop --force
	php app/console doctrine:database:create
	php app/console doctrine:schema:create

dbupdate:
	php app/console doctrine:schema:update --force

assets:
	app/console assets:install --symlink web

permissions:
	sudo chmod 777 -R app/cache app/logs

test:
	phpunit -c app/ src/Stormlabs

vendors:
	bin/vendors update

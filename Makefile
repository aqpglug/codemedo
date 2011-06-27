# Makefile
#
#

shell:
	phpsh app/shell.php

mysql:
	mysql -u root -p codemedo

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
	php app/console codemedo:fixtures

dbupdate:
	php app/console doctrine:schema:update --force

assets:
	app/console assets:install --symlink web

permissions:
	sudo chmod 777 -R app/cache app/logs

test:
	phpunit -c app/ src/Aqpglug

vendors:
	bin/vendors install
	make assets

build_bootstrap:
	php vendor/bundles/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php


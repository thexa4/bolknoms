# Bolknoms

The very best application in the world for feeding your members in an organized and predictable way.

## Project organisation
The repository follows the [nvie branching model](http://nvie.com/posts/a-successful-git-branching-model/). The master branch contains all features currently in deployment. The develop branch contains all stable features. Any new work must be branched of in a feature branch. These branches are prefixed with "feature-", for example "feature-moreswedishchef". Preferrably no underscores.

All releases are tagged using [Semantic Versioning 2.0.0-rc.1](http://semver.org/), though earlier releases (up to 1.3.2) have a "v"-prefix.

## Requirements
* PHP 5.2.3+
* SQL-compatible database
* Something to send e-mails with

## Basic installation
1. Download the code or git clone the repo
1. Copy config/database.sample.php to config/database.php and fill in the details
1. Copy config/bolknoms.sample.php to config/bolknoms.php and fill in the details
1. Copy public/.htaccess.sample to public/.htaccess and fill in the details
1. Create a database and execute all migrations (/migrations/*.sql) in alphabetical filename order
1. Upload to your server
1. Point your servers webroot to /public/

## Architecture
Bolknoms is built using the latest version of the [Kohana framework](http://kohanaframework.org/).

### Maintenance mode
You can put the application in maintenance mode by copying public/maintenance.sample.html to public/maintenance.html. Please note that this is only a simple HTML-page and that the application will be accessible to anyone who knows the URLs.
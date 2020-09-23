# OpenTourWebsite

A website framework using Symfony and PHP that implements OpenTour API. http://opentour.tech/

## Setup

Run:
- git clone https://github.com/apothan/OpenTourWebsite.git
- composer install
- yarn install 
- yarn encore dev

Then:
Create your local DB
copy .env to .env.local and update to your DB credentials

Run:
- php bin/console doctrine:migrations:migrate
- symfony server:start

## Development

We are still trying to add each of the fields for the OpenTour Tour model. https://github.com/apothan/OpenTour/blob/master/model/tour.md

If you need more information contact info@opentour.tech 
There will be a Matrix room set up for chat soon.

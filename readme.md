<p align="center">
  <img alt="PHP" src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/postgres-%23316192.svg?&style=for-the-badge&logo=postgresql&logoColor=white"/>
  <img src="https://badgen.net/badge/Open%20Source%20%3F/Yes%21/blue?icon=github" height="18.5"/>
  <img src="https://visitor-badge.laobi.icu/badge?page_id=crocodication.html-notes-app" width="82" height="20"/>
</p>

# HTML Notes App

Web-App Link: https://html-notes-app.herokuapp.com/

<p align="center">
  <img src="./screenshots/0.png" width=350>
</p>

Postman Import Link: https://www.getpostman.com/collections/5ef0343a019f2df6c1ab

<p align="center">
  <img src="./screenshots/1.png" width=350>
</p>

## How to deploy to yourself heroku platform?

- Fork this repository
- Login to heroku website
- Create a new heroku app
- Select your new app then go to ```Resources``` tab, search and add ```Heroku Postgres``` add-on

<p align="center">
  <img src="./screenshots/2.png" width=350>
</p>

- After add-on added, click at ```Heroku Postgres``` then go to add-on ```Settings``` tab to view credentials

<p align="center">
  <img src="./screenshots/3.jpg" width=350>
</p>

- Then go back to app details page, go to app's ```Settings``` tab then reveal config, fill config var like this using your own add-on credential

<p align="center">
  <img src="./screenshots/4.jpg" width=350>
</p>

## How to run locally?

- Make sure ```php``` is installed, check installed version with ```php -v``` command, if the ```php``` is installed, you can run the localhost
- Change directory to project's root folder
- Run the localhost at port 8000 with ```php -S localhost:8000``` command
- Then open the page at ```localhost:8000``` in the browser
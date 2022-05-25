<h1 align="center">Exegold System</h1>

<p align="center"><img src="./public/dist/img/preview2.PNG"></p>

A powerful yet useful Support Structur for big roleplay networks.
Licensed under MIT

## Features

*   Give your teammembers guidelines in form of integrated Google Docs functions
*   Document any important support cases
*   View the supporting activity of your teammembers
*   Document any important ban protocols (Gives you information about your users [!])
*   View bans for unban requests
*   View team positioning of your teammembers
*   View logs
*   Manage your team better and easier

## Installation

1) Clone the repository and upload to webserver:
    ```console
    $ git clone https://github.com/Sprechblase/exegold-supportcp.git
    ```

2) Import Databas
    ```console
    Import the support.sql file into your database
    ```

3) Go into .env File and setup database and app:
    ```console
    APP_NAME=Exegold
    APP_ENV=local
    APP_LOGO=http://localhost/public/dist/img/logo.png
    APP_DEBUG=true
    APP_LOG_LEVEL=debug
    APP_URL=http://localhost/

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=name
    DB_USERNAME=name
    DB_PASSWORD=secret
    ```

4) Load your site and login with the following data:
    ```
    E-Mail: sprechblase@sprechblase.de
    Password: supportcp
    ```

5) Have fun!
___
<p align="center">Made with ❤️</p>

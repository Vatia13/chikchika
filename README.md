# chikchika

Chikchika is Laravel Twitter clone, In this project I`m using mysql database and mailtrap for mails localhost, but you can chose your own database driver and mailserver inside and setup inside .env file.
frontend is using VUE JS components and axios for ajax requests

## Installation

#### 1. Install Composer Dependencies

```bash
composer install
```

#### 2. Environment variables .env

In project directory make copy of .env.example file and rename it to .env
or simply use command:

```bash
cp .env.example .env
```
``!important``: please as well as project is using axios for ajax API requests
add line below inside .env file

```bash
VITE_API_URL = "${APP_URL}/api/v1/"
```

``!important``: incase if requests still aren't working, please add port inside .env APP_URL
```bash
APP_URL = "http://localhost:8000"
```

``!important``: if u are using different port than 8000 please run commands below for frontend after environments are set

```bash
npm install
```

```bash
npm run build
```


#### 3. Generate APP_KEY

After copying .env you can setup database and mail credentials but also you have to generate an APP_KEY with command below:

```bash
php artisan key:generate
```

#### 4. Migrate database

```bash
php artisan migrate
```

The optional command if u want to seed some factory data from seeders you can run 
```bash
php artisan db:seed
```

#### 5. Optional - Install npm packages

In case if you want to track realtime changes in project install npm packages

```bash
npm install
```

## Run Project

#### 1. Run localhost server

```bash
php artisan serve
```

#### 2. Queueing notifications

While notifications are implementing ShouldQueue, to get notification on email you should run

```bash
php artisan queue:listen
```

#### 3. Optional - compile project

The project is builded already with command:

```bash
npm run build
```

but in case if u can't see some frontend html you can always re run a command above or run

```bash
npm run dev
```

to watch realtime changes
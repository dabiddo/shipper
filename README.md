## CLI Shipping Direction

This is a mini CLI program for my Test Interview, for calculating Sustanability Score based on the problem description.

### Prerequisites:

#### Local Dev Enviroment

You can run the program in several different ways, if you already have PHP installed on your computer, just clone the repo, install dependencies and run the commands.

#### Using VSCode Devcontainers

I'v added `.devcontainer.json` file, if you have VSCode with Devcontainers plugin, after you open the project directory, you will be asked to run the repo inside the container.

#### Using Devpod.sh

The fastest way to run it, if you have Docker installed in your computer, is to download [Devpod.sh](https://devpod.sh/), from within the devpod app, you can clone the repo & run it, it will automatically open a VSCode instance inside the browser. 
From within the VSCode browser, just open a terminal, install dependencies and run the commands.

### Install Dependencies

Before you can use it, please install laravel dependencies running:
`composer install`

### How to use it

This program has a few example street names and drivers inside the `storage` folder, but you can replace them base on your choice.
after that, you can run the program with the simple command 

`php shipper calculate`.

### Probable Asked Questions

##### Why Laravel-Zero?

I'm pretty used to using laravel for my stack, and it seemed like a good idea,.

##### Why not use a Database?

The requirements didn't call for it, because the program just takes two files and reads them to set the deliveries and calculate the score.

##### Unit tests?

Yes, the app does have unit tests, you can run them using `./vendor/bind/pest` 

##### It does not work on my computer, what should I do?

If you are running it in your computer, please make sure you have PHP 8.1 installed and Composer 2 installed, also for PHP the usual extensions needed for laravel
`mbstring, curl, openssl` .

I recommend going the Devcontainer route, as it is easier to run.

## CLI Shipping Direction

This is a mini CLI program for my Test Interview, for calculating Sustanability Score based on the problem description.

### Requisites
In order to run this program you need to have PHP 8.1 installed, and Composer 2 running on your system.
with those requirements met, you can just clone this project on your desired directory.

### How to use it
This program has a few example addresses and drivers on the `storage` folder, but you can replace them base on your choice.
after that, you can run the program with the simple command `php shipper calculate`.

### Probable Asked Questions
##### Why Laravel-Zero?
I'm pretty used to using laravel for my stack, and it seemed like a good idea, my first choice was minicli, but it does not support PHP 8 yet.

##### Why not use a Database?
The requirements didn't call for it, because the program just takes two files and reads them to set the deliveries and calculate the score.

##### Why no unit tests?
I did not have a lot time to finish this project, because I have my main work, and I had to do this on my free time.

##### It does not work on my computer, what should I do?
Please make sure you have PHP 8.1 installed and Composer 2 installed, also for PHP the usual extensions needed for laravel
`mbstring, curl, openssl` .

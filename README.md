# Google Cloud Storage Bucket Browser

## Description
This is a simple web-based application to browse the contents of a bucket from the GCS upon user authentication.

It was built using the [Google PHP cloud client library](https://github.com/GoogleCloudPlatform/google-cloud-php) and [jstree](https://github.com/vakata/jstree).

The [storage-metabucket-javascript](https://github.com/GoogleCloudPlatform/storage-metabucket-javascript) and [storage-getting-started-php](https://github.com/GoogleCloudPlatform/storage-getting-started-php) projects were used as a starting point.

This build was tested in PHP version 7.1 using the official PHP docker image [php:7.1-apache](https://hub.docker.com/_/php/)

## Prerequisites:
[google-cloud-php](https://github.com/GoogleCloudPlatform/google-cloud-php)

```
$ composer require google/cloud
```

[thephpleague/oauth2-google](https://github.com/thephpleague/oauth2-google)

```
$ composer require league/oauth2-google
```

## OAuth 2.0 client
Rename conf.demo.php to conf.php and fill in with your credentials information from OAuth 2.0 client credentials previously created on [Google Developers APIs](https://console.developers.google.com/project/_/apis/credentials)

## Running the application using Docker:
Run the following command in the project directory:

```
$ docker run -d -p 80:80 --name my-apache-php-app -v "$PWD":/var/www/html php:7.1-apache
```

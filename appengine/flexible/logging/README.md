# Logging and Google App Engine Flexible

This sample application demonstrates how to implement logging from
 Google App Engine Flexible Environment.

## Register your application

- Go to
  [Google Developers Console](https://console.developers.google.com/project)
  and create a new project. This will automatically enable an App
  Engine application with the same ID as the project.

## Prerequisites

- Install [`composer`](https://getcomposer.org)
- Install dependencies by running:

    ```sh
    $ composer install
    ```

## Deploy to App Engine

**Prerequisites**

- Install the [Google Cloud SDK](https://developers.google.com/cloud/sdk/).

**Deploy with gcloud**

```
$ gcloud config set project YOUR_PROJECT_ID
$ gcloud app deploy
```

## Run Locally

- Go to "Credentials" and create a new Service Account.

- Select "Generate new JSON key", then download a new JSON file.

- Set the following environment variables:

  - `GOOGLE_APPLICATION_CREDENTIALS`: the file path to the downloaded JSON file.
  - `GCLOUD_PROJECT`: Your project ID

- Run `php -S localhost:8000` and go to http://localhost:8000 in your browser.
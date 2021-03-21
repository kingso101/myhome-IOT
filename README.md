This project in collaboration with Facebook and Andela, is aimed at building a Face recognition security surveillance system with the nvidia edge device and AWS services.

The web app for this project is built with php. The following actions are carried out in this app

1. User Signup, Login and Signout
2. User subscription to firebase notification service
3. SMS Notifications are sent to user via twilio from an edge device
4. Stream Live video feeds from Edge Device and Camera via AWS S3 bucket

-Dependencies
Php 5.6.40 or latest version.
Composer to autoload dependencies.
AWS php sdk.
Twilio for sms notification.
MongoDb database
vlucas library

-AWS Services
1. AWS Cognito for User authentication
2. AWS S3 to host Images and Video streams
3. AWS Cloudfront to stream Video feeds from s3 in the web device

-Installation
Clone repository
make api calls to a REST API endpoints. Example <Your-server>/api/user etc.
Make sure to autoload dependencies with composer to get desired experience.

Note: To pull or push AWS configurations to the cloud one will need an AWS user with appropriate permissions.

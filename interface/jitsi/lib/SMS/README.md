# Getting started

D7 SMS allows you to reach your customers via SMS over D7's own connectivity to global mobile networks. D7 provides reliable and cost-effective SMS services to businesses across all industries and aims to connect all countries and territories via direct connections.

## How to Build

The generated code has dependencies over external libraries like UniRest. These dependencies are defined in the ```composer.json``` file that comes with the SDK. 
To resolve these dependencies, we use the Composer package manager which requires PHP greater than 5.3.2 installed in your system. 
Visit [https://getcomposer.org/download/](https://getcomposer.org/download/) to download the installer file for Composer and run it in your system. 
Open command prompt and type ```composer --version```. This should display the current version of the Composer installed if the installation was successful.

* Using command line, navigate to the directory containing the generated files (including ```composer.json```) for the SDK. 
* Run the command ```composer install```. This should install all the required dependencies and create the ```vendor``` directory in your project directory.

![Building SDK - Step 1](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_1.svg)

### [For Windows Users Only] Configuring CURL Certificate Path in php.ini

CURL used to include a list of accepted CAs, but no longer bundles ANY CA certs. So by default it will reject all SSL certificates as unverifiable. You will have to get your CA's cert and point curl at it. The steps are as follows:

1. Download the certificate bundle (.pem file) from [https://curl.haxx.se/docs/caextract.html](https://curl.haxx.se/docs/caextract.html) on to your system.
2. Add curl.cainfo = "PATH_TO/cacert.pem" to your php.ini file located in your php installation. “PATH_TO” must be an absolute path containing the .pem file.

```ini
[curl]
; A default value for the CURLOPT_CAINFO option. This is required to be an
; absolute path.
;curl.cainfo =
```

## How to Use

The following section explains how to use the D7SMS library in a new project.

### 1. Open Project in an IDE

Open an IDE for PHP like PhpStorm. The basic workflow presented here is also applicable if you prefer using a different editor or IDE.

![Open project in PHPStorm - Step 1](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_2.svg)

Click on ```Open``` in PhpStorm to browse to your generated SDK directory and then click ```OK```.

![Open project in PHPStorm - Step 2](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_3.svg)     

### 2. Add a new Test Project

Create a new directory by right clicking on the solution name as shown below:

![Add a new project in PHPStorm - Step 1](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_4.svg)

Name the directory as "test"

![Add a new project in PHPStorm - Step 2](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_5.svg)
   
Add a PHP file to this project

![Add a new project in PHPStorm - Step 3](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_6.svg)

Name it "testSDK"

![Add a new project in PHPStorm - Step 4](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_7.svg)

Depending on your project setup, you might need to include composer's autoloader in your PHP code to enable auto loading of classes.

```PHP
require_once "../vendor/autoload.php";
```

It is important that the path inside require_once correctly points to the file ```autoload.php``` inside the vendor directory created during dependency installations.

![Add a new project in PHPStorm - Step 4](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_8.svg)

After this you can add code to initialize the client library and acquire the instance of a Controller class. Sample code to initialize the client library and using controller methods is given in the subsequent sections.

### 3. Run the Test Project

To run your project you must set the Interpreter for your project. Interpreter is the PHP engine installed on your computer.

Open ```Settings``` from ```File``` menu.

![Run Test Project - Step 1](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_9.svg)

Select ```PHP``` from within ```Languages & Frameworks```

![Run Test Project - Step 2](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_10.svg)

Browse for Interpreters near the ```Interpreter``` option and choose your interpreter.

![Run Test Project - Step 3](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_11.svg)

Once the interpreter is selected, click ```OK```

![Run Test Project - Step 4](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_12.svg)

To run your project, right click on your PHP file inside your Test project and click on ```Run```

![Run Test Project - Step 5](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/php_13.svg)

## How to Test

Unit tests in this SDK can be run using PHPUnit. 

1. First install the dependencies using composer including the `require-dev` dependencies.
2. Run `vendor\bin\phpunit --verbose` from commandline to execute tests. If you have 
   installed PHPUnit globally, run tests using `phpunit --verbose` instead.

You can change the PHPUnit test configuration in the `phpunit.xml` file.

## Initialization

### Authentication
In order to setup authentication and initialization of the API client, you need the following information.

| Parameter | Description |
|-----------|-------------|
| aPIUsername | API Key |
| aPIPassword | API Token |



API client can be initialized as following.

```php
$aPIUsername = 'aPIUsername'; // API Key
$aPIPassword = 'aPIPassword'; // API Token

$client = new D7SMSLib\D7SMSClient($aPIUsername, $aPIPassword);
```


# Class Reference

## <a name="list_of_controllers"></a>List of Controllers

* [APIController](#api_controller)

## <a name="api_controller"></a>![Class: ](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/class.png ".APIController") APIController

### Get singleton instance

The singleton instance of the ``` APIController ``` class can be accessed from the API Client.

```php
$client = $client->getClient();
```

### <a name="get_balance"></a>![Method: ](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/method.png ".APIController.getBalance") getBalance

> Check account balance


```php
function getBalance()
```

#### Example Usage

```php

$client->getBalance();

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 500 | Internal Server Error |



### <a name="create_send_sms"></a>![Method: ](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/method.png ".APIController.createSendSMS") createSendSMS

> Send SMS  to recipients using D7 SMS Gateway


```php
function createSendSMS($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Required ```  | Message Body |
| contentType |  ``` Required ```  | TODO: Add a parameter description |
| accept |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$body = new SendSMSRequest();
$collect['body'] = $body;

$contentType = 'Content-Type';
$collect['contentType'] = $contentType;

$accept = 'Accept';
$collect['accept'] = $accept;


$client->createSendSMS($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 500 | Internal Server Error |



### <a name="create_bulk_sms"></a>![Method: ](https://github.com/d7networks/D7SMS-SDKs/blob/master/D7SMS-PHP/images/method.png ".APIController.createBulkSMS") createBulkSMS

> Send Bulk SMS  to multiple recipients using D7 SMS Gateway


```php
function createBulkSMS(
        $body,
        $contentType,
        $accept)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| body |  ``` Required ```  | Message Body |
| contentType |  ``` Required ```  | TODO: Add a parameter description |
| accept |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$bodyValue = "{  \"messages\": [    {      \"to\": [        \"971562316353\",        \"971562316354\",        \"971562316355\"      ],      \"content\": \"Same content goes to three numbers\",      \"from\": \"SignSMS\"    }  ]}";
$body = APIHelper::deserialize($bodyValue);
$contentType = 'application/json';
$accept = 'application/json';

$client->createBulkSMS($body, $contentType, $accept);

```


[Back to List of Controllers](#list_of_controllers)




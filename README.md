# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  - you can test the demo script in your shell: "php index.php"

## 2. Expectations

This simple application works, but with very old-style monolithic codebase, so do anything you want with it, to make it:

  - easier to work with
  - more maintainable

## To test it, first run composer install
```
  composer install

  // it install our dependencies for Code Sniffer and PHPUnit
```


## To check coding standard of this test path or specific file, I used PSR-12

```
  phpcs --standard=PSR12 .\class
  phpcs --standard=PSR12 .\class\Comment.php
``

## To run PHPUnit test (sample only)
```
  .\vendor\bin\phpunit .\NewsManagerControllerTest.php

  It will show
  Tests: 1, Assertions: 3, Failures: 1.

  I add 3 test assertion, check if it contains any string
```

Thank you,
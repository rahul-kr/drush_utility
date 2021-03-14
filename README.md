CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Usage
 * Limitation
 * Maintainers


INTRODUCTION
------------

Drush Utility is a custom utility for drush commands.
It's for updating external links in body with the attributes no-follow i.e
rel="nofollow"
ex. <a href="http://www.facebook.com" rel="nofollow">http://www.facebook.com</a>


USAGE
-----
Command with all options and parameters

1. drush extl-nf --all article

2. drush extl-nf article 2

3. If you'll enter wrong paramerters it will give expections with usage example.
   Wrong command - drush extl-nf article test

Limitation
-----
Text format must allow this attribute rel="nofollow"
If text format will be like "Basic HTML", it will not reflect on page view.
It needs to be Full HTML in text format.

MAINTAINERS
-----------
Current maintainers:
 Rahul kumar 
 (https://www.drupal.org/u/rkumar)
 (https://www.linkedin.com/in/rahulkumar25/)

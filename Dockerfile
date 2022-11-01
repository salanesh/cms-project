FROM php:8.1-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
CMD chgrp -R www-data /var/www/html/ && chmod 775 -R /var/www/html/ && chmod g+s -R /var/www/html/
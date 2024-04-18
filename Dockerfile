FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV DB_CONNECTION pgsql
ENV DB_HOST dpg-cogbig4f7o1s73fr2ni0-a
ENV DB_PORT 5432
ENV DB_DATABASE taskmanagerdb_agat
ENV DB_USERNAME taskmanagerdb_agat_user
ENV DB_PASSWORD xFGKIP0lHNKZHGFzY9GY6BczEzz3MqTp

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
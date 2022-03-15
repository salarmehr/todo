FROM php:8.0.10-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# these are slow steps so makes sense to have sepearte RUN for each extension
# so on the failure we don't need to run the previous step agin.
# https://github.com/mlocati/docker-php-extension-installer
RUN install-php-extensions bcmath
RUN install-php-extensions exif
RUN install-php-extensions gd
RUN install-php-extensions intl
RUN install-php-extensions pdo_mysql
RUN install-php-extensions tidy
RUN install-php-extensions xdebug

#RUN install-php-extensions @composer

RUN apt update && \
    apt upgrade -y && \
    apt install -y g++ autoconf  ffmpeg git ssh make msmtp supervisor zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./conf.d/php.ini /usr/local/etc/php/conf.d

WORKDIR  /srv
EXPOSE 6001

# making SSH key available in container (should works cross OSs)
COPY entry.bash /
RUN chmod +x /entry.bash

WORKDIR "/srv"
ENTRYPOINT ["/entry.bash"]
CMD ["php-fpm"]

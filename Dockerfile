# Dockerfile
FROM php:8.2-apache

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_mysql

# Apacheの設定ファイルをコピー
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# アプリケーションファイルをコピー
COPY . /var/www/html

# .htaccessを有効にする
RUN a2enmod rewrite

# ワーキングディレクトリを設定
WORKDIR /var/www/html

# Composerで依存関係をインストール
RUN composer install --prefer-dist --no-interaction

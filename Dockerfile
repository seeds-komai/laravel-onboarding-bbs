# Dockerfile
FROM php:8.2-apache

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apacheの設定ファイルをコピー
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# .htaccessを有効にする
RUN a2enmod rewrite

# ワーキングディレクトリを設定
WORKDIR /var/www/html

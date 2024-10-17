# Dockerfile
FROM php:8.2-apache

# 必要なPHP拡張をインストール
RUN docker-php-ext-install pdo pdo_mysql

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# tzdataパッケージをインストール
RUN apt-get update && apt-get install -y tzdata

# 必要な環境変数を設定（タイムゾーンを指定）
ENV MYSQL_TIME_ZONE="Asia/Tokyo"

# PATHを設定
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# ストレージディレクトリを作成
RUN mkdir -p /var/www/html/storage

# Apacheの設定ファイルをコピー
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Laravelのストレージディレクトリの権限を設定
RUN chown -R www-data:www-data /var/www/html/storage

# .htaccessを有効にする
RUN a2enmod rewrite

# ワーキングディレクトリを設定
WORKDIR /var/www/html

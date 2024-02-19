# PHP imajı
FROM php:8.1.24-fpm  
  
# Gerekli bağımlılıkları yükleme  
RUN apt-get update && apt-get install -y \  
    libzip-dev \  
    zip \  
    unzip \  
    git  
  
# PHP eklentilerini yükleme  
RUN docker-php-ext-configure zip --with-zip && docker-php-ext-install zip pdo pdo_mysql  
  
# Composer'ı yükleme  
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer  
  
# Çalışma dizinini belirleme
WORKDIR /var/www  
  
# Projeni çalışma dizinine kopyalama
COPY . .  
  
# Gerekirse proje composer'ı yükleme
RUN composer install  
  
# Uygulamayı ayağa kaldır
CMD php artisan serve --host=0.0.0.0 --port=8000
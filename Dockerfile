# -------------------------
# Imagen base PHP FPM 8.2
# -------------------------
FROM php:8.2-fpm

# -------------------------
# Instalar extensiones PHP necesarias
# -------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# -------------------------
# Instalar Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------
# Crear directorio de trabajo
# -------------------------
WORKDIR /var/www

# -------------------------
# Copiar archivos de la app
# -------------------------
COPY . .

# -------------------------
# Instalar dependencias PHP
# -------------------------
RUN composer install --no-dev --optimize-autoloader

COPY .env.example .env

# -------------------------
# Instalar dependencias Node.js para Vite/Tailwind
# -------------------------
RUN npm install
RUN npm run build

# -------------------------
# Generar key de Laravel y cache
# -------------------------
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# -------------------------
# Exponer puerto para Nginx
# -------------------------
EXPOSE 8000

# -------------------------
# Comando por defecto
# -------------------------
CMD ["php-fpm"]

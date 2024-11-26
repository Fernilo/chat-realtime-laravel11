# Sistema de Chat en Tiempo Real con Laravel 11

Sistema de chat en tiempo real implementado con Laravel 11, Docker, Laravel Reverb, Queues y Vue.js.

## Requisitos Previos

- Docker Compose
- Git

## Instalación

1. Clonar el repositorio
```bash
git clone [url-del-repositorio]
cd [nombre-del-proyecto]
```

2. Configurar el entorno
```bash
cp .env.example .env
```

3. Instalar dependencias usando Sail
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

4. Iniciar los contenedores con Sail
```bash
./vendor/bin/sail up -d
```

5. Configuración inicial
```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm install
./vendor/bin/sail artisan migrate
```

## Configuración de Laravel Reverb

1. Configurar en `.env`:
```env
BROADCAST_DRIVER=reverb
REVERB_APP_ID=tu_app_id
REVERB_APP_KEY=tu_app_key
REVERB_APP_SECRET=tu_app_secret

REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http
```

2. Iniciar el servidor Reverb
```bash
./vendor/bin/sail artisan reverb:start
```

## Configuración de Colas

1. Configurar en `.env`:
```env
QUEUE_CONNECTION=database
```

2. Iniciar workers de cola
```bash
# Iniciar un worker
./vendor/bin/sail artisan queue:work

# O iniciar múltiples workers
./vendor/bin/sail artisan queue:work --queue=high,default,low

# Para producción, usar supervisor
./vendor/bin/sail artisan queue:work --daemon
```

## Iniciar el Sistema

1. Iniciar todos los servicios
```bash
./vendor/bin/sail up -d
```

2. Asegurar que Reverb y las colas estén corriendo
```bash
./vendor/bin/sail artisan reverb:start
./vendor/bin/sail artisan queue:work
```

3. Compilar assets
```bash
./vendor/bin/sail npm run dev
```

## Monitoreo

1. Monitorear colas
```bash
# Ver jobs fallidos
./vendor/bin/sail artisan queue:failed

# Reintentar jobs fallidos
./vendor/bin/sail artisan queue:retry all
```

2. Monitorear Reverb
```bash
# Ver estado de las conexiones
./vendor/bin/sail artisan reverb:status

# Ver logs de Reverb
./vendor/bin/sail logs reverb
```

## Solución de Problemas Comunes

1. **Problemas con las colas**
```bash
# Limpiar colas
./vendor/bin/sail artisan queue:flush

# Reiniciar workers
./vendor/bin/sail artisan queue:restart
```

2. **Problemas con Reverb**
```bash
# Reiniciar Reverb
./vendor/bin/sail artisan reverb:restart

# Verificar conexiones
./vendor/bin/sail artisan reverb:list
```

3. **Problemas de conexión**
- Comprobar logs de Reverb
- Verificar configuración de CORS

## Comandos Útiles

```bash
# Ver jobs en cola
./vendor/bin/sail artisan queue:monitor

# Limpiar cache
./vendor/bin/sail artisan cache:clear

# Ver rutas de websockets
./vendor/bin/sail artisan reverb:routes
```

## Puertos por Defecto

- **Aplicación**: http://localhost
- **MySQL**: localhost:3306
- **Reverb**: localhost:8080

## Desarrollo

Para detener todos los servicios:
```bash
./vendor/bin/sail down
```

Para reconstruir contenedores:
```bash
./vendor/bin/sail build --no-cache
```

## Seguridad

Reportar vulnerabilidades a [fernan.alemercado@gmail.com](mailto:fernan.alemercado@gmail.com)

## Licencia

[MIT license](https://opensource.org/licenses/MIT).
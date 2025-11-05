# 🧾 CostManager

Gestor de gastos personal desarrollado en **Laravel 11**, completamente **dockerizado**, que permite controlar tus **ingresos y gastos mensuales** en relación con tu sueldo.

---

## 🚀 Tecnologías utilizadas

- **Backend:** Laravel 11  
- **Base de datos:** MySQL  
- **Frontend:** Blade, jQuery, css
- **Gestión de dependencias frontend:** pnpm  
- **Contenedores:** Docker(Docker CLI/Docker Desktop)  
- **Servidor web:** Apache

---

## ⚙️ Instalación y configuración

A continuación se detallan todos los pasos necesarios para levantar el entorno completo del proyecto con Docker y preparar la base de datos.

---

### Clonar el repositorio

Primero, clona el repositorio en tu máquina local:

```bash
git clone https://github.com/Cranuk/Proyecto-costManager.git
cd costManager
```

### Copiar y configurar el archivo de entorno

```
cp .env.example .env
```

### Copiar y configurar el archivo para levantar los servicios en docker

```
cp docker-compose.example.yml docker-compose.yml
```

### Construir y levantar los contenedores

```
docker-compose up -d --build
docker ps
```

### Instalar las dependencias del proyecto
```
docker exec -it app composer install
docker exec -it app pnpm install
```

### Comandos para ejecutar en el proyecto
```
docker exec -it app php artisan key:generate
docker exec -it app php artisan migrate
docker exec -it app php artisan migrate --seed
```

## 📊 Funcionalidades principales

- ✅ Crear categorías de gastos e ingresos.

- 💰 Registrar movimientos mensuales (ingresos/gastos).

- 📈 Visualizar el balance mensual en la página inicial.

- 💼 Controlar tus gastos según tu sueldo configurado.

- 🧮 Ver balances mensuales.
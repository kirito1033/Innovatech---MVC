<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Estilos del Sidebar (mismo que antes) */
        .sidebar {
            width: 250px;
            background-color: #f5f5f5;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar h4, .sidebar h5 {
            color: #000000;
            border-bottom: 1px solid #333333;
            padding-bottom: 5px;
        }

        .sidebar a {
            display: block;
            color: #333333;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px 0;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: #d5d5d5;
            color: #000000;
        }

        .sidebar hr {
            border-color: #cccccc;
        }

        .sidebar i {
            margin-right: 10px;
            color: #666666;
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            background-color: #666666;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            z-index: 1100;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    <div class="sidebar" id="sidebar">
        <h4 class="text-center my-3">Dashboard</h4>
        <a href="/"><i class="bi bi-house"></i> Home</a>
        <a href="/usuario"><i class="bi bi-people"></i> Usuarios</a>
        <a href="/rol"><i class="bi bi-shield-lock"></i> Roles</a>
        <a href="/permisos"><i class="bi bi-key"></i> Permisos</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Gestión</h5>
        <a href="/departamento"><i class="bi bi-building"></i> Departamentos</a>
        <a href="/ciudad"><i class="bi bi-geo-alt"></i> Ciudades</a>
        <a href="/estadousuario"><i class="bi bi-person-check"></i> Estado Usuarios</a>
        <a href="/tipodocumento"><i class="bi bi-file-earmark-text"></i> Tipos de Documento</a>
        <a href="/producto"><i class="bi bi-box"></i> Productos</a>
        <a href="/marca"><i class="bi bi-tag"></i> Marcas</a>
        <a href="/modelo"><i class="bi bi-boxes"></i> Modelos</a>
        <a href="/estadoproducto"><i class="bi bi-check-square"></i> Estado Productos</a>
        <a href="/color"><i class="bi bi-palette"></i> Colores</a>
        <a href="/categoria"><i class="bi bi-list-ul"></i> Categorías</a>
        <a href="/garantia"><i class="bi bi-shield-check"></i> Garantías</a>
        <a href="/almacenamiento"><i class="bi bi-hdd"></i> Almacenamiento</a>
        <a href="/almacenamientoaleatorio"><i class="bi bi-hdd-stack"></i> Almacenamiento Aleatorio</a>
        <a href="/sistemaoperativo"><i class="bi bi-gear-wide-connected"></i> Sistemas Operativos</a>
        <a href="/resolucion"><i class="bi bi-display"></i> Resoluciones</a>
        <a href="/ingresoproducto"><i class="bi bi-box-arrow-in-down"></i> Ingreso Productos</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">PQRS</h5>
        <a href="/tipopqrs"><i class="bi bi-question-circle"></i> Tipos PQRS</a>
        <a href="/estadopqrs"><i class="bi bi-info-circle"></i> Estado PQRS</a>
        <a href="/pqrs"><i class="bi bi-chat-dots"></i> PQRS</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Facturación y Envíos</h5>
        <a href="/estadoenvio"><i class="bi bi-truck"></i> Estado Envíos</a>
        <a href="/envio"><i class="bi bi-box-seam"></i> Envíos</a>
        <a href="/estadofactura"><i class="bi bi-receipt"></i> Estado Facturas</a>
        <a href="/factura"><i class="bi bi-file-earmark-ruled"></i> Facturas</a>

        <hr class="my-2">
        <h5 class="text-center mt-3">Configuración</h5>
        <a href="/settings"><i class="bi bi-gear"></i> Configuración General</a>
        <a href="/security"><i class="bi bi-lock"></i> Seguridad</a>
        <a href="/notifications"><i class="bi bi-bell"></i> Notificaciones</a>
        <a href="/logout"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
    </div>

    <div class="main-content">
        <!-- Aquí va el contenido de tu vista (tabla, etc.) -->
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>


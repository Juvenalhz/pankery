<?php

class EnrutadorUsuario
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/usuario/' . $vista . '.php');
                break;
            case "ver":
                include_once('view/usuario/' . $vista . '.php');
                break;
            case "editar":
                include_once('view/usuario/' . $vista . '.php');
                break;
            case "eliminar":
                include_once('view/usuario/' . $vista . '.php');
                break;
            case "cambiarpassword":
                include_once('view/usuario/' . $vista . '.php');
                break;
            case "modulos":
                include_once('view/usuario/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/usuario/inicioUsuario.php');
        } else {
            return true;
        }
    }
}
class EnrutadorInventario
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/inventario/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/inventario/inicioInventario.php');
        } else {
            return true;
        }
    }
}

class EnrutadorRecetario
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/recetario/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/recetario/inicioRecetario.php');
        } else {
            return true;
        }
    }
}
class EnrutadorEgresos
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/egresos/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/egresos/inicioEgresos.php');
        } else {
            return true;
        }
    }
}
class EnrutadorFinanzas
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/finanzas/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/finanzas/iniciofinanzas.php');
        } else {
            return true;
        }
    }
}

class EnrutadorInicio
{
    public function cargarVista($vista)
    {
        switch ($vista):
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/home/index.php');
        } else {
            return true;
        }
    }
}

class EnrutadorVentas
{
    public function cargarVista($vista)
    {
        switch ($vista):

            case "crear":
                include_once('view/recetario/' . $vista . '.php');
                break;
            default:
                include_once('view/error.php');
        endswitch;
    }

    public function validarGet($variable)
    {
        if (empty($variable)) {
            include_once('view/ventas/inicioVentas.php');
        } else {
            return true;
        }
    }
}
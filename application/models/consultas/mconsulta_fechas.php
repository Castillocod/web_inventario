<?php
class mconsulta_fechas extends CI_Model
{
    function __construct()
    {
        parent::__construct();    
    }

    public function all_tablaprodact_count()
    {
        $this->db->where('estado_prod', 'ACTIVO');
        $query = $this->db->get('almacen_productos');
        return $query->num_rows();
    }

    public function all_tablaprodact($limite, $iniciar)
    {
        $this->db->where('estado_prod', 'ACTIVO');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('almacen_productos');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablaprodact_search($limite, $iniciar, $buscar)
    {
        $this->db->from('almacen_productos');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('modelo', $buscar, 'both');
        $this->db->or_like('estado_prod', $buscar, 'both');
        $this->db->or_like('fecha_vprod', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_prod', 'ACTIVO');
        $this->db->limit($limite, $iniciar);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablaprodact_search_count($buscar)
    {
        $this->db->from('almacen_productos');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('modelo', $buscar, 'both');
        $this->db->or_like('estado_prod', $buscar, 'both');
        $this->db->or_like('fecha_vprod', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_prod', 'ACTIVO');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablacatact_count()
    {
        $this->db->where('estado_vcat', 'ACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->num_rows();
    }

    public function all_tablacatact($limite, $iniciar)
    {
        $this->db->where('estado_vcat', 'ACTIVO');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('almacen_categorias');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacatact_search($limite, $iniciar, $buscar)
    {
        $this->db->from('almacen_categorias');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $this->db->or_like('fecha_vcat', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vcat', 'ACTIVO');
        $this->db->limit($limite, $iniciar);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacatact_search_count($buscar)
    {
        $this->db->from('almacen_categorias');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $this->db->or_like('fecha_vcat', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vcat', 'ACTIVO');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablamarcasact_count()
    {
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_tablamarcasact($limite, $iniciar)
    {
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('almacen_marcas');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }
    public function tablamarcasact_search($limite, $iniciar, $buscar)
    {
        $this->db->from('almacen_marcas');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');
        $this->db->or_like('fecha_vmarcas', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vmarcas', 'ACTIVO');
        $this->db->limit($limite, $iniciar);

        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }
    public function tablamarcasact_search_count($buscar)
    {
        $this->db->from('almacen_marcas');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');
        $this->db->or_like('fecha_vmarcas', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vmarcas', 'ACTIVO');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablatiposact_count()
    {
        $this->db->where('estado_vtipos', 'ACTIVO');
        $query = $this->db->get('clientes_tiposclientes');
        return $query->num_rows();
    }

    public function all_tablatiposact($limite, $iniciar)
    {
        $this->db->where('estado_vtipos', 'ACTIVO');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get('clientes_tiposclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablatiposact_search($limite, $iniciar, $buscar)
    {
        $this->db->from('clientes_tiposclientes');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vtipos', 'ACTIVO');
        $this->db->limit($limite, $iniciar);

        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablatiposact_search_count($buscar)
    {
        $this->db->from('clientes_tiposclientes');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vtipos', 'ACTIVO');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function sumaactivos()
    {
        $this->db->where('estado_prod', 'ACTIVO');
        $activos_prod = $this->db->get('almacen_productos')->num_rows();

        $this->db->where('estado_vcat', 'ACTIVO');
        $activos_cat = $this->db->get('almacen_categorias')->num_rows();

        $this->db->where('estado_vmarcas', 'ACTIVO');
        $activos_marcas = $this->db->get('almacen_marcas')->num_rows();

        $this->db->where('estado_vtipos', 'ACTIVO');
        $activos_tiposclientes = $this->db->get('clientes_tiposclientes')->num_rows();

        $activostotales = $activos_prod + $activos_cat + $activos_marcas + $activos_tiposclientes;

        return $activostotales;
         
    }

    public function all_tablaprodinact_count()
    {
        $this->db->where('estado_prod', 'INACTIVO');
        $query = $this->db->get('almacen_productos');
        return $query->num_rows();
    }

    public function all_tablaprodinact($limite, $iniciar)
    {
        $this->db->where('estado_prod', 'INACTIVO');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('almacen_productos');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablaprodinact_search($iniciar, $limite, $buscar)
    {
        $this->db->from('almacen_productos');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('modelo', $buscar, 'both');
        $this->db->or_like('estado_prod', $buscar, 'both');
        $this->db->or_like('fecha_vprod', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_prod', 'INACTIVO');
        $this->db->limit($limite, $iniciar);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablaprodinact_search_count($buscar)
    {
        $this->db->from('almacen_productos');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('modelo', $buscar, 'both');
        $this->db->or_like('estado_prod', $buscar, 'both');
        $this->db->or_like('fecha_vprod', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_prod', 'INACTIVO');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablacatinact_count()
    {
        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->num_rows();
    }

    public function all_tablacatinact($limite, $iniciar)
    {
        $this->db->where('estado_vcat', 'INACTIVO');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get('almacen_categorias');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacatainact_search($iniciar, $limite, $buscar)
    {
        $this->db->from('almacen_categorias');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $this->db->or_like('fecha_vcat', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vcat', 'INACTIVO');
        $this->db->limit($iniciar, $limite);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacatinact_search_count($buscar)
    {
        $this->db->from('almacen_categorias');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $this->db->or_like('fecha_vcat', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function all_tablamarcasinact_count()
    {
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_tablamarcasinact($iniciar, $limite)
    {
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get('almacen_marcas');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablamarcasinact_search($iniciar, $limite, $buscar)
    {
        $this->db->from('almacen_marcas');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');
        $this->db->or_like('fecha_vmarcas', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vmarcas', 'INACTIVO');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablamarcasinact_search_count($buscar)
    {
        $this->db->from('almacen_marcas');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');
        $this->db->or_like('fecha_vmarcas', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablatiposinact_count()
    {
        $this->db->where('estado_vtipos', 'INACTIVO');
        $query = $this->db->get('clientes_tiposclientes');
        return $query->num_rows();
    }

    public function all_tablatiposinact($iniciar, $limite)
    {
        $this->db->where('estado_vtipos', 'INACTIVO');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get('clientes_tiposclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablatiposinact_search($iniciar, $limite, $buscar)
    {
        $this->db->from('clientes_tiposclientes');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vtipos', 'INACTIVO');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablatiposinact_search_count($buscar)
    {
        $this->db->from('clientes_tiposclientes');

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_vtipos', 'INACTIVO');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function sumainactivos()
    {
        $this->db->where('estado_prod', 'INACTIVO');
        $inactivos_prod = $this->db->get('almacen_productos')->num_rows();

        $this->db->where('estado_vcat', 'INACTIVO');
        $inactivos_cat = $this->db->get('almacen_categorias')->num_rows();

        $this->db->where('estado_vmarcas', 'INACTIVO');
        $inactivos_marcas = $this->db->get('almacen_marcas')->num_rows();

        $this->db->where('estado_vtipos', 'INACTIVO');
        $inactivos_tiposclientes = $this->db->get('clientes_tiposclientes')->num_rows();

        $inactivostotales = $inactivos_prod + $inactivos_cat + $inactivos_marcas + $inactivos_tiposclientes;

        return $inactivostotales;
    }
}
?>
<?php
class mconsulta_fechas extends CI_Model
{
    function __construct()
    {
        parent::__construct();    
    }

    public function all_tablaprodact_count($fechauno, $fechados)
    {        
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }
        $this->db->where('estado_prod', 'ACTIVO');
        $query = $this->db->get('almacen_productos');
        return $query->num_rows();
    }

    public function all_tablaprodact($limite, $iniciar, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }
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

    public function tablaprodact_search($limite, $iniciar, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_productos');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }

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

    public function tablaprodact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_productos');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }

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

    public function all_tablacatact_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }
        $this->db->where('estado_vcat', 'ACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->num_rows();
    }

    public function all_tablacatact($limite, $iniciar, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }
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

    public function tablacatact_search($limite, $iniciar, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_categorias');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }

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

    public function tablacatact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_categorias');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }

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

    public function all_tablamarcasact_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_tablamarcasact($limite, $iniciar, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }
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
    public function tablamarcasact_search($limite, $iniciar, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_marcas');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }

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
    public function tablamarcasact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_marcas');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }

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

    public function all_tablaprodinact_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }
        $this->db->where('estado_prod', 'INACTIVO');
        $query = $this->db->get('almacen_productos');
        return $query->num_rows();
    }
    public function all_tablaprodinact($limite, $iniciar, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }
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
    public function tablaprodinact_search($limite, $iniciar, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_productos');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }

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
    public function tablaprodinact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_productos');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vprod >=', $fechauno);
            $this->db->where('fecha_vprod <=', $fechados);
        }

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

    public function all_tablacatinact_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }
        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->num_rows();
    }

    public function all_tablacatinact($limite, $iniciar, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }
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

    public function tablacatinact_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_categorias');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }

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

    public function tablacatinact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_categorias');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcat >=', $fechauno);
            $this->db->where('fecha_vcat <=', $fechados);
        }

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

    public function all_tablamarcasinact_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_tablamarcasinact($iniciar, $limite, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }
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

    public function tablamarcasinact_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_marcas');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }

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

    public function tablamarcasinact_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('almacen_marcas');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vmarcas >=', $fechauno);
            $this->db->where('fecha_vmarcas <=', $fechados);
        }

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

    public function all_tablacotpen_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->where('estado_borrador', 'Pendiente');
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_tablacotpen($iniciar, $limite, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }
        $this->db->where('estado_borrador', 'Pendiente');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('cotizador_borradores');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacotpen_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {
        $this->db->from('cotizador_borradores');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('folio_cotizacion', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_borrador', 'Pendiente');
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

    public function tablacotpen_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('cotizador_borradores');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('folio_cotizacion', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_borrador', 'Pendiente');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function all_tablacotter_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->where('estado_borrador', 'Terminada');
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_tablacotter($iniciar, $limite, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->where('estado_borrador', 'Terminada');
        $this->db->limit($iniciar, $limite);
        $query = $this->db->get('cotizador_borradores');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablacotter_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {
        $this->db->from('cotizador_borradores');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('folio_cotizacion', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_borrador', 'Terminada');
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

    public function tablacotter_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('cotizador_borradores');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vcot >=', $fechauno);
            $this->db->where('fecha_vcot <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('folio_cotizacion', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('estado_borrador', 'Terminada');

        $query = $this->db->get();
        return $query->num_rows();
    }    

    public function all_tablaclientesdisp_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);            
        }          
        $this->db->where('disponible_vtotal', 'DISPONIBLE');
        $query = $this->db->get('clientes_totalclientes');
        return $query->num_rows();
           
    }

    public function all_tablaclientesdisp($iniciar, $limite, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);            
        }    
        $this->db->where('disponible_vtotal', 'DISPONIBLE');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('clientes_totalclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
                
    }

    public function tablaclientesdisp_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {        
        $this->db->from('clientes_totalclientes');
        if($fechauno && $fechados)
        {            
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);        
        }                
        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('disponible_vtotal', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('disponible_vtotal', 'DISPONIBLE');
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

    public function tablaclientesdisp_search_count($buscar, $fechauno, $fechados)
    {   
        $this->db->from('clientes_totalclientes');     
        if($fechauno && $fechados)
        {            
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);                   
        }                    
        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('disponible_vtotal', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('disponible_vtotal', 'DISPONIBLE');

        $query = $this->db->get();
        return $query->num_rows();              
    }

    public function all_tablaclientesnodisp_count($fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);
        }

        $this->db->where('disponible_vtotal', 'NO DISPONIBLE');
        $query = $this->db->get('clientes_totalclientes');
        return $query->num_rows();
    }

    public function all_tablaclientesnodisp($iniciar, $limite, $fechauno, $fechados)
    {
        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);
        }

        $this->db->where('disponible_vtotal', 'NO DISPONIBLE');
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('clientes_totalclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }

    public function tablaclientesnodisp_search($iniciar, $limite, $buscar, $fechauno, $fechados)
    {
        $this->db->from('clientes_totalclientes');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('disponible_vtotal', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('disponible_vtotal', 'NO DISPONIBLE');
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

    public function tablaclientesnodisp_search_count($buscar, $fechauno, $fechados)
    {
        $this->db->from('clientes_totalclientes');

        if($fechauno && $fechados)
        {
            $this->db->where('fecha_vtotal >=', $fechauno);
            $this->db->where('fecha_vtotal <=', $fechados);
        }

        $this->db->group_start();
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('disponible_vtotal', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');
        $this->db->group_end();

        $this->db->where('disponible_vtotal', 'NO DISPONIBLE');

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

    public function sumacotizaciones()
    {
        $this->db->where('estado_borrador', 'Pendiente');
        $pendientes = $this->db->get('cotizador_borradores')->num_rows();

        $this->db->where('estado_borrador', 'Terminada');
        $terminadas = $this->db->get('cotizador_borradores')->num_rows();

        $totalcotizaciones = $pendientes + $terminadas;

        return $totalcotizaciones;
    } 

    public function sumaclientes()
    {
        $this->db->where('disponible_vtotal', 'DISPONIBLE');
        $disponibles = $this->db->get('clientes_totalclientes')->num_rows();

        $this->db->where('disponible_vtotal', 'NO DISPONIBLE');
        $nodisponibles = $this->db->get('clientes_totalclientes')->num_rows();

        $totalclientes = $disponibles + $nodisponibles;

        return $totalclientes;
    }

    public function verprodactinact_fechasvcon($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_productos');
        return $query->row();
    }

    public function vercatactinact_fechasvcon($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_categorias');
        return $query->row();
    }

    public function vermarcasactinact_fechasvcon($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_marcas');
        return $query->row();
    }

    public function vertiposactinact_fechasvcon($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_tiposclientes');
        return $query->row();
    }

    public function datoscotpenter_fechasvcon($folio_cotpenter)
    {
        $this->db->where('folio_cotizacion', $folio_cotpenter);
        $query = $this->db->get('cotizador_borradores');
        return $query->row();
    }

    public function datoshtml_fechasvcon($folio_cotpenter)
    {
        $this->db->where('folio_cotizacion', $folio_cotpenter);
        $query = $this->db->get('tablahtml_borrador');
        return $query->result_array();
    }

    public function verclientesdispnodisp_fechasvcon($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_totalclientes');
        return $query->row();
    }

}
?>
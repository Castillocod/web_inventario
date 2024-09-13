<?php
class mgenerarcot extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function obtenertc()
    {
        $query = $this->db->get('clientes_tiposclientes');
        return $query->result_array();
    }

    public function almacen_productos()
    {
        $query = $this->db->get('almacen_productos');
        return $query->result_array();
    }

    public function obtenerclientesxtp($tc_cliente, $tipocliente_ls)
    {
        $this->db->where('tipocliente', $tc_cliente);
        $this->db->or_where('tipocliente', $tipocliente_ls);
        $query = $this->db->get('clientes_totalclientes');
        return $query->result_array();
    }

    public function obtenerprodxcl()
    {
        $query = $this->db->get('almacen_productos');
        return $query->result_array();
    }

    public function buscarxcod($buscar)
    {
        $this->db->select('modelo');
        $this->db->from('almacen_productos');
        $this->db->where('id', $buscar);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->row()->modelo;
        }
        else
        {
            return null;
        }
    }

    public function obtenertotalclientes($tc_cliente, $cliente_prod)
    {
        $this->db->select(
            'clientes_totalclientes.id as cliente_id,
            clientes_totalclientes.nombre as cliente_nombre,
            clientes_totalclientes.tipocliente,
            almacen_productos.id as producto_id,
            almacen_productos.modelo,
            almacen_productos.marca,
            cotizador_formulas.preciodolar,
            cotizador_formulas.iva,
            cotizador_formulas.porcentajeintegrador,
            cotizador_formulas.porcentajetienda'
        );

        $this->db->from('clientes_totalclientes');
        $this->db->join('almacen_productos', 'clientes_totalclientes.id = almacen_productos.id', 'left');
        $this->db->join('cotizador_formulas', 'almacen_productos.id = cotizador_formulas.preciodolar', 'left');
        $this->db->where('clientes_totalclientes.tipocliente', $tc_cliente);
        $this->db->where('clientes_totalclientes.nombre', $cliente_prod);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function obtenerproductos($sel_prod)
    {
        $this->db->where('modelo', $sel_prod['modelo']);
        $this->db->or_where('id', $sel_prod['id']);
        $query = $this->db->get('almacen_productos');
        return $query->result_array();
    }

    public function formulas()
    {
        $query = $this->db->get('cotizador_formulas');
        return $query->result_array();
    }

    public function crearcotizacion($datos_recibidos)
    {
        $this->db->where($datos_recibidos);
        $query = $this->db->get('almacen_productos');

        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
}
?>
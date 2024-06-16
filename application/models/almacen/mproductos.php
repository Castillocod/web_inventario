<?php 
class mproductos extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function obtenermarcas()
    {
        $this->db->where('estado_vmarcas', 'Activo');
        $query = $this->db->get('almacen_marcas');
        return $query->result_array();
    }

    public function obtenercategorias()
    {
        $this->db->where('estado_vcat', 'Activo');
        $query = $this->db->get('almacen_categorias');
        return $query->result_array();
    }

    public function all_vproductos_count()
    {
        $query = $this->db->get('almacen_productos');
        return $query->num_rows();
    }

    public function all_vproductos($limit, $start, $col, $dir)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
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

    public function vproductos_search($limit, $start, $search, $col, $dir)
    {
        $this->db->from('almacen_productos');
        $this->db->like('id', $search, 'both');
        $this->db->or_like('modelo', $search, 'both');
        $this->db->or_like('marca', $search, 'both');
        // $this->db->or_like('categoria', $search, 'both');
        $this->db->or_like('titulo', $search, 'both');
        $this->db->or_like('stock', $search, 'both');
        $this->db->or_like('preciolista', $search, 'both');
        $this->db->or_like('precioespecial', $search, 'both');
        $this->db->or_like('preciooriginal', $search, 'both');
        $this->db->or_like('preciointegrado', $search, 'both');
        $this->db->or_like('preciotienda', $search, 'both');
        $this->db->or_like('codigofiscal', $search, 'both');
        $this->db->or_like('estado_prod', $search, 'both');
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
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
    public function vproductos_search_count($search)
    {
        $this->db->from('almacen_productos');
        $this->db->like('id', $search, 'both');
        $this->db->or_like('modelo', $search, 'both');
        $this->db->or_like('marca', $search, 'both');
        // $this->db->or_like('categoria', $search, 'both');
        $this->db->or_like('titulo', $search, 'both');
        $this->db->or_like('stock', $search, 'both');
        $this->db->or_like('preciolista', $search, 'both');
        $this->db->or_like('precioespecial', $search, 'both');
        $this->db->or_like('preciooriginal', $search, 'both');
        $this->db->or_like('preciointegrado', $search, 'both');
        $this->db->or_like('preciotienda', $search, 'both');
        $this->db->or_like('codigofiscal', $search, 'both');
        $this->db->or_like('estado_prod', $search, 'both');
        $query = $this->db->get();   
        return $query->result();
    }
    public function agregarproductos($data)
    {
        return $this->db->insert('almacen_productos', $data);
    }

    public function productostock($modelo, $marca, $titulo, $codigofiscal)
    {
        $this->db->select('*');
        $this->db->from('almacen_productos');
        $this->db->where(array(
            'modelo' => $modelo,
            'marca' => $marca,
            'titulo' => $titulo,
            'codigofiscal' => $codigofiscal
        ));

        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return false;
        }
    }

    public function actualizarstock($productostock, $actualizarstock, $ajax_data)
    {
        $stock_actual = $this->db->get_where('almacen_productos', array('id' => $productostock))->row()->stock;
        $nuevo_stock = $actualizarstock + $stock_actual;

        $this->db->set('stock', $nuevo_stock);
        $this->db->where('id', $productostock);
        $this->db->update('almacen_productos');

        return $this->db->affected_rows();
    }

    public function actualizarproductos($data)
    {
        return $this->db->update('almacen_productos', $data, array('id' => $data['id']));
    }

    public function editarproductos($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_productos');
        return $query->row();
    }

    public function eliminarproductos($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('almacen_productos');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function obtenerformulas()
    {
        $query = $this->db->get('cotizador_formulas');
        return $query->result_array();
    }

    public function actualizarstockexcel($id_producto, $newstock)
    {
        $this->db->set('stock', $newstock);
        $this->db->where('id', $id_producto);
        $this->db->update('almacen_productos');

        return $this->db->affected_rows();
    }

    public function obtenerporcentajes()
    {
        $this->db->select('porcentajeintegrador, porcentajetienda');
        $this->db->from('cotizador_formulas');
        $query = $this->db->get();

        $porcentajes = array();
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $porcentajes['porcentajeintegrador'] = $row->porcentajeintegrador;
                $porcentajes['porcentajetienda'] = $row->porcentajetienda;
            }
        }
        return $porcentajes;
    }
}
?>
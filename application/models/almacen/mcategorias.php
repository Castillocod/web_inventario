<?php 
class mcategorias extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function conteocategorias()
    {
           $query = $this->db->get('almacen_categorias');
           return $query->num_rows();
    }

    public function totalcategorias($limite, $iniciar)
    {
        $this->db->limit($limite, $iniciar);
        // $this->db->order_by($col, $dir);
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

    public function buscar_categorias($limite, $iniciar, $buscar)
    {
        $this->db->from('almacen_categorias');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $this->db->limit($limite, $iniciar);
        // $this->db->order_by($col, $dir);
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

    public function conteocategorias_buscar($buscar)
    {
        $this->db->from('almacen_categorias');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('categoria', $buscar, 'both');
        $this->db->or_like('estado_vcat', $buscar, 'both');
        $query = $this->db->get();
        return $query->result();
    }

    public function agregarcategorias($data)
    {
        return $this->db->insert('almacen_categorias', $data);
    }

    public function actualizarcategorias($data)
    {
        return $this->db->update('almacen_categorias', $data, array('id' => $data['id']));
    }

    public function editarcategorias($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_categorias');
        return $query->row();
    }

    public function eliminarcategorias($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('almacen_categorias');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function pdf_categorias_activas()
    {
        $this->db->where('estado_vcat', 'Activo');
        $query = $this->db->get('almacen_categorias');
        return $query->result_array();
    }

    public function pdf_categorias_inactivas()
    {
        $this->db->where('estado_vcat', 'Inactivo');
        $query = $this->db->get('almacen_categorias');
        return $query->result_array();
    }
}
?>
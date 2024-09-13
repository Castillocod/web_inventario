<?php
class madi_clientes extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvadi()
    {
        $query = $this->db->get('clientes_totalclientes');
        return $query->num_rows();
    }

    public function all_vadi_count()
    {
        $query = $this->db->get('clientes_totalclientes');
        return $query->num_rows();
    }

    public function all_vadi($limite, $iniciar)
    {
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('clientes_totalclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }

    public function vadi_search($limite, $iniciar, $buscar)
    {
        $this->db->from('clientes_totalclientes');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('direccion', $buscar, 'both');
        $this->db->or_like('correo', $buscar, 'both');
        $this->db->or_like('telefono', $buscar, 'both');
        $this->db->or_like('rfc', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');
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

    public function vadi_search_count($buscar)
    {
        $this->db->from('clientes_totalclientes');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('nombre', $buscar, 'both');
        $this->db->or_like('direccion', $buscar, 'both');
        $this->db->or_like('correo', $buscar, 'both');
        $this->db->or_like('telefono', $buscar, 'both');
        $this->db->or_like('rfc', $buscar, 'both');
        $this->db->or_like('fecha_vtotal', $buscar, 'both');

        $query = $this->db->get();
        return $query->result();
    }

    public function ver_vadi($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_totalclientes');
        return $query->row();
    }
}
?>
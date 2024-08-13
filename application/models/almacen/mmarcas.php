<?php

class mmarcas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvmarcas()
    {
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_vmarcas_count()
    {
        $query = $this->db->get('almacen_marcas');
        return $query->num_rows();
    }

    public function all_vmarcas($limite, $iniciar)
    {
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

    public function vmarcas_search($limite, $iniciar, $buscar)
    {
        $this->db->from('almacen_marcas');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');
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

    public function vmarcas_search_count($buscar)
    {
        $this->db->from('almacen_marcas');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('marca', $buscar, 'both');
        $this->db->or_like('estado_vmarcas', $buscar, 'both');

        $query = $this->db->get();
        return $query->result();
    }

    public function agregarvmarcas($data)
    {
        return $this->db->insert('almacen_marcas', $data);
    }

    public function editarvmarcas($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('almacen_marcas');
        return $query->row();
    }
    
    public function actualizarvmarcas($data)
    {
        return $this->db->update('almacen_marcas', $data, array('id' => $data['id']));
    }

    public function eliminarvmarcas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('almacen_marcas');

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function primerfecha()
    {
        $this->db->select_min('fecha_vmarcas');
        $query = $this->db->get('almacen_marcas');
        return $query->row()->fecha_vmarcas;
    }

    public function ultimafecha()
    {
        $this->db->select_max('fecha_vmarcas');
        $query = $this->db->get('almacen_marcas');
        return $query->row()->fecha_vmarcas;
    }

    public function primermes()
    {
        $this->db->select('MIN(DATE_FORMAT(fecha_vmarcas, "%Y-%m")) as mes');
        $query = $this->db->get('almacen_marcas');
        return $query->row()->mes;
    }

    public function ultimomes()
    {
        $this->db->select('MAX(DATE_FORMAT(fecha_vmarcas, "%Y-%m")) as mes');
        $query = $this->db->get('almacen_marcas');
        return $query->row()->mes;
    }

    public function excelfechas_vmarcas($fechauno_excelvmarcas, $fechados_excelvmarcas)
    {
        $this->db->where('fecha_vmarcas >=', $fechauno_excelvmarcas);
        $this->db->where('fecha_vmarcas <=', $fechados_excelvmarcas);
        $this->db->order_by('id');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function excelmes_vmarcas($mes_excelvmarcas)
    {
        $this->db->where('DATE_FORMAT(fecha_vmarcas, "%Y-%m") =', $mes_excelvmarcas);
        $this->db->order_by('id');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function exceltotal_vmarcas()
    {
        $this->db->order_by('id');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfactfechas_vmarcas($fechauno_actvmarcas, $fechados_actvmarcas)
    {
        $this->db->where('fecha_vmarcas >=', $fechauno_actvmarcas);
        $this->db->where('fecha_vmarcas <=', $fechados_actvmarcas);
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfactmes_vmarcas($mes_actvmarcas)
    {
        $this->db->where('DATE_FORMAT(fecha_vmarcas, "%Y-%m") =', $mes_actvmarcas);
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfacttotal_vmarcas()
    {
        $this->db->where('estado_vmarcas', 'ACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfinactfechas_vmarcas($fechauno_inactvmarcas, $fechados_inactvmarcas)
    {
        $this->db->where('fecha_vmarcas >=', $fechauno_inactvmarcas);
        $this->db->where('fecha_vmarcas <=', $fechados_inactvmarcas);
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfinactmes_vmarcas($mes_inactvmarcas)
    {
        $this->db->where('DATE_FORMAT(fecha_vmarcas, "%Y-%m") =', $mes_inactvmarcas);
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }

    public function pdfinacttotal_vmarcas()
    {
        $this->db->where('estado_vmarcas', 'INACTIVO');
        $query = $this->db->get('almacen_marcas');
        return $query->result();
    }
}

?>
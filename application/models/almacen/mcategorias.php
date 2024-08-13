<?php 
class mcategorias extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvcat()
    {
        $query = $this->db->get('almacen_categorias');
        return $query->num_rows();
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

    public function primerfecha()
    {
        $this->db->select_min('fecha_vcat');
        $query = $this->db->get('almacen_categorias');
        return $query->row()->fecha_vcat;
    }

    public function ultimafecha()
    {
        $this->db->select_max('fecha_vcat');
        $query = $this->db->get('almacen_categorias');
        return $query->row()->fecha_vcat;
    }

    public function primermes()
    {
        $this->db->select('MIN(DATE_FORMAT(fecha_vcat, "%Y-%m")) as mes');
        $query = $this->db->get('almacen_categorias');
        return $query->row()->mes;
    }

    public function ultimomes()
    {
        $this->db->select('MAX(DATE_FORMAT(fecha_vcat, "%Y-%m")) as mes');
        $query = $this->db->get('almacen_categorias');
        return $query->row()->mes;
    }

    public function excelfechas_vcat($fechauno_excelvcat, $fechados_excelvcat)
    {
        $this->db->where('fecha_vcat >=', $fechauno_excelvcat);
        $this->db->where('fecha_vcat <=', $fechados_excelvcat);
        $this->db->order_by('id');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function excelmes_vcat($mes_excelvcat)
    {
        $this->db->where('DATE_FORMAT(fecha_vcat, "%Y-%m") =', $mes_excelvcat);
        $this->db->order_by('id');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function exceltotal_vcat()
    {
        $this->db->order_by('id');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfactfechas_vcat($fechauno_actvcat, $fechados_actvcat)
    {
        $this->db->where('fecha_vcat >=', $fechauno_actvcat);
        $this->db->where('fecha_vcat <=', $fechados_actvcat);
        $this->db->where('estado_vcat', 'ACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfactmes_vcat($mes_actvcat)
    {
        $this->db->where('DATE_FORMAT(fecha_vcat, "%Y-%m") =', $mes_actvcat);
        $this->db->where('estado_vcat', 'ACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfacttotal_vcat()
    {
        $this->db->where('estado_vcat', 'ACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfinactfechas_vcat($fechauno_inactvcat, $fechados_inactvcat)
    {
        $this->db->where('fecha_vcat >=', $fechauno_inactvcat);
        $this->db->where('fecha_vcat <=', $fechados_inactvcat);
        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfinactmes_vcat($mes_inactvcat)
    {
        $this->db->where('DATE_FORMAT(fecha_vcat, "%Y-%m") =', $mes_inactvcat);
        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }

    public function pdfinacttotal_vcat()
    {
        $this->db->where('estado_vcat', 'INACTIVO');
        $query = $this->db->get('almacen_categorias');
        return $query->result();
    }
}
?>
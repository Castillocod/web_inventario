<?php 
class mtipos_clientes extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvtipos()
    {
        $query = $this->db->get('clientes_tiposclientes');
        return $query->num_rows();
    }

    public function all_vtipos_count()
    {
        $query = $this->db->get('clientes_tiposclientes');
        return $query->num_rows();
    }

    public function all_vtipos($limite, $iniciar)
    {
        $this->db->limit($limite, $iniciar);
        $query = $this->db->get('clientes_tiposclientes');

        if($query->num_rows() > 0)
        {
            return $query->result();
        }
    }

    public function vtipos_search($limite, $iniciar, $buscar)
    {
        $this->db->from('clientes_tiposclientes');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('cantclientes', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
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

    public function vtipos_search_count($buscar)
    {
        $this->db->from('clientes_tiposclientes');
        $this->db->like('id', $buscar, 'both');
        $this->db->or_like('tipocliente', $buscar, 'both');
        $this->db->or_like('cantclientes', $buscar, 'both');
        $this->db->or_like('estado_vtipos', $buscar, 'both');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function agregarvtipos($data)
    {
        return $this->db->insert('clientes_tiposclientes', $data);
    }

    public function editarvtipos($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_tiposclientes');
        return $query->row();
    }

    public function actualizarvtipos($data)
    {
        return $this->db->update('clientes_tiposclientes', $data, array('id' => $data['id']));
    }

    public function eliminarvtipos($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clientes_tiposclientes');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function exceltotal_vtipos()
    {
        $this->db->order_by('id');
        $query = $this->db->get('clientes_tiposclientes');
        return $query->result();
    }

    public function pdfacttotal_vtipos()
    {
        $this->db->where('estado_vtipos', 'ACTIVO');
        $query = $this->db->get('clientes_tiposclientes');
        return $query->result_array();
    }

    public function pdfinacttotal_vtipos()
    {
        $this->db->where('estado_vtipos', 'INACTIVO');
        $query = $this->db->get('clientes_tiposclientes');
        return $query->result_array();
    }

    public function actualizarestado()
    {
        $this->db->select('tipocliente, COUNT(*) as cantidad_clientes');
        $this->db->from('clientes_totalclientes');
        $this->db->group_by('tipocliente');
        $subquery = $this->db->get_compiled_select();

        $sql = "UPDATE clientes_tiposclientes ctp
                LEFT JOIN (
                    SELECT tipocliente, COUNT(*) AS cantclientes
                    FROM clientes_totalclientes
                    GROUP BY tipocliente
                ) sub ON ctp.tipocliente = sub.tipocliente
                SET ctp.estado_vtipos = CASE 
                    WHEN IFNULL(sub.cantclientes, 0) = 0 
                    THEN 'INACTIVO' 
                    ELSE 'ACTIVO' 
                END,
                ctp.cantclientes = IFNULL(sub.cantclientes, 0)";

        $this->db->query($sql);
    }
}
?>
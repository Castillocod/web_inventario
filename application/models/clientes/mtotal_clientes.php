<?php 
class mtotal_clientes extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvtotal()
    {
        $query = $this->db->get('clientes_totalclientes');
        return $query->num_rows();
    }

    public function agregarvtotal($data)
    {
        $this->db->insert('clientes_totalclientes', $data);

        $tipocliente = $data['tipocliente'];

        $this->db->set('cantclientes', 'cantclientes+1', false);
        $this->db->where('tipocliente', $tipocliente);
        $this->db->update('clientes_tiposclientes');

        return $this->db->affected_rows() > 0;
    }

    public function editarvtotal($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_totalclientes');
        return $query->row();
    }

    public function actualizarvtotal($data)
    {
        return $this->db->update('clientes_totalclientes', $data, array('id' => $data['id']));
    }

    public function eliminarvtotal($id)
    {
        $this->db->select('tipocliente');
        $this->db->where('id', $id);
        $query = $this->db->get('clientes_totalclientes');
        $row = $query->row();

        $this->db->where('id', $id);
        $this->db->delete('clientes_totalclientes');

        if($row)
        {
            $this->actualizarcantclientes($row->tipocliente);
        }

        return $this->db->affected_rows() > 0;
    }

    private function actualizarcantclientes($tipocliente)
    {
        $this->db->select('COUNT(*) as total_clientes');
        $this->db->where('tipocliente', $tipocliente);
        $query = $this->db->get('clientes_totalclientes');
        $row = $query->row();

        $this->db->set('cantclientes', $row->total_clientes);
        $this->db->where('tipocliente', $tipocliente);
        $this->db->update('clientes_tiposclientes');
    }

    public function primerfecha()
    {
        $this->db->select_min('fecha_vtotal');
        $query = $this->db->get('clientes_totalclientes');
        return $query->row()->fecha_vtotal;
    }

    public function ultimafecha()
    {
        $this->db->select_max('fecha_vtotal');
        $query = $this->db->get('clientes_totalclientes');
        return $query->row()->fecha_vtotal;
    }

    public function primermes()
    {
        $this->db->select('MIN(DATE_FORMAT(fecha_vtotal, "%Y-%m")) as mes');
        $query = $this->db->get('clientes_totalclientes');
        return $query->row()->mes;
    }

    public function ultimomes()
    {
        $this->db->select('MAX(DATE_FORMAT(fecha_vtotal, "%Y-%m")) as mes');
        $query = $this->db->get('clientes_totalclientes');
        return $query->row()->mes;
    }

    public function excelfechas_vtotal($fechauno_excelvtotal, $fechados_excelvtotal)
    {
        $this->db->where('fecha_vtotal >=', $fechauno_excelvtotal);
        $this->db->where('fecha_vtotal <=', $fechados_excelvtotal);
        $this->db->order_by('id');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function excelmes_vtotal($mes_excelvtotal)
    {
        $this->db->where('DATE_FORMAT(fecha_vtotal, "%Y-%m") =', $mes_excelvtotal);
        $this->db->order_by('id');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function exceltotal_vtotal()
    {
        $this->db->order_by('id');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfactfechas_vtotal($fechauno_actvtotal, $fechados_actvtotal)
    {
        $this->db->where('fecha_vtotal >=', $fechauno_actvtotal);
        $this->db->where('fecha_vtotal <=', $fechados_actvtotal);
        $this->db->where('estado_vtotal', 'ACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfactmes_vtotal($mes_actvtotal)
    {
        $this->db->where('DATE_FORMAT(fecha_vtotal, "%Y-%m") =', $mes_actvtotal);
        $this->db->where('estado_vtotal', 'ACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfacttotal_vtotal()
    {
        $this->db->where('estado_vtotal', 'ACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfinactfechas_vtotal($fechauno_inactvtotal, $fechados_inactvtotal)
    {
        $this->db->where('fecha_vtotal >=', $fechauno_inactvtotal);
        $this->db->where('fecha_vtotal <=', $fechados_inactvtotal);
        $this->db->where('estado_vtotal', 'INACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfinactmes_vtotal($mes_inactvtotal)
    {
        $this->db->where('DATE_FORMAT(fecha_vtotal, "%Y-%m") =', $mes_inactvtotal);
        $this->db->where('estado_vtotal', 'INACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }

    public function pdfinacttotal_vtotal()
    {
        $this->db->where('estado_vtotal', 'INACTIVO');
        $query = $this->db->get('clientes_totalclientes');
        return $query->result();
    }
}
?>
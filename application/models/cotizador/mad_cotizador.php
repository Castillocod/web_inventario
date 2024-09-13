<?php 
class mad_cotizador extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function comprobacionvcot()
    {
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_totalcotizaciones_count()
    {
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_totalpendientes_count()
    {
        $this->db->where('estado_borrador', 'Pendiente');
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_totalterminadas_count()
    {
        $this->db->where('estado_borrador', 'Terminada');
        $query = $this->db->get('cotizador_borradores');
        return $query->num_rows();
    }

    public function all_cotizaciones($limite, $iniciar)
    {
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

    public function cotizaciones_search($limite, $iniciar, $buscar)
    {
        $this->db->from('cotizador_borradores');
        $this->db->like('folio_cotizaciones', $buscar, 'both');
        $this->db->or_like('tipocliente_cot', $buscar, 'both');
        $this->db->or_like('idcliente_cot', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->or_like('hora_vcot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');
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

    public function cotizaciones_search_count($buscar)
    {
        $this->db->from('cotizador_borradores');
        $this->db->like('folio_cotizaciones', $buscar, 'both');
        $this->db->or_like('tipocliente_cot', $buscar, 'both');
        $this->db->or_like('idcliente_cot', $buscar, 'both');
        $this->db->or_like('nombrecliente_cot', $buscar, 'both');
        $this->db->or_like('fecha_vcot', $buscar, 'both');
        $this->db->or_like('hora_vcot', $buscar, 'both');
        $this->db->or_like('estado_borrador', $buscar, 'both');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalpendientes()
    {
        $this->db->select('COUNT(*) as total_pendientes');
        $this->db->where('estado_borrador', 'Pendiente');
        $query = $this->db->get('cotizador_borradores');
        return $query->row()->total_pendientes;
    }

    public function totalterminadas()
    {
        $this->db->select('COUNT(*) as total_terminadas');
        $this->db->where('estado_borrador', 'Terminada');
        $query = $this->db->get('cotizador_borradores');
        return $query->row()->total_terminadas;
    }

    public function totalcotizaciones()
    {
        $this->db->select('COUNT(*) as total_cotizaciones');
        $query = $this->db->get('cotizador_borradores');
        return $query->row()->total_cotizaciones;
    }

    public function modificarformulas()
    {
        $query = $this->db->get('cotizador_formulas');
        return $query->result_array();
    }

    public function verdatoscotizacion($folio_cotizacion)
    {
        $this->db->where('folio_cotizacion', $folio_cotizacion);
        $query = $this->db->get('cotizador_borradores');
        return $query->row();
    }

    public function verdatoshtml($folio_cotizacion)
    {
        $this->db->where('folio_cotizaciones', $folio_cotizacion);
        $query = $this->db->get('tablahtml_borrador');
        return $query->result_array();
    }

    public function actualizarformulas($data)
    {
        return $this->db->update('cotizador_formulas', $data);
    }
}
?>
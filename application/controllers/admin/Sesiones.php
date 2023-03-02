<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sesiones extends AdminController
{
	public function index()
	{
		$query = $this->db->query("
			SELECT
				tblparts.id AS id,
				tblparts.id_sale AS nro_factura,
				tblparts.realized AS realizados,
				tblparts.quantity AS cantidad,
				(SELECT tblclients.company FROM tblclients WHERE tblclients.userid = tblparts.id_client) AS paciente,
				(SELECT tblitems.description FROM tblitems WHERE tblitems.id = tblparts.id_item) AS tratamiento
			FROM
				tblparts
		");

		if (isset($_GET['search'])) {
			$search = $_GET['search'];

			$query = $this->db->query("
				SELECT
					*,
					(SELECT tblclients.company FROM tblclients WHERE tblclients.userid = tblparts.id_client) AS paciente,
					(SELECT tblitems.description FROM tblitems WHERE tblitems.id = tblparts.id_item) AS tratamiento
				FROM
					tblparts
				WHERE
					(SELECT tblclients.company FROM tblclients WHERE tblclients.userid = tblparts.id_client) LIKE '%$search%'
			");			
		}

		$data['sesiones'] = $query->result();
		$this->load->view('admin/sesiones/index', $data);
	}

	public function actualizar()
	{
		$id = $_POST['id'];

        $query = $this->db->query("SELECT * FROM tblparts WHERE id = $id");
        $sesion = $query->row();

        $realized = json_decode($sesion->realized, true);
        $realized[] = [
        	'date' => date('Y-m-d'),
        	'user' => $_SESSION['staff_user_id']
        ];
        $realized = json_encode($realized);

        $query = $this->db->query("UPDATE tblparts SET realized = '$realized' WHERE id = $id");

        redirect('/admin/sesiones');
	}
}
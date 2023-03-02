<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Consultas extends AdminController
{
    public function index()
    {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $where = [];

        if (isset($_GET['estado']) && $_GET['estado'] != '') {
            $estado = $_GET['estado'];
            $where[] = "tblconsultas.estado = '$estado'";
        }

        if (isset($_GET['paciente']) && $_GET['estado'] != '') {
            $paciente = $_GET['paciente'];
            $where[] = "(SELECT company FROM tblclients WHERE tblclients.userid = tblconsultas.id_client) LIKE '%$paciente%'";
        }

        if (isset($_GET['fecha_desde']) && $_GET['fecha_desde'] != '') {
            $fecha_desde = $_GET['fecha_desde'];
            $where[] = "DATE(tblconsultas.fecha) >= '$fecha_desde'";
        }

        if (isset($_GET['fecha_hasta']) && $_GET['fecha_hasta'] != '') {
            $fecha_hasta = $_GET['fecha_hasta'];
            $where[] = "DATE(tblconsultas.fecha) <= '$fecha_hasta'";
        }

        if (empty($where)) {
            $where = '';
        } else {
            $where = ' WHERE ' . implode(' AND ', $where); 
        }

        $query = $this->db->query("
            SELECT
                *,
                (SELECT company FROM tblclients WHERE tblclients.userid = tblconsultas.id_client) AS paciente,
                (SELECT firstname FROM tblstaff WHERE tblstaff.staffid = tblconsultas.id_client) AS profesional
            FROM
                tblconsultas
            $where
        ");

        $data['consultas'] = $query->result();

        $this->load->view('admin/consultas/index', $data);
    }

    public function ver($id)
    {
        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id = $id");
        $data['consulta'] = $query->row();

        $id_client = $data['consulta']->id_client;

        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id_client = $id_client AND tblconsultas.foto_perfil IS NOT NULL");
        $query = $query->row();
        $data['foto_perfil'] = isset($query->foto_perfil) ? $query->foto_perfil : '';

        $query = $this->db->query("SELECT * FROM tblclients");
        $data['clientes'] = $query->result();

        $query = $this->db->query("SELECT * FROM tblstaff");
        $data['profesionales'] = $query->result();

        $data['anamnesis'] = json_decode($data['consulta']->anamnesis);

        $query = $this->db->query("SELECT * FROM tblenfermedades");
        $data['enfermedades'] = $query->result();

        $this->load->view('admin/consultas/ver', $data);
    }

    public function foto()
    {
        $id = $_POST['id'];
        $query = $this->db->query("SELECT tblconsultas.foto_perfil FROM tblconsultas WHERE tblconsultas.id_client = '$id' AND tblconsultas.foto_perfil IS NOT NULL");
        $result = $query->row();
        echo isset($result->foto_perfil) ? '/uploads/consultas/' . $result->foto_perfil : '/assets/images/user-placeholder.jpg';
    }

    public function crear()
    {
        $query = $this->db->query("
            SELECT
                tblclients.*
            FROM
                tblclients
        ");

        $data['clientes'] = $query->result();

        $query = $this->db->query("SELECT * FROM tblstaff");
        $data['profesionales'] = $query->result();

        $query = $this->db->query("SELECT * FROM tblenfermedades");
        $data['enfermedades'] = $query->result();

        $this->load->view('admin/consultas/crear', $data);
    }

    public function guardar()
    {
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $_FILES['foto_perfil']['name']);

        $i = 0;

        foreach ($_FILES['fotos']['name'] as $item) {
            move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $item);

            $i = $i + 1;
        }

        $id_client = $_POST['id_client'];
        $id_staff = $_POST['id_staff'];
        $foto_perfil = $_FILES['foto_perfil']['name'];
        $anamnesis = json_encode($_POST['anamnesis']);
        $edad = $_POST['edad'];
        $monto = $_POST['monto'];
        $fotos = json_encode($_FILES['fotos']['name']);

        $this->db->query("
            INSERT INTO
                tblconsultas
                (monto, edad, foto_perfil, fotos, id_client, id_staff, fecha, anamnesis)
            VALUES
                ('$monto', '$edad', '$foto_perfil', '$fotos', '$id_client', '$id_staff', NOW(), '$anamnesis');
        ");

        $this->session->set_flashdata('success', 'Consulta almacenada satisfactoriamente');

        redirect('/admin/consultas');
    }

    public function editar($id)
    {
        if (isset($_GET['estado']) && $_GET['estado'] == 'En atención') {
            $this->db->query("UPDATE tblconsultas SET estado = 'En atención' WHERE id = $id");
        }

        if (isset($_GET['estado']) && $_GET['estado'] == 'Cancelar') {
            $this->session->set_flashdata('success', 'Consulta cancelada');
            $this->db->query("UPDATE tblconsultas SET estado = 'Cancelada' WHERE id = $id");
            redirect('/admin/consultas');
            return 1;
        }

        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id = $id");
        $data['consulta'] = $query->row();

        $id_client = $data['consulta']->id_client;

        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id_client = $id_client AND tblconsultas.foto_perfil IS NOT NULL");
        $query = $query->row();
        $data['foto_perfil'] = isset($query->foto_perfil) ? $query->foto_perfil : '';

        $query = $this->db->query("SELECT * FROM tblclients");
        $data['clientes'] = $query->result();

        $query = $this->db->query("SELECT * FROM tblstaff");
        $data['profesionales'] = $query->result();

        $data['anamnesis'] = json_decode($data['consulta']->anamnesis);

        $query = $this->db->query("SELECT * FROM tblenfermedades");
        $data['enfermedades'] = $query->result();

        $this->load->view('admin/consultas/editar', $data);
    }

    public function modificar()
    {
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $_FILES['foto_perfil']['name']);

        $i = 0;

        foreach ($_FILES['fotos']['name'] as $item) {
            move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $item);

            $array[] = $item;

            $i = $i + 1;
        }

        $id = $_POST['id'];

        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id = $id");
        $consulta = $query->row();

        $id_client = $_POST['id_client'];
        $id_staff = $_POST['id_staff'];
        $foto_perfil = ($_FILES['foto_perfil']['name']) ? $_FILES['foto_perfil']['name'] : $consulta->foto_perfil;
        $anamnesis = json_encode($_POST['anamnesis']);
        $edad = $_POST['edad'];
        $monto = $_POST['monto'];
        $fotos = json_encode($consulta->fotos);

        if (isset($array)) {
            $fotos = json_decode($consulta->fotos, true);
            $fotos = array_merge($fotos, $array);
            $fotos = json_encode($fotos);
        }

        $this->db->query("
            UPDATE
                tblconsultas
            SET
                id_client = '$id_client',
                id_staff = '$id_staff',
                anamnesis = '$anamnesis',
                foto_perfil = '$foto_perfil',
                fotos = '$fotos',
                monto = '$monto'
            WHERE
                id = $id
        ");

        $this->session->set_flashdata('success', 'Consulta modificada satisfactoriamente');

        redirect('/admin/consultas/editar/' . $id);
    }

    public function eliminar($id)
    {
        $this->db->query("DELETE FROM tblconsultas WHERE id = '$id'");
        $this->session->set_flashdata('success', 'Consulta eliminada satisfactoriamente');
        redirect('/admin/consultas');
    }
}
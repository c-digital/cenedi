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

    public function imprimir($id)
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

        $data['anamnesis'] = json_decode($data['consulta']->anamnesis, true);

        $this->load->view('admin/consultas/imprimir', $data);
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

        $data['anamnesis'] = json_decode($data['consulta']->anamnesis, true);

        $this->load->view('admin/consultas/ver', $data);
    }

    public function foto()
    {
        $id = $_POST['id'];

        $sql = "
            SELECT
                tblconsultas.foto_perfil
            FROM
                tblconsultas
            WHERE
                tblconsultas.id_client = '$id' AND
                tblconsultas.foto_perfil IS NOT NULL
        ";

        $query = $this->db->query($sql);
        $result = $query->row();

        $sql = "
            SELECT
                tblclients.datebirth,
                tblclients.civilstate,
                tblclients.address,
                tblclients.occupation,
                TIMESTAMPDIFF(YEAR,tblclients.datebirth,CURDATE()) AS edad
            FROM
                tblclients
            WHERE
                tblclients.userid = '$id'
        ";

        $query = $this->db->query($sql);
        $result2 = $query->row();

        echo json_encode([
            'foto' => isset($result->foto_perfil) ? '/uploads/consultas/' . $result->foto_perfil : '/assets/images/user-placeholder.jpg',
            'datebirth' => $result2->datebirth,
            'edad' => $result2->edad,
            'civilstate' => $result2->civilstate,
            'address' => $result2->address,
            'occupation' => $result2->occupation,
        ]);
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
        if ($_FILES['foto_perfil']['name']) {
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $_FILES['foto_perfil']['name']);

            $i = 0;
        }        


        $id_client = $_POST['id_client'];
        $id_staff = $_POST['id_staff'];
        $foto_perfil = $_FILES['foto_perfil']['name'];
        $edad = $_POST['edad'];
        $monto = $_POST['monto'];
        $tipo = $_POST['tipo'];

        if ($_POST['tipo'] == 'diabetes') {
            $anamnesis = json_encode([
                'obesidad' => $_POST['obesidad'],
                'hta' => $_POST['hta'],
                'diabetes' => $_POST['diabetes'],
                'iam' => $_POST['iam'],
                'acv' => $_POST['acv'],
                'cancer' => $_POST['cancer'],

                'Alguno de sus hijos peso mas de 4kg al nacer?' => $_POST['Alguno_de_sus_hijos_peso_mas_de_4kg_al_nacer?'],
                'Ha enido algun aborto, muerte, fetal, neonatal?' => $_POST['Ha_tenido_algun_aborto,_muerte,_fetal,_neonatal?'],

                'hta_personal' => $_POST['hta_personal'],
                'obesidad_personal' => $_POST['obesidad_personal'],
                'diabetes_personal' => $_POST['diabetes_personal'],
                'fuma' => $_POST['fuma'],
                'fuma_frecuencia' => $_POST['fuma_frencuencia'],
                'bebidas alcoholicas' => $_POST['bebidas_alcoholicas'],
                'bebidas_frecuencia' => $_POST['bebidas_frencuencia'],
                'Fondo de ojo anual' => $_POST['Fondo_de_ojo_anual'],
                'ECG anual' => $_POST['ECG_anual'],
                'Educación en diabetes' => $_POST['Educacion_en_diabetes'],
                'Antecedentes quirurgicos' => $_POST['Antecedentes_quirurgicos'],
                'motivo' => $_POST['motivo'],
                'pa' => $_POST['pa'],
                'pulso' => $_POST['pulso'],
                'peso' => $_POST['peso'],
                'talla' => $_POST['talla'],
                'imc' => $_POST['imc'],
                'pcintura' => $_POST['pcintura'],
                'Historial de enfermedad actual' => $_POST['Historial_de_enfermedad_actual'],
                'Examen fisico' => $_POST['Examen_fisico'],
                'Diagnostico presuntivo' => $_POST['Diagnostico_presuntivo'],
                'Laboratorios, estudios o examenes solicitados' => $_POST['Laboratorios,_estudios_o_examenes_solicitados'],
                'Tratamiento' => $_POST['Tratamiento'],
                'aclaraciones' => $_POST['aclaraciones'],
            ]);
        }

        if ($_POST['tipo'] == 'neurologia') {
            $anamnesis = json_encode([
                'procedencia' => $_POST['procedencia'],
                'diagnostico' => $_POST['diagnostico'],
            ]);
        }

        $this->db->query("
            INSERT INTO
                tblconsultas
                (monto, edad, foto_perfil, fotos, id_client, id_staff, fecha, anamnesis, tipo)
            VALUES
                ('$monto', '$edad', '$foto_perfil', '$fotos', '$id_client', '$id_staff', NOW(), '$anamnesis', '$tipo');
        ");

        $this->session->set_flashdata('success', 'Consulta almacenada satisfactoriamente');

        redirect('/admin/consultas/imprimir?tipo=diabetes');
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

        $data['anamnesis'] = json_decode($data['consulta']->anamnesis, true);

        $query = $this->db->query("SELECT * FROM tblenfermedades");
        $data['enfermedades'] = $query->result();

        $this->load->view('admin/consultas/editar', $data);
    }

    public function modificar()
    {
        if ($_FILES['foto_perfil']['name']) {
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/uploads/consultas/' . $_FILES['foto_perfil']['name']);
        }

        $id = $_POST['id'];

        $query = $this->db->query("SELECT * FROM tblconsultas WHERE id = $id");
        $consulta = $query->row();

        $id_client = $_POST['id_client'];
        $id_staff = $_POST['id_staff'];
        $foto_perfil = $_FILES['foto_perfil']['name'] ? $_FILES['foto_perfil']['name'] : $consulta->foto_perfil;
        $edad = $_POST['edad'];
        $monto = $_POST['monto'];
        $tipo = $_POST['tipo'];
        $fotos = json_encode($consulta->fotos);

        if (isset($array)) {
            $fotos = json_decode($consulta->fotos, true);
            $fotos = array_merge($fotos, $array);
            $fotos = json_encode($fotos);
        }

        if ($_POST['tipo'] == 'diabetes') {
            $anamnesis = json_encode([
                'obesidad' => $_POST['obesidad'],
                'hta' => $_POST['hta'],
                'diabetes' => $_POST['diabetes'],
                'iam' => $_POST['iam'],
                'acv' => $_POST['acv'],
                'cancer' => $_POST['cancer'],

                'Alguno de sus hijos peso mas de 4kg al nacer?' => $_POST['Alguno_de_sus_hijos_peso_mas_de_4kg_al_nacer?'],
                'Ha enido algun aborto, muerte, fetal, neonatal?' => $_POST['Ha_tenido_algun_aborto,_muerte,_fetal,_neonatal?'],

                'hta_personal' => $_POST['hta_personal'],
                'obesidad_personal' => $_POST['obesidad_personal'],
                'diabetes_personal' => $_POST['diabetes_personal'],
                'fuma' => $_POST['fuma'],
                'fuma_frecuencia' => $_POST['fuma_frencuencia'],
                'bebidas alcoholicas' => $_POST['bebidas_alcoholicas'],
                'bebidas_frecuencia' => $_POST['bebidas_frencuencia'],
                'Fondo de ojo anual' => $_POST['Fondo_de_ojo_anual'],
                'ECG anual' => $_POST['ECG_anual'],
                'Educación en diabetes' => $_POST['Educacion_en_diabetes'],
                'Antecedentes quirurgicos' => $_POST['Antecedentes_quirurgicos'],
                'motivo' => $_POST['motivo'],
                'pa' => $_POST['pa'],
                'pulso' => $_POST['pulso'],
                'peso' => $_POST['peso'],
                'talla' => $_POST['talla'],
                'imc' => $_POST['imc'],
                'pcintura' => $_POST['pcintura'],
                'Historial de enfermedad actual' => $_POST['Historial_de_enfermedad_actual'],
                'Examen fisico' => $_POST['Examen_fisico'],
                'Diagnostico presuntivo' => $_POST['Diagnostico_presuntivo'],
                'Laboratorios, estudios o examenes solicitados' => $_POST['Laboratorios,_estudios_o_examenes_solicitados'],
                'Tratamiento' => $_POST['Tratamiento'],
                'aclaraciones' => $_POST['aclaraciones'],
            ]);
        }

        if ($_POST['tipo'] == 'neurologia') {
            $anamnesis = json_encode([
                'procedencia' => $_POST['procedencia'],
                'diagnostico' => $_POST['diagnostico'],
            ]);
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
                monto = '$monto',
                tipo = '$tipo'
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

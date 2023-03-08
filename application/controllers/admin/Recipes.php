<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Recipes extends AdminController
{
    public function index()
    {
        $sql = "
            SELECT
                r.id,
                r.date AS fecha,
                r.description,
                c.company AS paciente,
                CONCAT(s.firstname, ' ', s.lastname) AS profesional
            FROM
                tblrecipes r
                    LEFT JOIN tblclients c ON r.id_client = c.userid
                    LEFT JOIN tblstaff s ON s.staffid = r.id_professional;
        ";

        $data['recipes'] = $this->db->query($sql)->result();

        $this->load->view('admin/recipes/index', $data);
    }

    public function create()
    {
        $data['profesionales'] = $this->db->get('tblstaff')->result();
        $data['pacientes'] = $this->db->get('tblclients')->result();

        $this->load->view('admin/recipes/create', $data);
    }

    public function store()
    {
        $data = [
            'id_client' => $_POST['id_client'],
            'id_professional' => $_POST['id_professional'],
            'date' => date('Y-m-d H:i:s'),
            'description' => $_POST['descripcion']
        ];

        $this->db->insert('tblrecipes', $data);

        return redirect('/admin/recipes/print/' . $this->db->insert_id());
    }

    public function edit($id)
    {
        $data['recipe'] = $this->db->query("SELECT * FROM tblrecipes WHERE id = '$id'")->row();

        $this->load->view('admin/recipes/edit', $data);
    }

    public function print($id)
    {
        $data['recipe'] = $this->db->query("SELECT * FROM tblrecipes WHERE id = '$id'")->row();
        
        $userid = $data['recipe']->id_client;
        $staffid = $data['recipe']->id_professional;

        $data['paciente'] = $this->db->query("SELECT * FROM tblclients WHERE userid = '$userid'")->row();

        $data['doctor'] = $this->db->query("SELECT * FROM tblstaff WHERE staffid = '$staffid'")->row();

        $this->load->view('admin/recipes/print', $data);
    }

    public function update()
    {
        extract($_POST);

        $this->db->query("UPDATE tblrecipes SET id_client = '$id_client', id_professional = '$id_professional', description = '$descripcion' WHERE id = '$id'");

        $recipe = $this->db->query("SELECT * FROM tblrecipes WHERE id = '$id'")->row();

        return redirect('/admin/recipes/print/' . $recipe->id);
    }

    public function delete($id)
    {
        $this->db->query("DELETE tblrecipes WHERE id = '$id'");
        return redirect('/admin/recipes');
    }
}

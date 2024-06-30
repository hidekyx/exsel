<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Batch extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Batch_model');
            $this->load->model('User_model');
			$this->load->library('M_db');
        }

        public function index()
        {
            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}			
			$data = [
                'page' => "Batch",
				'batch'=> $this->Batch_model->get_batch(),
            ];
			
            $this->load->view('batch/index', $data);
        }

        public function create()
        {
			$data['page'] = "Batch";
            $this->load->view('batch/create', $data);
        }

        public function store()
        {
            $data = [
                'nama_batch' => $this->input->post('nama_batch'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                'status' => $this->input->post('status'),
            ];
            
            $this->form_validation->set_rules('nama_batch', 'Nama Batch', 'required');
            $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            
            if ($this->form_validation->run() != false) {
                $result = $this->Batch_model->insert($data);
                if ($result) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    redirect('Batch');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                redirect('Batch/create');
                
            }
        }

        public function edit($id_batch)
        {
            $data['page'] = "Batch";
			$data['batch'] = $this->Batch_model->show($id_batch);
            $this->load->view('batch/edit', $data);
        }

        public function update($id_batch)
        {
            $id_batch = $this->input->post('id_batch');
            $data = array(
                'nama_batch' => $this->input->post('nama_batch'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                'status' => $this->input->post('status'),
            );

            $this->Batch_model->update($id_batch, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('Batch');
        }

        public function destroy($id_batch)
        {
            $this->Batch_model->delete($id_batch);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('Batch');
        }

        public function active($id_batch)
        {
            $users = $this->User_model->tampil();
            foreach ($users as $u) {
                $this->User_model->update_active_batch($u->id_user, $id_batch);
            }
            $log = [
                'batch_active' => $id_batch,
            ];
            $this->session->set_userdata($log);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data batch berhasil diperbaharui!</div>');
			redirect('Batch');
        }

        // Debugging purpose
        public function change_batch($batch)
        {
            $log = [
                'batch_active' => $batch,
            ];
            $this->session->set_userdata($log);

            $id_user = $this->session->userdata('id_user');
            $this->db->simple_query("UPDATE user SET batch_active=$batch WHERE id_user='$id_user';");

            echo "Batch updated: $batch";
        }
    
    }
    
    
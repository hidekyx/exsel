<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Aspek_kriteria extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Aspek_Kriteria_model');
			$this->load->library('M_db');

            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}
        }

        public function index()
        {
            $data = [
				'page' => "Aspek Kriteria",
                'list' => $this->Aspek_Kriteria_model->tampil(),
                'kriteria'=> $this->Aspek_Kriteria_model->get_kriteria(),
                'count_kriteria'=> $this->Aspek_Kriteria_model->count_kriteria(),
                'sub_kriteria' => $this->Aspek_Kriteria_model->tampil(),
                
            ];

			// dd($data);
            $this->load->view('sub_kriteria/aspek', $data);
        }

        //menambahkan data ke database
        public function store()
        {
			$data = [
				'id_kriteria' => $this->input->post('id_kriteria'),
				'nama_aspek' => $this->input->post('nama_aspek'),
				'id_batch' => $this->session->userdata('batch_active'),
			];
			
			$this->form_validation->set_rules('id_kriteria', 'ID Kriteria', 'required');
			$this->form_validation->set_rules('nama_aspek', 'Nama', 'required');

			if ($this->form_validation->run() != false) {
				$result = $this->Aspek_Kriteria_model->insert($data);
				if ($result) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					redirect('Aspek_kriteria');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
				redirect('Aspek_kriteria/create');
			}
            

        }
    
        public function update($id_aspek_kriteria)
        {
            $id_aspek_kriteria = $this->input->post('id_aspek_kriteria');
            $data = array(
                'id_kriteria' => $this->input->post('id_kriteria'),
				'nama_aspek' => $this->input->post('nama_aspek')
            );

            $this->Aspek_Kriteria_model->update($id_aspek_kriteria, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('Aspek_kriteria');
        }
    
        public function destroy($id_aspek_kriteria)
        {
            $this->Aspek_Kriteria_model->delete($id_aspek_kriteria);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('Aspek_kriteria');
        }
		
		function getsubcontainer()
		{
			$d['kriteria']=$this->Aspek_Kriteria_model->get_kriteria();
			$this->load->view('Sub_kriteria/subaspek',$d);
		}
		
		function getsub()
		{		
			$id_kriteria=$this->input->get('kriteria');
			$namaKriteria=$this->Aspek_Kriteria_model->kriteria_info($id_kriteria);
			$dSub=$this->Aspek_Kriteria_model->aspek_child($id_kriteria);
			$output=array();
			$outputs=array();
			if(!empty($dSub)){					
				foreach($dSub as $rK){
					$output[$rK['id_aspek_kriteria']]=$rK['nama_aspek'];
					$outputs[$rK['id_aspek_kriteria']]['id_aspek_kriteria']=$rK['id_aspek_kriteria'];
					$outputs[$rK['id_aspek_kriteria']]['id_kriteria']=$rK['id_kriteria'];
				}
			}
			$d['arr']=$output;
			$d['arrs']=$outputs;
			$d['kriteriaid']=$id_kriteria;
			$d['namakriteria']=$namaKriteria['nama_kriteria'];
			$this->load->view('sub_kriteria/matrikaspek', $d);
		}
		
		function updatesub()
		{
			$error=FALSE;
			$kriteriaid=$this->input->post('kriteriaid');
			if(!empty($kriteriaid))
			{
			$msg="";
			$s=array(
				'id_kriteria'=>$kriteriaid,
			);
			$this->m_db->delete_row('aspek_kriteria_nilai',$s);
					
			$cr=$this->input->post('crvalue');
			if($cr > 0.1)
			{
				$msg="Gagal diupdate karena nilai CR kurang dari 0.1";
				$error=TRUE;
			}else{
				foreach($_POST as $k=>$v)
				{
					if($k!="crvalue" && $k!="kriteriaid")
					{									
					foreach($v as $x=>$x2)
					{
						$d=array(
						'id_kriteria'=>$kriteriaid,
						'aspek_kriteria_id_dari'=>$k,
						'aspek_kriteria_id_tujuan'=>$x,
						'nilai'=>$x2,
						);
						$this->m_db->add_row('aspek_kriteria_nilai',$d);
					}
					}
				}
				$msg="Berhasil update nilai aspek kriteria";
				$error=FALSE;
			}
					
			
			if($error==FALSE)
			{			
				echo json_encode(array('status'=>'ok','msg'=>$msg));
			}else{
				echo json_encode(array('status'=>'no','msg'=>$msg));
			}
			
			}else{
				$msg="Gagal mengubah nilai aspek kriteria";
				echo json_encode(array('status'=>'no','msg'=>$msg));
			}
			
		}
		
		public function simpan_prioritas()
        {
			$id_krit = $this->input->post('id_krit');
			$this->Aspek_Kriteria_model->hapus_perioritas($id_krit);
			
			$id_kriteria = $this->input->post('id_kriteria');
			$id_aspek_kriteria = $this->input->post('id_aspek_kriteria');
            $perioritas = $this->input->post('perioritas');
            $i = 0;
            echo var_dump($perioritas);
            foreach ($perioritas as $key) {
                $this->Aspek_Kriteria_model->tambah_perioritas($id_kriteria[$i],$id_aspek_kriteria[$i],$key);
                $i++;
            }
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('Aspek_kriteria');
        }
    
    }
    
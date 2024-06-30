<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Aspek_Kriteria_model extends CI_Model {

        public function tampil()
        {
            $batch_active = $this->session->userdata('batch_active');
            $this->db->where('id_batch', $batch_active);
            $query = $this->db->get('aspek_kriteria');
            return $query->result();
        }
		
		public function tambah_perioritas($id_kriteria,$id_aspek_kriteria,$perioritas)
        {
            $query = $this->db->simple_query("INSERT INTO aspek_kriteria_hasil VALUES (DEFAULT,'$id_kriteria','$id_aspek_kriteria','$perioritas');");
            return $query;	
        }
		
		public function hapus_perioritas($id_kriteria)
        {
            $this->db->where('id_kriteria', $id_kriteria);
            $this->db->delete('aspek_kriteria_hasil');
        }

        // public function get_range_atas($id_kriteria)
        // {
        //     $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';")->result_array();
        //     $range_atas = 0;
        //     foreach ($query as $q) {
        //         $value = explode(' - ', $q['nama_sub_kriteria']);
        //         foreach($value as $v) {
        //             if($v > $range_atas) {
        //                 $range_atas = $v;
        //             }
        //         }
        //     }
        //     return $range_atas;
        // }

        // public function get_range_bawah($id_kriteria)
        // {
        //     $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';")->result_array();
        //     $range_bawah = 0;
        //     foreach ($query as $q) {
        //         $value = explode(' - ', $q['nama_sub_kriteria']);
        //         foreach($value as $v) {
        //             if($v < $range_bawah) {
        //                 $range_bawah = $v;
        //             }
        //         }
        //     }
        //     return $range_bawah;
        // }

        public function getTotal()
        {
            return $this->db->count_all('aspek_kriteria');
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('aspek_kriteria', $data);
            return $result;
        }

        public function show($id_sub_kriteria)
        {
            $this->db->where('id_sub_kriteria', $id_sub_kriteria);
            $query = $this->db->get('sub_kriteria');
            return $query->row();
        }

        public function update($id_aspek_kriteria, $data = [])
        {
            $ubah = array(
                'id_kriteria' => $data['id_kriteria'],
                'nama_aspek' => $data['nama_aspek']
            );

            $this->db->where('id_aspek_kriteria', $id_aspek_kriteria);
            $this->db->update('aspek_kriteria', $ubah);
        }

        public function delete($id_aspek_kriteria)
        {
            $this->db->where('id_aspek_kriteria', $id_aspek_kriteria);
            $this->db->delete('aspek_kriteria');
        }

        public function get_kriteria()
        {
            $batch_active = $this->session->userdata('batch_active');
            $this->db->where('id_batch', $batch_active);
            $query = $this->db->get('kriteria');
            return $query->result();
        }

        public function count_kriteria(){
            $query =  $this->db->query("SELECT id_kriteria,COUNT(nama_sub_kriteria) AS jml_setoran FROM sub_kriteria GROUP BY id_kriteria")->result();
            return $query;
        }

        public function data_aspek_kriteria($id_kriteria)
		{
            $batch_active = $this->session->userdata('batch_active');
			$query = $this->db->query("SELECT * FROM aspek_kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
			return $query->result_array();
		}
		
		public function kriteria_info($id_kriteria)
		{
            $batch_active = $this->session->userdata('batch_active');
			$query = $this->db->query("SELECT nama_kriteria FROM kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
			return $query->row_array();
		}
		
		public function aspek_child($id_kriteria)
		{
            $batch_active = $this->session->userdata('batch_active');
			$query = $this->db->query("SELECT * FROM aspek_kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
			return $query->result_array();
		}
    }
    
    /* End of file Kategori_model.php */
    
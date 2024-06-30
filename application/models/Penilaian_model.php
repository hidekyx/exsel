<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penilaian_model extends CI_Model {

        public function tambah_penilaian_select($id_alternatif,$id_kriteria,$id_sub_kriteria)
        {
            $query_nilai = $this->db->query("SELECT * FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria';")->row_array();
            $nilai = $query_nilai['nama_sub_kriteria'];
            $query = $this->db->simple_query("INSERT INTO penilaian VALUES (DEFAULT,'$id_alternatif','$id_kriteria','$id_sub_kriteria','$nilai');");
            if (!$query) {
                $error = $this->db->error();
                var_dump($error); die();
            }
            return $query;	
        }

        public function tambah_penilaian_number($id_alternatif,$id_kriteria,$value_sub_kriteria)
        {
            $id_sub_kriteria = null;
            $query_range = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';")->result_array();
            foreach ($query_range as $q) {
                $value = explode(' - ', $q['nama_sub_kriteria']);
                $min_value =  min($value);
                $max_value =  max($value);

                if($value_sub_kriteria >= $min_value && $value_sub_kriteria <= $max_value) {
                    $id_sub_kriteria = $q['id_sub_kriteria'];
                }
            }

            $query = $this->db->simple_query("INSERT INTO penilaian VALUES (DEFAULT,'$id_alternatif','$id_kriteria','$id_sub_kriteria',$value_sub_kriteria);");
            return $query;	
        }

        public function edit_penilaian_select($id_alternatif,$id_kriteria,$id_sub_kriteria)
        {
            $query_nilai = $this->db->query("SELECT * FROM sub_kriteria WHERE id_sub_kriteria='$id_sub_kriteria';")->row_array();
            $nilai = $query_nilai['nama_sub_kriteria'];
            $query = $this->db->simple_query("UPDATE penilaian SET id_sub_kriteria=$id_sub_kriteria, nilai_mentah='$nilai' WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query;	
        }
       
        public function edit_penilaian_number($id_alternatif,$id_kriteria,$value_sub_kriteria)
        {
            $id_sub_kriteria = null;
            $query_range = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';")->result_array();
            foreach ($query_range as $q) {
                $value = explode(' - ', $q['nama_sub_kriteria']);
                $min_value =  min($value);
                $max_value =  max($value);

                if($value_sub_kriteria >= $min_value && $value_sub_kriteria <= $max_value) {
                    $id_sub_kriteria = $q['id_sub_kriteria'];
                }
            }

            $query = $this->db->simple_query("UPDATE penilaian SET id_sub_kriteria=$id_sub_kriteria, nilai_mentah='$value_sub_kriteria'  WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query;	
        }

        public function delete($id_penilaian)
        {
            $this->db->where('id_penilaian', $id_penilaian);
            $this->db->delete('penilaian');
        }
       
        public function get_kriteria()
        {
            $batch_active = $this->session->userdata('batch_active');
            $this->db->where('id_batch', $batch_active);
            $query = $this->db->get('kriteria');
            return $query->result();
        }
		
        public function get_alternatif()
        {
            $batch_active = $this->session->userdata('batch_active');
            $query = $this->db->query("SELECT * FROM alternatif WHERE id_batch='$batch_active'");
            return $query->result();
        }

        public function data_penilaian($id_alternatif,$id_kriteria)
        {
            $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query->row_array();
        }

        public function data_nilai($id_alternatif,$id_kriteria)
        {
            $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';")->row_array();
            return $query['nilai_mentah'];
        }
		
        public function untuk_tombol($id_alternatif)
		{
			$query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif';");
			return $query->num_rows();
		}
		
		public function data_sub_kriteria($id_kriteria)
		{
            $batch_active = $this->session->userdata('batch_active');
			$query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
			return $query->result_array();
		}
    
    }
    
    
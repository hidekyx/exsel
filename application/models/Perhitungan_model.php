<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan_model extends CI_Model {
		
		function __construct()
		{
			parent::__construct();
			
		}
		
		public function get_kriteria()
		{
            $batch_active = $this->session->userdata('batch_active');
			$query = $this->db->query("SELECT * FROM kriteria JOIN kriteria_hasil ON kriteria.id_kriteria=kriteria_hasil.id_kriteria WHERE id_batch='$batch_active';");
			return $query->result();
		}
		
        public function get_alternatif()
        {
            $batch_active = $this->session->userdata('batch_active');
            $this->db->where('id_batch', $batch_active);
            $query = $this->db->get('alternatif');
            return $query->result();
        }

        public function get_aspek_kriteria($id_kriteria)
        {
            $batch_active = $this->session->userdata('batch_active');
            $query = $this->db->query("SELECT * FROM aspek_kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
            return $query->result();
        }
		
		public function data_nilai_aspek($id_kriteria,$id_aspek_kriteria)
        {
            $query = $this->db->query("SELECT * FROM aspek_kriteria_hasil WHERE id_kriteria='$id_kriteria' AND id_aspek_kriteria='$id_aspek_kriteria';");
            return $query->row_array();
        }
		
		public function get_sub_kriteria($id_kriteria)
        {
            $batch_active = $this->session->userdata('batch_active');
            $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' AND id_batch='$batch_active';");
            return $query->result();
        }
		
		public function data_nilai_sub($id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->query("SELECT * FROM sub_kriteria_hasil WHERE id_kriteria='$id_kriteria' AND id_sub_kriteria='$id_sub_kriteria';");
            return $query->row_array();
        }
		
		public function data_nilai($id_alternatif,$id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria ON penilaian.id_sub_kriteria=sub_kriteria.id_sub_kriteria JOIN sub_kriteria_hasil ON penilaian.id_sub_kriteria=sub_kriteria_hasil.id_sub_kriteria WHERE penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function nilai_subkrit($id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->query("SELECT * FROM sub_kriteria_hasil JOIN sub_kriteria ON sub_kriteria_hasil.id_sub_kriteria=sub_kriteria.id_sub_kriteria  WHERE sub_kriteria_hasil.id_kriteria='$id_kriteria' AND sub_kriteria_hasil.id_sub_kriteria='$id_sub_kriteria'");
            return $query->row_array();
        }
		
		public function insert_hasil($hasil_akhir = [])
        {
            $result = $this->db->insert('hasil', $hasil_akhir);
            return $result;
        }
		
		public function hapus_hasil()
        {
            $query = $this->db->query("TRUNCATE TABLE hasil;");
			return $query;
        }
		
		public function get_hasil()
        {
			$query = $this->db->query("SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif ORDER BY hasil.nilai DESC;");
            return $query->result();
        }
		
    }
    
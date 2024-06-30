<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Batch_model extends CI_Model {

        public function get_batch()
		{
			$query = $this->db->query("SELECT * FROM batch;");
			return $query->result();
		}

        public function get_batch_terbaru()
        {
            $query = $this->db->query("SELECT id_batch FROM batch ORDER BY id_batch DESC LIMIT 1");
            return $query->row_array();
        }

        public function show($id_batch)
        {
            $this->db->where('id_batch', $id_batch);
            $query = $this->db->get('batch');
            return $query->row();
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('batch', $data);
            return $result;
        }

        public function update($id_batch, $data = [])
        {
            $ubah = array(
                'nama_batch' => $data['nama_batch'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
                'status' => $data['status'],
            );

            $this->db->where('id_batch', $id_batch);
            $this->db->update('batch', $ubah);
        }

        public function delete($id_batch)
        {
            $alternatif = $this->db->query("SELECT * FROM alternatif WHERE id_batch='$id_batch';");
            foreach ($alternatif as $a) {
                $this->db->where('id_batch', $id_batch);
                $this->db->delete('alternatif');
            }

            $aspek_kriteria = $this->db->query("SELECT * FROM aspek_kriteria WHERE id_batch='$id_batch';");
            foreach ($aspek_kriteria as $ak) {
                $this->db->where('id_batch', $id_batch);
                $this->db->delete('aspek_kriteria');
            }

            $kriteria = $this->db->query("SELECT * FROM kriteria WHERE id_batch='$id_batch';");
            foreach ($kriteria as $k) {
                $this->db->where('id_batch', $id_batch);
                $this->db->delete('kriteria');
            }

            $sub_kriteria = $this->db->query("SELECT * FROM sub_kriteria WHERE id_batch='$id_batch';");
            foreach ($sub_kriteria as $sk) {
                $this->db->where('id_batch', $id_batch);
                $this->db->delete('sub_kriteria');
            }

            $this->db->where('id_batch', $id_batch);
            $this->db->delete('batch');
        }
    }
    
<?php

class KoperasiModel extends CI_Model {

    public function getAllKoperasi () {
        $query = $this->db->select('kop.id, kop.nama as name, kop.kelompok, kop.jenis, kop.alamat, kop.lat, kop.lon, gp.nama as gampong, kab.nama as kabupaten, kec.nama as kecamatan')
        ->from('koperasi_features kop')
        ->join('wilayah_kecamatan kec','kec.id = kop.kecamatan')
        ->join('wilayah_desa gp','gp.id = kop.desa')
        ->join('wilayah_kabupaten kab','kab.id = kop.kabupaten');

        if ($this->input->get('kota') != null) {
            $query->where('kabupaten', $this->input->get('kota'));
        }

        if ($this->input->get('q') != null) {
            $query->like('kop.nama', $this->input->get('q'));
        }
        return $query->get()->result();
    }

    public function searchCity ($key) {
        return $this->db->select('id,nama')
        ->from('wilayah_kabupaten')
        ->like('nama', $key)
        ->where('provinsi_id', 11) // aceh only
        ->get()->result();
    }
}
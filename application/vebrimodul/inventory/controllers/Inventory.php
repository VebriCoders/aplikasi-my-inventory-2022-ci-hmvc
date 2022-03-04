<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Inventory');
        $this->load->model('M_Inventory_Detail');

        //Cek Apakah Sudah Login?
        if ($this->session->userdata('is_login') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        // LOAD LIBRARY
        $this->load->library('pagination');

        $web_link = base_url();

        // CONFIG
        $config['base_url'] = $web_link . '/inventory/index';
        $config['total_rows'] = $this->M_Inventory->jumlahDataInventory();
        $config['per_page'] = 4;

        // INTIALIZE
        $this->pagination->initialize($config);

        // URI SEGMENT
        $start = $this->uri->segment(3);

        $data = array(
            'namamodule'                            => "inventory",
            'namafileview'                          => "v_inventory",
            'title'                                 => "Data Inventory",
            'tampilDataPagination_Inventory'        => $this->M_Inventory->tampilDataPagination_Inventory($config['per_page'], $start),
            'tampilData_Inventory'                  => $this->M_Inventory->tampilData_Inventory(),
        );
        echo Modules::run('template/AdminTemplate', $data);
    }

    public function Tambah()
    {
        $this->M_Inventory->Tambah();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('inventory');
    }

    public function Edit()
    {
        $this->M_Inventory->Edit();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        $actual_link =  $this->input->post('actual_link');
        redirect($actual_link);
    }

    public function Hapus($id)
    {
        $this->M_Inventory->Hapus($id);
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        $actual_link =  $this->input->post('actual_link');
        redirect($actual_link);
    }

    public function Favorite($id, $uri_code = null)
    {
        $data_inventory = $this->M_Inventory->getById($id);

        if ($data_inventory->favorite == 0) {
            $data = [
                'favorite' => 1,
                'update_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id)->update('tbl_inventory', $data);
        } else if ($data_inventory->favorite == 1) {
            $data = [
                'favorite' => 0,
                'update_at' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('id', $id)->update('tbl_inventory', $data);
        }

        if ($uri_code == 0) {
            redirect('inventory/');
        } else {
            redirect('inventory/index/' . $uri_code);
        }
    }


    //Detail Inventory 

    public function detail($slug_data)
    {
        $data_inventory = $this->M_Inventory_Detail->getDataInventory($slug_data);

        $data = array(
            'namamodule'                  => "inventory",
            'namafileview'                => "v_detail_inventory",
            'title'                       => "Detail Data Inventory",
            'tampilData_Inventory'        => $data_inventory,
            'tampilData_Detail'           => $this->M_Inventory_Detail->tampilData_Detail($data_inventory->id),
            'hitungJumlahBarang'          => $this->M_Inventory_Detail->hitungJumlahBarang($data_inventory->id),
            'hitungJumlahBarangHarga'     => $this->M_Inventory_Detail->hitungJumlahBarangHarga($data_inventory->id),
            'hitungJumlahBarangTotal'     => $this->M_Inventory_Detail->hitungJumlahBarangTotal($data_inventory->id),
        );
        echo Modules::run('template/AdminTemplate', $data);
    }

    public function Tambah_Barang($slug_data)
    {
        $this->M_Inventory_Detail->Tambah_Barang();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('inventory/detail/' . $slug_data);
    }

    public function Edit_Barang($slug_data)
    {
        $this->M_Inventory_Detail->Edit_Barang();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('inventory/detail/' . $slug_data);
    }

    public function Hapus_Barang($slug_data, $id)
    {
        $this->M_Inventory_Detail->Hapus_Barang($id);
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('inventory/detail/' . $slug_data);
    }

    public function Cetak_Invoice($slug_data)
    {
        $data_inventory = $this->M_Inventory_Detail->getDataInventory($slug_data);

        $data = array(
            'title'                       => "Invoice Inventory | " . $data_inventory->nama_inventory,
            'tampilData_Inventory'        => $data_inventory,
            'tampilData_Detail'           => $this->M_Inventory_Detail->tampilData_Detail($data_inventory->id),
            'hitungJumlahBarang'          => $this->M_Inventory_Detail->hitungJumlahBarang($data_inventory->id),
            'hitungJumlahBarangHarga'     => $this->M_Inventory_Detail->hitungJumlahBarangHarga($data_inventory->id),
            'hitungJumlahBarangTotal'     => $this->M_Inventory_Detail->hitungJumlahBarangTotal($data_inventory->id),
        );

        $this->load->view('V_cetak', $data);
    }
}

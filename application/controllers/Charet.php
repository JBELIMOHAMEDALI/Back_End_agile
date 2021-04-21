<?php

require APPPATH . 'libraries/REST_Controller.php';
class Charet extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        $this->load->model("Model_chart");
    }
    public function get_nombre_chouffeur_act_get()
    {
        $data = $this->Model_chart->get_tt_count_act_act("chauffeur");

        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_voiture_act_get()
    {
        $data = $this->Model_chart->get_tt_count_act_act("voiture");

        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_mission_en_attonte_admin_get()
    {
        $data = $this->Model_chart->get_tt_count_mission_etat("0");

        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_mission_terminer_admin_get()
    {

        $data = $this->Model_chart->get_tt_count_mission_etat("1");

        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_entritien_bay_year_naw_get()
    {
        $data = $this->Model_chart->get_tt_count_nomber_entritient_bay_yeares();
        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_voiture_affecte_get()
    {
        $data = $this->Model_chart->get_tt_count_affectaion_act();
        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    /**---------------------chouffeur-----------------------------**/
    public function get_nombre_mission_en_attonte_chouffeur_get()
    {
        $id_chouffeur = $this->input->get('id');
        $data = $this->Model_chart->get_tt_count_mission_etat("0", $id_chouffeur);

        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_mission_terminer_chouffeur_get()
    {
        $id_chouffeur = $this->input->get('id');
        $data = $this->Model_chart->get_tt_count_mission_etat("1", $id_chouffeur);
        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
    public function get_nombre_carnet_bored_chouffeur_get()
    {
        $id_chouffeur = $this->input->get('id');
        $data = $this->Model_chart->get_tt_count_carnet_bored_chouffeur($id_chouffeur);
        //var_dump($data);
        if ($data != 0) {
            $res = array(
                'erorer' => false,
                'msg' => $data[0]->nb

            );
            $this->response($res, REST_Controller::HTTP_OK);
        } else {
            $res = array(
                'erorer' => false,
                'msg' => "0"
            );

            $this->response($res, REST_Controller::HTTP_OK);
        }
    }
}

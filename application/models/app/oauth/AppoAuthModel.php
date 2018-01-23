<?php


class appoAuthModel extends CI_Model
{

    private $apptb_user = "tbapp_registeruser_app";

    function __construct()
    {
        parent::__construct();
        $this->load->model([
            "app/functions/appFunctionsModel"
        ]);
    }

    public function recoverPassword($data)
    {
        $quser = $this->db->where("_nickname", strtolower($data["u"]))
            ->or_where("_mail", strtolower($data["u"]))
            ->get($this->apptb_user)
            ->row();

        if ($quser) {


            $new_password = $this->appFunctionsModel->generatePassword();
            $update_pass = [
                "_key" => $this->appFunctionsModel->hashPassword($new_password)
            ];

            $this->db->where(["id" => $quser->id])->update($this->apptb_user, $update_pass);
            $this->appEmailsModel->emailRenewPassword($quser->_mail, $new_password);

            $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id"), "process" => "ha recuperado la clave del sistema"]);

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function oauthAutorizedSesion($quser)
    {

        $unsenew = unserialize($quser->_relacionship_store);
        $impnew = implode(",", $unsenew);

        $unsenold = unserialize($quser->_relacionship_store_old);
        $impold = implode(",", $unsenold);

        $data_session = [
            "id" => $quser->id,
            "nickname" => $quser->_nickname,
            "mail" => $quser->_mail,
            "account_id" => $quser->_account_id,
            "country_id" => $quser->_store_id,
            "stores_new" => $impnew,
            "stores_old" => $impold
        ];

        $this->session->set_userdata($data_session);

        $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id"), "process" => "ha ingresado en el sistema"]);
    }

    public function oauthChecked()
    {
        if ($this->session->userdata("id")) {
            return TRUE;
        } else {
            $this->session->sess_destroy();
            redirect('/', 'auto');
        }
    }

    public function oauthDestroySession()
    {
        if ($this->session->userdata("id")) {
            $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id"), "process" => "ha salido en el sistema"]);
            $this->session->sess_destroy();
            redirect('/', 'auto');
        } else {
            $this->appMonitorModel->putRecord(["user" => $this->session->userdata("id"), "process" => "ha salido en el sistema"]);
            $this->session->sess_destroy();
            redirect('/', 'auto');
        }
    }
}
